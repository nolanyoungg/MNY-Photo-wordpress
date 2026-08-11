const { existsSync, readFileSync, readdirSync } = require( 'node:fs' );
const { join, relative } = require( 'node:path' );

const root = join( __dirname, '..' );
const templatePartsDirectory = join( root, 'template-parts' );
const requiredRuntimeFiles = [
  'style.css', 'functions.php', 'index.php', 'header.php', 'footer.php',
  'dist/css/bundle.css', 'dist/js/bundle.js',
];

const pageParts = {
  'page-front-page': [ 'hero', 'services', 'work', 'process', 'cta' ],
  'page-services': [ 'hero', 'sect01', 'sect02', 'sect03', 'sect04', 'sect05', 'sect06', 'cta' ],
  'page-about-us': [ 'hero', 'sect01', 'sect02', 'sect03', 'sect04', 'sect05', 'cta' ],
  'page-work': [ 'hero', 'sect01', 'sect02', 'sect03', 'sect04', 'sect05', 'cta' ],
  'page-blog': [ 'hero', 'page-grid', 'cta-bottom', 'single-hero', 'single-page', 'single-next-blog', 'single-cta-bottom' ],
  'page-contact-us': [ 'hero', 'sect01', 'sect02', 'sect03', 'sect04', 'sect05', 'cta' ],
  'page-ppc-lp-2026': [ 'hero', 'sect01', 'sect02', 'sect03', 'sect04', 'sect05', 'cta' ],
  'page-404': [ 'hero', 'sect01', 'sect02', 'cta' ],
};

const pagePrefixes = {
  'page-front-page': 'front-page',
  'page-services': 'services',
  'page-about-us': 'about-us',
  'page-work': 'work',
  'page-blog': 'blog',
  'page-contact-us': 'contact-us',
  'page-ppc-lp-2026': 'ppc-lp-2026',
  'page-404': '404',
};

const requiredTemplateParts = Object.entries( pageParts ).flatMap( ( [ directory, parts ] ) =>
  parts.map( ( part ) => `${ directory }/content-${ pagePrefixes[ directory ] }-${ part }.php` )
);

const getFilesRecursively = ( directory ) => readdirSync( directory, { withFileTypes: true } ).flatMap( ( entry ) => {
  const entryPath = join( directory, entry.name );
  return entry.isDirectory() ? getFilesRecursively( entryPath ) : [ entryPath ];
} );

const missingRuntimeFiles = requiredRuntimeFiles.filter( ( file ) => !existsSync( join( root, file ) ) );
if ( missingRuntimeFiles.length ) {
  throw new Error( `Missing runtime files: ${ missingRuntimeFiles.join( ', ' ) }` );
}

const rootContentFiles = readdirSync( root ).filter( ( file ) => /^content-.+\.php$/.test( file ) );
if ( rootContentFiles.length ) {
  throw new Error( `Template-part files must live in template-parts/: ${ rootContentFiles.join( ', ' ) }` );
}

const unexpectedRootParts = readdirSync( templatePartsDirectory, { withFileTypes: true } )
  .filter( ( entry ) => entry.isFile() && entry.name.endsWith( '.php' ) )
  .map( ( entry ) => entry.name );
if ( unexpectedRootParts.length ) {
  throw new Error( `Template parts must live in a page-* folder: ${ unexpectedRootParts.join( ', ' ) }` );
}

const missingTemplateParts = requiredTemplateParts.filter( ( file ) => !existsSync( join( templatePartsDirectory, file ) ) );
if ( missingTemplateParts.length ) {
  throw new Error( `Missing required template parts: ${ missingTemplateParts.join( ', ' ) }` );
}

const templateParts = getFilesRecursively( templatePartsDirectory ).filter( ( file ) => file.endsWith( '.php' ) );
const invalidPartNames = templateParts
  .map( ( file ) => relative( templatePartsDirectory, file ) )
  .filter( ( file ) => !/^page-[a-z0-9-]+[\\/]content-[a-z0-9-]+\.php$/.test( file ) );
if ( invalidPartNames.length ) {
  throw new Error( `Template part naming violation: ${ invalidPartNames.join( ', ' ) }` );
}

const templates = readdirSync( join( root, 'page-templates' ) ).filter( ( file ) => file.endsWith( '.php' ) );
for ( const file of templates ) {
  const template = readFileSync( join( root, 'page-templates', file ), 'utf8' );
  if ( !template.includes( 'Template Name:' ) ) {
    throw new Error( `${ file } has no Template Name header.` );
  }
}

console.log( `Theme structure validated: ${ templateParts.length } template parts across ${ Object.keys( pageParts ).length } page folders.` );
