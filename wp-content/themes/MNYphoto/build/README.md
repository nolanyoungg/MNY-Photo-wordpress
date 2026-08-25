# Build Directory

This document describes the build system that currently exists in the
`MNYphoto` theme. It is based on the executable source files in this
repository—not on historical build plans or older documentation.

The build directory contains Node.js scripts. The scripts are invoked by the
npm commands in [`../package.json`](../package.json#L5-L18), and they operate on
the theme root one directory above this folder.

## Source-of-truth files

The current build system is defined by these files:

| File | Actual responsibility |
| --- | --- |
| [`webpack.config.js`](./webpack.config.js#L1-L50) | Defines the Webpack entry point, SCSS loader chain, generated output paths, cleanup behavior, source-map behavior, and production optimization. |
| [`lint-php.js`](./lint-php.js#L1-L152) | Finds a usable PHP executable and runs PHP's `-l` syntax check against every PHP file under the theme, excluding `node_modules` and `vendor`. |
| [`validate.js`](./validate.js#L1-L80) | Verifies required runtime files, required template parts, template-part locations/names, and `Template Name:` headers in page-template files. |
| [`package-theme.js`](./package-theme.js#L1-L151) | Creates and validates a production ZIP from an explicit runtime-file allowlist. |
| [`test-theme.js`](./test-theme.js#L1) | Provides a separate one-line manual check for a few `functions.php` includes and directly nested template-part filenames. No current npm script invokes it. |

The build directory itself does not contain the theme's source JavaScript,
SCSS, PHP templates, or browser assets. Those live in `../src`, `..`, and
`../dist`, respectively.

## Where commands run

Run the npm commands from the theme root, not from inside `build/`:

```text
wp-content/themes/MNYphoto/
├── package.json
├── package-lock.json
├── build/
├── src/
└── dist/
```

The npm scripts use paths such as `build/webpack.config.js`, `build/validate.js`,
and `build/lint-php.js` relative to the theme root. The scripts themselves
resolve the theme root with `join(__dirname, '..')` or
`path.resolve(__dirname, '..')`; see [`validate.js`](./validate.js#L4-L5),
[`lint-php.js`](./lint-php.js#L8), and
[`package-theme.js`](./package-theme.js#L7-L10).

Install the locked dependencies before running the commands:

```powershell
npm ci
```

The manifest is marked private and does not declare an `engines` field. Its
development dependencies are the tools used by the current scripts:

```json
"devDependencies": {
  "archiver": "^8.0.0",
  "css-loader": "^7.1.2",
  "mini-css-extract-plugin": "^2.9.2",
  "sass": "^1.86.0",
  "sass-loader": "^16.0.5",
  "webpack": "5.100.2",
  "webpack-cli": "^6.0.1"
}
```

This declaration is in [`../package.json`](../package.json#L11-L18). The
lockfile records the dependency graph and its root package declaration at
[`../package-lock.json`](../package-lock.json#L1-L18).

## npm command map

The complete current script map is in
[`../package.json`](../package.json#L5-L9):

| Command | Exact script | What it does |
| --- | --- | --- |
| `npm run dev` | `webpack --config build/webpack.config.js --mode development --watch` | Runs Webpack in development mode and keeps watching for changes. It does not invoke PHP linting or `validate.js`. |
| `npm run build` | `webpack --config build/webpack.config.js --mode production && node build/validate.js` | Creates the production CSS and JavaScript bundles, then runs the theme-structure validator only if Webpack exits successfully. |
| `npm run lint:php` | `node build/lint-php.js` | Resolves PHP and syntax-checks the theme's PHP files with `php -l`. |
| `npm run package` | `node build/package-theme.js --preflight && npm run build && node build/package-theme.js` | Checks the ZIP destination, builds and validates production assets, then creates and validates the runtime ZIP. |

There is no `npm test` script in the current manifest. The file
`build/test-theme.js` exists, but it is not referenced by any current npm
script.

## Complete build flow

The normal production command follows this sequence:

```text
npm run build
    │
    ├── webpack --config build/webpack.config.js --mode production
    │       │
    │       ├── reads src/js/main.js
    │       ├── follows the JavaScript module imports
    │       ├── follows the main.scss Sass imports
    │       ├── writes dist/js/bundle.js
    │       └── writes dist/css/bundle.css
    │
    └── node build/validate.js
            └── checks required theme files and template structure
```

The `&&` in the manifest means `validate.js` is not started when Webpack
fails. The build command is therefore an asset build followed by a structural
check; it is not a PHP syntax check and it is not a browser/runtime test.

## Webpack entrypoint and dependency graph

The configuration has one Webpack entrypoint:

```js
entry: path.resolve( __dirname, '../src/js/main.js' ),
```

This is [`webpack.config.js`](./webpack.config.js#L8-L10). There is no second
CSS entrypoint in the current configuration. SCSS enters the Webpack graph
because the JavaScript entrypoint imports it at
[`../src/js/main.js`](../src/js/main.js#L1):

```js
import '../scss/main.scss';
```

The JavaScript entrypoint also imports these modules at
[`../src/js/main.js`](../src/js/main.js#L3-L12):

```js
import { initAccordions } from './components/accordion';
import { initArticleContents, initCopyArticleLink } from './components/article-contents';
import { initMetrics } from './components/metrics';
import { initHomeExperience } from './components/home-experience';
import { initReadingProgress } from './components/reading-progress';
import { initReveal } from './components/reveal';
import { initServiceDirectory } from './components/service-directory';
import { initSiteNavigation } from './components/site-navigation';
import { initTabs } from './components/tabs';
import { initWorkFilter } from './components/work-filter';
```

Those imports make the reachable JavaScript modules part of the bundle. The
entrypoint then calls the imported initializers from a `DOMContentLoaded`
handler at [`../src/js/main.js`](../src/js/main.js#L14-L27).

Some reachable components import utilities of their own. For example,
`metrics.js`, `home-experience.js`, `reveal.js`, and
`service-directory.js` import `../utilities/prefers-reduced-motion`, while
`site-navigation.js` imports `../utilities/focus-trap`.

Two source files currently exist but are not imported by `main.js` or another
reachable module:

- [`../src/js/components/modal.js`](../src/js/components/modal.js#L1-L2)
  exports `initModals`, but `main.js` does not import or call it.
- [`../src/js/utilities/debounce.js`](../src/js/utilities/debounce.js#L1)
  exports `debounce`, but no current source import reaches it.

The build configuration does not automatically bundle every file in `src/js`.
It bundles the dependency graph reachable from `src/js/main.js`.

## Sass entrypoint and dependency graph

The SCSS entrypoint is [`../src/scss/main.scss`](../src/scss/main.scss#L1-L16):

```scss
@use 'base/globalelements';
@use 'base/typography';
@use 'components/buttons';
@use 'components/forms';
@use 'components/cards';
@use 'layout/header';
@use 'layout/footer';
@use 'pages/front-page';
@use 'pages/home';
@use 'pages/contact-us';
@use 'pages/services';
@use 'pages/about-us';
@use 'pages/work';
@use 'pages/blog';
@use 'pages/ppc';
@use 'pages/error';
```

The Sass source currently uses `.scss` files. The Webpack rule accepts both
`.scss` and `.sass` extensions because its test is
`/\.s[ac]ss$/i` at [`webpack.config.js`](./webpack.config.js#L18-L22).

The shared Sass layer is exposed by
[`../src/scss/abstracts/_index.scss`](../src/scss/abstracts/_index.scss#L1-L2):

```scss
@forward 'variables';
@forward 'mixins';
```

The base, component, layout, and page files that need those shared values use
`@use '../abstracts' as *;` or the more specific variables module. The `@use`
statements are the Sass dependency graph; Webpack does not discover unrelated
SCSS files merely because they exist in the directory.

## Webpack configuration in detail

The active configuration is [`webpack.config.js`](./webpack.config.js#L1-L50).

### Mode selection

The exported configuration function reads `argv.mode` and defaults to
`production` when no mode is supplied:

```js
module.exports = ( _env, argv = {} ) => {
  const mode = argv.mode || 'production';
  const isProduction = mode === 'production';
```

This is [`webpack.config.js`](./webpack.config.js#L4-L6). The npm scripts pass
the mode explicitly: `development` for `npm run dev` and `production` for
`npm run build`.

### Output location and cleanup

Webpack writes into the theme's `dist` directory:

```js
output: {
  filename: 'js/bundle.js',
  path: path.resolve( __dirname, '../dist' ),
```

The output settings are at [`webpack.config.js`](./webpack.config.js#L11-L17).
The JavaScript output is therefore `dist/js/bundle.js`.

The same output block enables Webpack's cleaning behavior and preserves paths
whose path contains an `images` or `icons` directory:

```js
clean: {
  keep: /(?:^|[\\/])(images|icons)(?:[\\/]|$)/,
},
```

The build does not copy those static assets. It preserves the existing
`dist/images` and `dist/icons` paths while cleaning generated output elsewhere
under `dist`.

### SCSS loader chain

The configuration applies this rule to Sass files:

```js
{
  test: /\.s[ac]ss$/i,
  use: [
    MiniCssExtractPlugin.loader,
    {
      loader: 'css-loader',
      options: { sourceMap: ! isProduction },
    },
    {
      loader: 'sass-loader',
      options: {
        implementation: require( 'sass' ),
        sassOptions: {
          style: isProduction ? 'compressed' : 'expanded',
        },
        sourceMap: ! isProduction,
      },
    },
  ],
}
```

This is [`webpack.config.js`](./webpack.config.js#L18-L41). In the current
pipeline:

1. `sass-loader` uses the `sass` package to process the SCSS dependency graph.
2. `css-loader` processes the resulting CSS for Webpack.
3. `MiniCssExtractPlugin.loader` makes the CSS an extracted stylesheet asset
   instead of leaving it inline in the JavaScript output.

The configuration does not use a separate Sass CLI command. Sass runs through
Webpack's `sass-loader`.

`MiniCssExtractPlugin` is configured to write the extracted stylesheet here:

```js
new MiniCssExtractPlugin( { filename: 'css/bundle.css' } )
```

That line is [`webpack.config.js`](./webpack.config.js#L42-L44), so the CSS
output is `dist/css/bundle.css`.

### Development versus production assets

The Sass style setting is `expanded` in development and `compressed` in
production at [`webpack.config.js`](./webpack.config.js#L29-L36).

The configuration also enables Webpack minimization only for production:

```js
optimization: {
  minimize: isProduction,
},
```

This is [`webpack.config.js`](./webpack.config.js#L45-L47). The production
configuration therefore requests Webpack optimization for JavaScript and
compressed Sass output for CSS. There is no separately configured CSS
minimizer plugin in the current configuration.

Development source maps are enabled by both loader options and Webpack's
`devtool` setting. Production source maps are disabled:

```js
devtool: isProduction ? false : 'source-map',
```

This is [`webpack.config.js`](./webpack.config.js#L48). The theme's nested
[`.gitignore`](../.gitignore#L3-L4) also ignores `/dist/**/*.map`.

## `lint-php.js`: PHP syntax validation

`npm run lint:php` invokes [`lint-php.js`](./lint-php.js#L1-L152). The script
does not use a PHP coding-standard package, WordPress runtime, database, or
browser. It invokes a PHP executable with the `-l` command-line option.

### PHP executable resolution

The script resolves PHP in this order:

1. If `PHP_BINARY` is set, it trims that value, checks it with `--version`,
   and uses it. An invalid configured path throws an error at
   [`lint-php.js`](./lint-php.js#L86-L95).
2. If `php` is available on `PATH`, it uses that binary at
   [`lint-php.js`](./lint-php.js#L97-L99).
3. If neither is available, it searches standard Local development-runtime
   directories. The roots are built for Windows, macOS, and Linux at
   [`lint-php.js`](./lint-php.js#L34-L55).
4. On Windows it checks Local `php-*` services in architecture-specific
   directories for both `php.exe` and `php-cgi.exe`; see
   [`lint-php.js`](./lint-php.js#L57-L83).
5. If no working binary is found, the script throws an error explaining that
   `PHP_BINARY` can be set to the full executable path; see
   [`lint-php.js`](./lint-php.js#L101-L113).

### PHP files included in the check

The script recursively walks the theme root at
[`lint-php.js`](./lint-php.js#L116-L127). It collects every file whose name
ends in `.php`, while skipping directories named `node_modules` and `vendor`.
That includes PHP files in the theme root, `inc/`, `page-templates/`, and
`template-parts/`.

Each collected file is checked independently with:

```js
runPhp( phpBinary, [ '-l', file ], { stdio: 'inherit' } );
```

The loop is at [`lint-php.js`](./lint-php.js#L130-L145). A PHP process with a
non-zero status sets `hasErrors` to `true`. After all files are attempted, the
script sets `process.exitCode = 1` when any check failed; otherwise it reports
the number of validated files at [`lint-php.js`](./lint-php.js#L148-L152).

This means the script checks PHP syntax. It does not prove that WordPress can
load the theme, that template output renders correctly, or that PHP behavior
is correct at runtime.

## `validate.js`: theme structure validation

The production npm build invokes [`validate.js`](./validate.js#L1-L80) after
Webpack. It validates file presence and naming conventions; it does not parse
or execute PHP, inspect CSS, inspect JavaScript behavior, or open a WordPress
installation.

### Required runtime files

The validator requires these paths to exist at the theme root:

```js
const requiredRuntimeFiles = [
  'style.css', 'functions.php', 'index.php', 'header.php', 'footer.php',
  'dist/css/bundle.css', 'dist/js/bundle.js',
];
```

This list is [`validate.js`](./validate.js#L4-L9). Missing entries cause an
error at [`validate.js`](./validate.js#L42-L45).

### Required template-part inventory

The `pageParts` object defines the expected page folders and suffixes at
[`validate.js`](./validate.js#L11-L20):

| Folder | Required suffixes |
| --- | --- |
| `page-front-page` | `hero`, `services`, `work`, `process`, `cta` |
| `page-services` | `hero`, `sect01`, `sect02`, `sect03`, `sect04`, `sect05`, `sect06`, `cta` |
| `page-about-us` | `hero`, `sect01`, `sect02`, `sect03`, `sect04`, `sect05`, `cta` |
| `page-work` | `hero`, `sect01`, `sect02`, `sect03`, `sect04`, `sect05`, `cta` |
| `page-blog` | `hero`, `page-grid`, `cta-bottom`, `single-hero`, `single-page`, `single-next-blog`, `single-cta-bottom` |
| `page-contact-us` | `hero`, `sect01`, `sect02`, `sect03`, `sect04`, `sect05`, `cta` |
| `page-ppc-lp-2026` | `hero`, `sect01`, `sect02`, `sect03`, `sect04`, `sect05`, `cta` |
| `page-404` | `hero`, `sect01`, `sect02`, `cta` |

The `pagePrefixes` object maps each folder to the filename prefix at
[`validate.js`](./validate.js#L22-L31). The script constructs each required
path as:

```text
template-parts/<page-folder>/content-<page-prefix>-<suffix>.php
```

That construction is at [`validate.js`](./validate.js#L33-L35). Missing paths
are reported at [`validate.js`](./validate.js#L59-L62).

### Location and naming rules

The validator rejects a root-level PHP file named `content-*.php` at
[`validate.js`](./validate.js#L47-L50). It also rejects a PHP file placed
directly inside `template-parts/` rather than inside a `page-*` directory at
[`validate.js`](./validate.js#L52-L57).

Every PHP file found recursively under `template-parts/` must match this
regular expression:

```text
^page-[a-z0-9-]+[\\/]content-[a-z0-9-]+\.php$
```

The executable check is at [`validate.js`](./validate.js#L64-L70). In practical
terms, a valid relative path has a `page-...` directory followed by a file
whose name begins with `content-` and ends in `.php`, using lowercase letters,
digits, and hyphens.

### Page-template headers

The validator reads every `.php` file directly inside `page-templates/` and
requires the file contents to include the literal string `Template Name:`.
That check is at [`validate.js`](./validate.js#L72-L77). It does not validate the
value after the header or compare it to a WordPress page assignment.

## `package-theme.js`: runtime ZIP packaging

`npm run package` invokes [`package-theme.js`](./package-theme.js#L1-L151). The
script uses Node's filesystem/path APIs and `ZipArchive` from the `archiver`
dependency at [`package-theme.js`](./package-theme.js#L3-L5).

### Destination and filename

The script defines:

```js
const root = path.resolve(__dirname, '..');
const slug = 'MNYphoto-theme';
const packageDirectory = path.resolve(root, '..', '..', 'zipped-theme');
const outputPath = path.join(packageDirectory, `${slug}.zip`);
```

Those values are at [`package-theme.js`](./package-theme.js#L7-L10). With the
current theme location, the generated file is:

```text
wp-content/zipped-theme/MNYphoto-theme.zip
```

The ZIP's internal top-level directory is `MNYphoto-theme/`, not the current
directory name `MNYphoto/`. The `slug` is prepended when source files are
listed and when archive destinations are created at
[`package-theme.js`](./package-theme.js#L32-L43) and
[`package-theme.js`](./package-theme.js#L140-L148).

### Runtime allowlist

The package is not a copy of the entire Git checkout. The script explicitly
allows only these runtime entries at [`package-theme.js`](./package-theme.js#L12-L18):

```js
const runtimeEntries = [
  '404.php', 'archive.php', 'comments.php', 'footer.php', 'front-page.php',
  'functions.php', 'header.php', 'home.php', 'inc', 'index.php', 'languages',
  'page-templates', 'page.php', 'readme.txt', 'screenshot.png',
  'search.php', 'searchform.php', 'sidebar.php', 'single.php', 'style.css',
  'template-parts', 'dist/css', 'dist/js', 'dist/images', 'dist/icons',
];
```

The allowlist includes the compiled assets and runtime PHP/theme files. It
does not include `src/`, `build/`, `node_modules/`, `package.json`,
`package-lock.json`, `README.md`, or `build/README.md`.

When an allowlisted entry is a directory, the script archives that directory
recursively using `archive.directory`; when it is a file, it uses
`archive.file`. That behavior is at [`package-theme.js`](./package-theme.js#L140-L148).
The packaging script does not apply `.gitignore` or `.deployignore` rules.
It uses `runtimeEntries` as its own inventory.

Because `dist/css` and `dist/js` are allowlisted directories, every file
physically present inside those directories at packaging time is part of the
archive inventory. The production build's cleanup and source-map settings are
therefore relevant before packaging.

### Preflight mode

The `--preflight` argument is detected at
[`package-theme.js`](./package-theme.js#L11). Before doing anything else, the
script verifies that the package destination exists or can be created, is a
directory, and is writable. That is implemented by
[`package-theme.js`](./package-theme.js#L20-L30).

When `--preflight` is present, the script prints the ready destination and
exits successfully at [`package-theme.js`](./package-theme.js#L96-L101). It
does not check every runtime entry and it does not create a ZIP in preflight
mode.

### Normal packaging mode

Without `--preflight`, the script checks that every allowlisted source entry
exists at [`package-theme.js`](./package-theme.js#L103-L108). It then writes to
a temporary path:

```text
wp-content/zipped-theme/MNYphoto-theme.zip.partial
```

The temporary path and compressed archive creation are defined at
[`package-theme.js`](./package-theme.js#L110-L115). The final ZIP is not renamed
into place until archive inventory validation succeeds.

### Archive validation

The script reads the generated ZIP directly and parses its central-directory
records in `listArchiveFiles` at [`package-theme.js`](./package-theme.js#L45-L77).
It then compares three inventories in `validateArchiveInventory`:

- `invalidRoots`: archive files that are not under `MNYphoto-theme/`.
- `missingEntries`: allowlisted source files absent from the archive.
- `extraEntries`: archive files that were not produced from the allowlist.

That comparison is at [`package-theme.js`](./package-theme.js#L80-L94). Any
non-empty result throws an inventory-validation error. On output or archive
failure, the `.partial` file is removed by the cleanup handler at
[`package-theme.js`](./package-theme.js#L116-L138). On success, the temporary
file is renamed to `MNYphoto-theme.zip` at
[`package-theme.js`](./package-theme.js#L126-L134).

### Package command order

The npm command runs the phases in this exact order:

```text
node build/package-theme.js --preflight
    ↓
npm run build
    ↓
node build/package-theme.js
```

This is the exact value of `scripts.package` in
[`../package.json`](../package.json#L9). Consequently, a normal package
operation first checks the destination, then regenerates production assets and
runs `validate.js`, then creates and validates the ZIP.

## `test-theme.js`: separate manual check

[`test-theme.js`](./test-theme.js#L1) is not part of `npm run build`,
`npm run lint:php`, or `npm run package`. It can be invoked directly with:

```powershell
node build/test-theme.js
```

Its one-line implementation does two checks:

1. It reads `functions.php` and verifies that the text contains the strings
   `setup.php`, `enqueue.php`, and `customizer.php`.
2. It reads the immediate entries returned by `readdirSync(root/template-parts)`
   and fails if any directly nested PHP filename does not start with
   `content-`.

It then prints `Production checks passed.`. The implementation does not recurse
through page folders, does not check the required part inventory, and does not
check PHP syntax. Those broader structural checks are implemented separately
by `validate.js`.

## WordPress runtime boundary

The build scripts create the files that WordPress loads; they do not enqueue
assets themselves. The runtime connection is in
[`../inc/enqueue.php`](../inc/enqueue.php#L10-L35).

The theme obtains the generated file paths with:

```php
$css_path = get_theme_file_path( '/dist/css/bundle.css' );
$js_path  = get_theme_file_path( '/dist/js/bundle.js' );
```

It enqueues the stylesheet at `css/bundle.css` and the script at
`js/bundle.js` through `nytt99_asset_url` at
[`../inc/enqueue.php`](../inc/enqueue.php#L10-L24). That helper prepends the
theme's `dist/` directory at [`../inc/helpers.php`](../inc/helpers.php#L10-L12).

The PHP code uses each generated file's modification time as its WordPress
asset version when the file exists. The JavaScript is registered with
`strategy => defer`, and the theme adds a small inline script before the bundle
to switch the document from `no-js` to `js`; see
[`../inc/enqueue.php`](../inc/enqueue.php#L14-L30).

`functions.php` loads `inc/enqueue.php` once through the `$nytt99_includes`
array and `require_once` loop at
[`../functions.php`](../functions.php#L10-L22). Therefore the generated
`dist/css/bundle.css` and `dist/js/bundle.js` are consumed by WordPress only
when the theme's PHP bootstrap and enqueue hook are loaded.

Webpack does not generate the static image/icon directories. It preserves them
during Webpack output cleanup, and the runtime ZIP script includes them through
its allowlist. A current template also builds image URLs directly from
`dist/images`, for example at
[`../template-parts/page-front-page/content-front-page-work.php`](../template-parts/page-front-page/content-front-page-work.php#L27-L33).

## GitHub Actions integration

The repository currently has one combined workflow at
[`../../../../.github/workflows/build.yml`](../../../../.github/workflows/build.yml#L1-L38).
It runs on pull requests targeting `production` at
[`../../../../.github/workflows/build.yml`](../../../../.github/workflows/build.yml#L3-L6),
uses the theme root as its working directory at
[`../../../../.github/workflows/build.yml`](../../../../.github/workflows/build.yml#L16-L18),
and performs these steps in order:

```text
checkout
  ↓
Node.js 22 and npm cache
  ↓
npm ci
  ↓
npm run lint:php
  ↓
npm run build
```

The exact workflow steps are at
[`../../../../.github/workflows/build.yml`](../../../../.github/workflows/build.yml#L20-L38).
The workflow therefore runs PHP syntax validation before Webpack and the
structural validator. It does not run `npm run package`, create a ZIP, upload
an artifact, call the Pressable API, commit generated files, or push changes.

## What each command does not do

Keeping these boundaries clear prevents one check from being mistaken for
another:

| Command | Does | Does not do |
| --- | --- | --- |
| `npm run dev` | Watches the Webpack source graph in development mode. | Does not run PHP linting, `validate.js`, or ZIP packaging. |
| `npm run build` | Builds production CSS/JavaScript, then validates the theme structure. | Does not run `lint-php.js`, package a ZIP, or perform browser testing. |
| `npm run lint:php` | Runs `php -l` against collected PHP files. | Does not build assets or validate WordPress behavior. |
| `npm run package` | Preflights the destination, runs the production build, and creates/validates the runtime ZIP. | Does not deploy the ZIP or call a hosting API. |
| `node build/test-theme.js` | Runs its two narrow text/directory checks. | Is not automatically invoked and is not the main structural validator. |

## Safe change points

The current dependency graph determines where a change must be made:

- Change browser JavaScript in `../src/js`. To include a module in the
  production bundle, make it reachable from
  [`../src/js/main.js`](../src/js/main.js#L1-L12).
- Change styles in `../src/scss`. To include a stylesheet module in the CSS
  bundle, make it reachable from
  [`../src/scss/main.scss`](../src/scss/main.scss#L1-L16).
- Do not treat `../dist/css/bundle.css` or `../dist/js/bundle.js` as source
  entrypoints. They are the paths written by Webpack and later read by
  [`../inc/enqueue.php`](../inc/enqueue.php#L10-L24).
- When adding a required template part, update the files and naming expected by
  [`validate.js`](./validate.js#L11-L35), not only the visual template code.
- When adding a runtime file to the production ZIP, add it to the explicit
  `runtimeEntries` allowlist in [`package-theme.js`](./package-theme.js#L12-L18).

The build directory is development/tooling code. The root
[`.deployignore`](../../../../.deployignore#L1-L4) excludes `wp-content/themes/MNYphoto/build/`
from live deployment, while `package-theme.js` independently chooses its
runtime ZIP contents through `runtimeEntries`.
