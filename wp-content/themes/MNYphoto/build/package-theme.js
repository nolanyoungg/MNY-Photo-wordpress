'use strict';

const fs = require('node:fs');
const path = require('node:path');
const { ZipArchive } = require('archiver');

const root = path.resolve(__dirname, '..');
const slug = 'MNYphoto-theme';
const packageDirectory = path.resolve(root, '..', '..', 'zipped-theme');
const outputPath = path.join(packageDirectory, `${slug}.zip`);
const isPreflight = process.argv.includes('--preflight');
const runtimeEntries = [
	'404.php', 'archive.php', 'comments.php', 'footer.php', 'front-page.php',
	'functions.php', 'header.php', 'home.php', 'inc', 'index.php', 'languages',
	'page-templates', 'page.php', 'readme.txt', 'screenshot.png',
	'search.php', 'searchform.php', 'sidebar.php', 'single.php', 'style.css',
	'template-parts', 'dist/css', 'dist/js', 'dist/images', 'dist/icons',
];

function verifyPackageDirectory() {
	if (!fs.existsSync(packageDirectory)) {
		fs.mkdirSync(packageDirectory, { recursive: true });
	}

	if (!fs.statSync(packageDirectory).isDirectory()) {
		throw new Error(`Package destination is not a directory: ${packageDirectory}`);
	}

	fs.accessSync(packageDirectory, fs.constants.W_OK);
}

function listSourceFiles(source, relativePath) {
	if (fs.statSync(source).isFile()) {
		return [path.posix.join(slug, relativePath.split(path.sep).join('/'))];
	}

	return fs.readdirSync(source, { withFileTypes: true }).flatMap((entry) => {
		const entrySource = path.join(source, entry.name);
		const entryRelative = path.join(relativePath, entry.name);

		return listSourceFiles(entrySource, entryRelative);
	});
}

function listArchiveFiles(archivePath) {
	const zip = fs.readFileSync(archivePath);
	const endSignature = 0x06054b50;
	const directorySignature = 0x02014b50;
	const minimumEndOffset = Math.max(0, zip.length - 0xffff - 22);
	let endOffset = zip.length - 22;

	while (endOffset >= minimumEndOffset && zip.readUInt32LE(endOffset) !== endSignature) {
		endOffset--;
	}

	if (endOffset < minimumEndOffset) {
		throw new Error('Archive validation failed: ZIP directory record not found.');
	}

	const entryCount = zip.readUInt16LE(endOffset + 10);
	let directoryOffset = zip.readUInt32LE(endOffset + 16);
	const entries = [];

	for (let index = 0; index < entryCount; index++) {
		if (zip.readUInt32LE(directoryOffset) !== directorySignature) {
			throw new Error('Archive validation failed: invalid ZIP directory entry.');
		}

		const nameLength = zip.readUInt16LE(directoryOffset + 28);
		const extraLength = zip.readUInt16LE(directoryOffset + 30);
		const commentLength = zip.readUInt16LE(directoryOffset + 32);
		const nameStart = directoryOffset + 46;
		entries.push(zip.toString('utf8', nameStart, nameStart + nameLength));
		directoryOffset = nameStart + nameLength + extraLength + commentLength;
	}

	return entries;
}

function validateArchiveInventory(archivePath) {
	const archiveEntries = listArchiveFiles(archivePath)
		.filter((entry) => !entry.endsWith('/'))
		.sort();
	const expectedEntries = runtimeEntries.flatMap((entry) => listSourceFiles(path.join(root, entry), entry)).sort();
	const invalidRoots = archiveEntries.filter((entry) => !entry.startsWith(`${slug}/`));
	const missingEntries = expectedEntries.filter((entry) => !archiveEntries.includes(entry));
	const extraEntries = archiveEntries.filter((entry) => !expectedEntries.includes(entry));

	if (invalidRoots.length || missingEntries.length || extraEntries.length) {
		throw new Error(
			`Archive inventory validation failed. Invalid root: ${invalidRoots.join(', ') || 'none'}; missing: ${missingEntries.join(', ') || 'none'}; extra: ${extraEntries.join(', ') || 'none'}`
		);
	}
}

verifyPackageDirectory();

if (isPreflight) {
	console.log(`Package destination ready: ${packageDirectory}`);
	process.exit(0);
}

runtimeEntries.forEach((entry) => {
	const source = path.join(root, entry);
	if (!fs.existsSync(source)) {
		throw new Error(`Missing package entry: ${entry}`);
	}
});

verifyPackageDirectory();

const temporaryPath = `${outputPath}.partial`;
const output = fs.createWriteStream(temporaryPath, { flags: 'w' });
const archive = new ZipArchive({ zlib: { level: 9 } });

const cleanup = (error) => {
	if (fs.existsSync(temporaryPath)) {
		fs.unlinkSync(temporaryPath);
	}

	if (error) {
		throw error;
	}
};

output.on('close', () => {
	try {
		validateArchiveInventory(temporaryPath);
		verifyPackageDirectory();
		fs.renameSync(temporaryPath, outputPath);
		console.log(`Created and validated ${outputPath} (${archive.pointer()} bytes).`);
	} catch (error) {
		cleanup(error);
	}
});
output.on('error', cleanup);
archive.on('error', cleanup);
archive.pipe(output);

runtimeEntries.forEach((entry) => {
	const source = path.join(root, entry);
	const destination = path.posix.join(slug, entry);

	if (fs.statSync(source).isDirectory()) {
		archive.directory(source, destination);
	} else {
		archive.file(source, { name: destination });
	}
});

archive.finalize();
