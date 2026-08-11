'use strict';

const { spawnSync } = require( 'node:child_process' );
const { existsSync, readdirSync } = require( 'node:fs' );
const { homedir } = require( 'node:os' );
const { join } = require( 'node:path' );

const root = join( __dirname, '..' );

function runPhp( binary, args, options = {} ) {
	return spawnSync( binary, args, {
		encoding: 'utf8',
		windowsHide: true,
		...options,
	} );
}

function isPhpBinary( binary ) {
	const result = runPhp( binary, [ '--version' ] );

	return !result.error && result.status === 0;
}

function readDirectories( directory ) {
	try {
		return readdirSync( directory, { withFileTypes: true } )
			.filter( ( entry ) => entry.isDirectory() )
			.map( ( entry ) => entry.name );
	} catch ( error ) {
		return [];
	}
}

function getLocalServiceRoots() {
	const userHome = homedir();
	const roots = [];

	if ( process.platform === 'win32' ) {
		if ( process.env.LOCALAPPDATA ) {
			roots.push( join( process.env.LOCALAPPDATA, 'Programs', 'Local', 'resources', 'extraResources', 'lightning-services' ) );
		}

		if ( process.env.APPDATA ) {
			roots.push( join( process.env.APPDATA, 'Local', 'lightning-services' ) );
		}
	} else if ( process.platform === 'darwin' ) {
		roots.push( '/Applications/Local.app/Contents/Resources/extraResources/lightning-services' );
		roots.push( join( userHome, 'Library', 'Application Support', 'Local', 'lightning-services' ) );
	} else {
		roots.push( join( process.env.XDG_CONFIG_HOME || join( userHome, '.config' ), 'Local', 'lightning-services' ) );
		roots.push( '/opt/Local/resources/extraResources/lightning-services' );
	}

	return [ ...new Set( roots ) ];
}

function getLocalPhpCandidates() {
	const candidates = [];

	for ( const serviceRoot of getLocalServiceRoots() ) {
		const services = readDirectories( serviceRoot )
			.filter( ( directory ) => directory.startsWith( 'php-' ) )
			.sort( ( first, second ) => second.localeCompare( first, undefined, { numeric: true, sensitivity: 'base' } ) );

		for ( const service of services ) {
			const serviceDirectory = join( serviceRoot, service, 'bin' );

			if ( process.platform === 'win32' ) {
				const architectures = process.arch === 'ia32' ? [ 'win32', 'win64' ] : [ 'win64', 'win32' ];
				architectures.forEach( ( architecture ) => {
					candidates.push( join( serviceDirectory, architecture, 'php.exe' ) );
					// Current Local releases may provide the CLI-capable CGI binary only.
					candidates.push( join( serviceDirectory, architecture, 'php-cgi.exe' ) );
				} );
			} else if ( process.platform === 'darwin' ) {
				candidates.push( join( serviceDirectory, 'darwin', 'bin', 'php' ) );
			} else {
				candidates.push( join( serviceDirectory, 'linux', 'bin', 'php' ) );
			}
		}
	}

	return candidates;
}

function resolvePhpBinary() {
	const configuredBinary = process.env.PHP_BINARY?.trim();

	if ( configuredBinary ) {
		if ( isPhpBinary( configuredBinary ) ) {
			return configuredBinary;
		}

		throw new Error( `PHP_BINARY does not point to a working PHP executable: ${ configuredBinary }` );
	}

	if ( isPhpBinary( 'php' ) ) {
		return 'php';
	}

	const localCandidates = getLocalPhpCandidates();
	for ( const candidate of localCandidates ) {
		if ( existsSync( candidate ) && isPhpBinary( candidate ) ) {
			return candidate;
		}
	}

	const searchedLocations = getLocalServiceRoots().map( ( location ) => `  - ${ location }` ).join( '\n' );
	throw new Error(
		`PHP could not be found on PATH or in a standard Local runtime directory.\n` +
		`Set PHP_BINARY to the full PHP executable path and run npm run lint:php again.\n` +
		`Searched Local service roots:\n${ searchedLocations }`
	);
}

function collectPhpFiles( directory, files = [] ) {
	for ( const entry of readdirSync( directory, { withFileTypes: true } ) ) {
		if ( entry.isDirectory() ) {
			if ( entry.name !== 'node_modules' && entry.name !== 'vendor' ) {
				collectPhpFiles( join( directory, entry.name ), files );
			}
		} else if ( entry.name.endsWith( '.php' ) ) {
			files.push( join( directory, entry.name ) );
		}
	}

	return files;
}

const phpBinary = resolvePhpBinary();
const phpFiles = collectPhpFiles( root ).sort();
let hasErrors = false;

console.log( `Using PHP: ${ phpBinary }` );

for ( const file of phpFiles ) {
	const result = runPhp( phpBinary, [ '-l', file ], { stdio: 'inherit' } );

	if ( result.error ) {
		throw new Error( `Unable to run PHP lint with ${ phpBinary }: ${ result.error.message }` );
	}

	if ( result.status !== 0 ) {
		hasErrors = true;
	}
}

if ( hasErrors ) {
	process.exitCode = 1;
} else {
	console.log( `PHP syntax validated: ${ phpFiles.length } files.` );
}
