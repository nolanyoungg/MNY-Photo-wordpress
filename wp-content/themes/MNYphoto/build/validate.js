const { existsSync, readFileSync, readdirSync } = require( 'node:fs' );
const { join, relative } = require( 'node:path' );

const root = join( __dirname, '..' );
const templatePartsDirectory = join( root, 'template-parts' );
const requiredRuntimeFiles = [
  '404.php', 'archive.php', 'comments.php', 'footer.php', 'front-page.php',
  'functions.php', 'header.php', 'home.php', 'index.php', 'page.php',
  'search.php', 'searchform.php', 'sidebar.php', 'single.php', 'style.css',
  'readme.txt', 'screenshot.png',
  'dist/css/bundle.css', 'dist/js/bundle.js',
];
const requiredPageTemplates = [
  'about-us', 'contact-us', 'ppc-lp-2026', 'privacy-policy', 'services', 'work',
].map( ( page ) => `page-templates/page-template-${ page }.php` );
const requiredIncFiles = [
  'contact.php', 'customizer.php', 'enqueue.php', 'helpers.php',
  'navigation.php', 'setup.php', 'template-tags.php',
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
  if ( [ 'node_modules', 'vendor', '.git' ].includes( entry.name ) ) return [];
  const entryPath = join( directory, entry.name );
  return entry.isDirectory() ? getFilesRecursively( entryPath ) : entry.isFile() ? [ entryPath ] : [];
} );

const missingRuntimeFiles = [ ...requiredRuntimeFiles, ...requiredPageTemplates,
  ...requiredIncFiles.map( ( file ) => `inc/${ file }` ),
].filter( ( file ) => !existsSync( join( root, file ) ) );
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

const incDirectory = join( root, 'inc' );
const incFiles = readdirSync( incDirectory ).filter( ( file ) => file.endsWith( '.php' ) );
const functionsSource = readFileSync( join( root, 'functions.php' ), 'utf8' );
for ( const file of incFiles ) {
  if ( !requiredIncFiles.includes( file ) ) throw new Error( `Unexpected inc module: ${ file }` );
  if ( !readFileSync( join( incDirectory, file ), 'utf8' ).startsWith( '<?php' ) ) {
    throw new Error( `PHP-only inc file must start with <?php: ${ file }` );
  }
  if ( !functionsSource.includes( `'/inc/${ file }'` ) ) {
    throw new Error( `Theme inc file is not loaded by functions.php: ${ file }` );
  }
}

const phpFiles = getFilesRecursively( root ).filter( ( file ) => file.endsWith( '.php' ) );
const pluginTerritoryPatterns = [
  /\b(?:add_shortcode|register_post_type|register_rest_route|register_taxonomy|wp_schedule_event|wp_schedule_single_event)\s*\(/,
  /\b(?:add|delete|update)_option\s*\(/,
  /\$wpdb\b/,
  /add_(?:action|filter)\(\s*['"](?:wp_ajax_|wp_privacy_personal_data_)/,
  /add_filter\(\s*['"](?:wp_robots|wp_sitemaps_[^'"]+)['"]/,
];
for ( const file of phpFiles ) {
  const source = readFileSync( file, 'utf8' );
  const label = relative( root, file );
  for ( const reference of source.matchAll( /get_template_part\(\s*'([^']+)'(?:\s*,\s*'([^']+)')?/g ) ) {
    const target = reference[ 2 ] ? `${ reference[ 1 ] }-${ reference[ 2 ] }.php` : `${ reference[ 1 ] }.php`;
    if ( !existsSync( join( root, target ) ) ) throw new Error( `Missing get_template_part target: ${ label } -> ${ target }` );
  }
  if ( /add_rewrite_rule\s*\(|add_filter\(\s*['"]post_link['"]/.test( source ) ) {
    throw new Error( `Theme-owned rewrite/post-link behavior is not allowed: ${ label }` );
  }
  // Preserve MNY Photo's existing project-brief integration in its owning module.
  const misplacedContact = file !== join( incDirectory, 'contact.php' ) &&
    /\bwp_mail\s*\(|add_action\(\s*['"]admin_post_/.test( source );
  if ( misplacedContact || pluginTerritoryPatterns.some( ( pattern ) => pattern.test( source ) ) ) {
    throw new Error( `Portable site behavior exceeds MNY Photo's existing contact integration: ${ label }` );
  }
}

const manifest = JSON.parse( readFileSync( join( root, 'package.json' ), 'utf8' ) );
const lock = JSON.parse( readFileSync( join( root, 'package-lock.json' ), 'utf8' ) );
const style = readFileSync( join( root, 'style.css' ), 'utf8' );
const versions = [ style.match( /^Version:\s*(.+)$/m )?.[ 1 ]?.trim(),
  manifest.version, lock.version, lock.packages?.[ '' ]?.version ];
if ( versions.some( ( version ) => !version ) || new Set( versions ).size !== 1 ) {
  throw new Error( `Theme versions are not aligned: ${ versions.join( ', ' ) }` );
}

const mainSource = readFileSync( join( root, 'src/js/main.js' ), 'utf8' );
const importedInitializers = new Set( [ ...mainSource.matchAll( /import\s*\{([^}]+)\}\s*from/g ) ]
  .flatMap( ( match ) => match[ 1 ].split( ',' ) ).map( ( name ) => name.trim() ) );
const calledInitializers = [ ...mainSource.matchAll( /\b(init[A-Z][A-Za-z0-9_]*)\s*\(/g ) ].map( ( match ) => match[ 1 ] );
const undefinedInitializers = calledInitializers.filter( ( name ) => !importedInitializers.has( name ) );
if ( undefinedInitializers.length ) {
  throw new Error( `JavaScript initializers are called without imports: ${ undefinedInitializers.join( ', ' ) }` );
}

console.log( `Theme structure validated: ${ templateParts.length } template parts, ${ templates.length } page templates, ${ incFiles.length } inc modules, references and versions.` );
