=== MNYphoto-theme ===
Contributors: nolan-young
Tags: custom-background, custom-logo, custom-menu, featured-images, threaded-comments, translation-ready
Requires at least: 6.3
Tested up to: 7.0
Requires PHP: 7.4
Stable tag: 0.0.1
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

MNYphoto-theme is an accessible, classic WordPress theme for a studio-style digital agency site. The current installation includes demonstration content and placeholder project information that must be replaced before production use.

== Installation ==

1. Upload the complete MNYphoto theme folder to wp-content/themes/, or upload the ZIP created by the development package command through Appearance > Themes > Add New > Upload Theme.
2. Activate MNYphoto-theme.
3. Set the site identity and logo under Appearance > Customize.
4. Assign menus to Primary navigation and Footer navigation under Appearance > Menus.
5. Create the site's pages and assign the supplied page templates where appropriate.
6. Replace all demonstration copy, project information, contact details, links, and placeholder media before launch.

== Theme setup ==

The theme registers the following WordPress features:

* Document titles, featured images, custom logos, HTML5 markup, responsive embeds, wide alignment, and automatic feed links.
* Primary navigation and Footer navigation menu locations.
* A Blog sidebar widget area.
* A customizer integration for theme settings.

The project brief form on the Contact Us page validates and sanitizes its fields, uses a WordPress nonce, rejects submissions that populate the honeypot field, and sends valid submissions to the site administrator configured in WordPress. Reliable mail delivery still depends on the site's WordPress mail configuration.

== Included page templates ==

The theme includes these assignable page templates:

* About Us
* Services
* Work
* Contact Us
* PPC Landing Page 2026
* Privacy Policy

The theme also includes standard templates for the front page, blog index, archives, individual posts, search results, comments, the sidebar, and the 404 page.

On a clean installation, the theme can provide fallback responses for /services/, /about-us/, /work/, /contact-us/, /ppc-lp-2026/, /journal/, and /blog/ when a matching published Page does not yet exist. A published WordPress Page takes precedence once it is created.

== Accessibility ==

The theme includes a skip link, semantic landmarks, labeled navigation controls, visible focus styles, keyboard-aware menu behavior, a responsive mobile navigation, and reduced-motion handling. Site owners and editors remain responsible for accessible content, meaningful alternative text, heading structure, link text, color contrast, and accessible form copy.

== Front-end behavior ==

The bundled JavaScript supports the site's navigation and mega menus, accordions, tabs, article contents, copy-article-link controls, work filtering, service-directory interactions, reading progress, reveal effects, metrics, and the home-page experience.

Source JavaScript is organized under src/js/ and source Sass under src/scss/. Webpack follows src/js/main.js and its build-time import of src/scss/main.scss, then generates these two separate WordPress assets:

* dist/js/bundle.js
* dist/css/bundle.css

The Sass import does not combine CSS with the browser JavaScript. sass-loader compiles the Sass, and MiniCssExtractPlugin writes the extracted CSS to the existing dist/css/bundle.css path. The theme's PHP enqueue module loads the CSS and JavaScript separately, uses file modification times for cache-busting versions, and defers the JavaScript bundle.

== Development ==

Run these commands from the MNYphoto theme directory, not the repository root:

* npm ci installs the exact dependency tree recorded in package-lock.json.
* npm run dev watches source JavaScript and Sass files with Webpack in development mode.
* npm run build creates compressed production CSS and an optimized production JavaScript bundle, then validates the theme structure.
* npm run lint:php checks PHP syntax across the theme with php -l.
* npm run package builds fresh assets and creates a validated installable ZIP.

Edit source files in src/, PHP templates in the theme and inc/ directories, and reusable sections in template-parts/. Do not hand-edit generated files in dist/css/ or dist/js/. The package process keeps the runtime theme files and generated assets while excluding development-only source, build, npm, and node_modules files from the ZIP.

== Package output ==

npm run package creates:

wp-content/zipped-theme/MNYphoto-theme.zip

The archive includes the PHP templates, style.css, readme.txt, translation files, and the generated CSS, JavaScript, image, and icon assets required by WordPress.

== License ==

MNYphoto-theme is licensed under the GNU General Public License, version 2.0 or later. See https://www.gnu.org/licenses/gpl-2.0.html.

== BUILD FILE ==

The files in build/ are Node.js tools for compiling the front-end assets, checking the theme structure, checking PHP syntax, and creating the installable theme archive. Each file has a separate responsibility so a failed build identifies the relevant type of problem.

The normal command flow is:

npm run dev       -> build/webpack.config.js in development/watch mode
npm run build     -> build/webpack.config.js in production mode -> build/validate.js
npm run lint:php  -> build/lint-php.js
npm run package   -> package-theme.js --preflight -> npm run build -> package-theme.js

There is no npm test script. build/test-theme.js can be run directly, but it is not part of the current npm run build, npm run lint:php, or npm run package commands.

The current build directory contains these files:

* build/webpack.config.js
* build/validate.js
* build/lint-php.js
* build/package-theme.js
* build/test-theme.js
* build/README.md, which documents the build directory and is not an executable build step.

The npm command definitions are in package.json, lines 5-18. The executable scripts resolve the theme root from their own directory with __dirname, so the commands are intended to run from the theme root that contains package.json and build/.

=== build/webpack.config.js ===

This is the Webpack configuration that turns the editable JavaScript and Sass source into the two generated assets loaded by WordPress.

It:

* Uses src/js/main.js as the single Webpack entry point. That file imports the JavaScript components and imports ../scss/main.scss as a build-time dependency.
* Writes the bundled JavaScript to dist/js/bundle.js.
* Recognizes .scss and .sass files and processes them through the loader chain. Webpack applies the chain from right to left: sass-loader compiles Sass into CSS, css-loader resolves CSS imports and dependencies, and MiniCssExtractPlugin.loader extracts the result into a physical CSS file.
* Writes the extracted CSS to the existing dist/css/bundle.css path. The plugin does not create a second stylesheet; it is the step that lets Webpack generate the one CSS file the theme already expects.
* Uses compressed Sass output and JavaScript minimization in production mode. Development mode uses expanded CSS and source maps to make debugging easier.
* Disables production source maps and enables development source maps only.
* Cleans generated output under dist/ between builds while preserving dist/images/ and dist/icons/.
* Receives the Webpack mode from the command line. npm run dev explicitly uses development mode and watches for changes; npm run build explicitly uses production mode and finishes with structure validation.

This file only builds front-end assets. It does not run PHP, inspect WordPress, create a ZIP, or deploy the theme.

The exact configuration uses src/js/main.js as its only Webpack entry point in build/webpack.config.js, lines 8-10. It writes the JavaScript output beneath dist/ in lines 11-17 and extracts CSS to dist/css/bundle.css in lines 42-44. The SCSS rule accepts .scss and .sass files and declares sass-loader, css-loader, and MiniCssExtractPlugin.loader in lines 18-41.

src/js/main.js imports ../scss/main.scss on line 1, so the Sass source is part of the same Webpack dependency graph as the JavaScript. The configuration does not declare a separate CSS entry point. Production mode requests compressed Sass output and Webpack minimization in build/webpack.config.js, lines 29-47, and disables production source maps on line 48.

=== build/validate.js ===

This is the theme structure validator called after the production Webpack build.

It verifies that:

* Required runtime files exist, including style.css, the main PHP bootstrap/templates, dist/css/bundle.css, and dist/js/bundle.js.
* The expected template-part directories exist for the front page, Services, About Us, Work, Blog, Contact Us, PPC landing page, and 404 page.
* Each expected content-*.php template part exists.
* Template parts are kept inside a page-* directory instead of being placed directly in template-parts/ or the theme root.
* Template-part paths use the lowercase, hyphenated naming convention enforced by the validator.
* Every PHP file in page-templates/ contains a WordPress Template Name: header.

If a required file is missing, a template part is misplaced, a filename is invalid, or a page template has no name header, the script throws an error and the build exits unsuccessfully. When everything passes, it reports the number of template parts and page-part folders checked.

This is a filesystem and naming check. It does not boot WordPress, execute PHP, test browser behavior, validate HTML/CSS quality, or confirm that an editor has configured the site correctly.

The required runtime file list is declared in build/validate.js, lines 4-9. The expected template inventory is declared in the pageParts and pagePrefixes objects on lines 11-35. Every PHP file under template-parts/ is recursively checked against the lowercase page-*/content-*.php pattern on lines 64-70. Every PHP file directly inside page-templates/ must contain the literal Template Name: string, as checked on lines 72-77.

=== build/lint-php.js ===

This is the PHP syntax checker used by npm run lint:php. Despite the command name, it is a syntax lint rather than a full WordPress coding-standard linter.

It works as follows:

* If the PHP_BINARY environment variable is set, it uses that executable and verifies it responds to --version.
* Otherwise, it first looks for php on the system PATH.
* If PHP is not on PATH, it searches common Local development-runtime locations on Windows, macOS, and Linux. On Windows it can find either the normal CLI executable or Local's CLI-capable CGI executable.
* It recursively collects the theme's .php files while excluding node_modules/ and vendor/.
* It runs php -l against every PHP file and prints PHP's result directly to the terminal.
* If any file returns a non-zero status, the script exits with status 1, which lets CI or another calling process fail. If every file passes, it reports the number of files validated.

This script catches parse errors such as missing semicolons, unmatched braces, and malformed PHP syntax. It does not execute WordPress, load plugins, query a database, inspect runtime output, or enforce WordPress Coding Standards, PHPStan rules, security rules, or accessibility rules.

The script resolves PHP in this order: a valid PHP_BINARY environment variable, php on PATH, and then standard Local runtime locations. The resolution logic is in build/lint-php.js, lines 86-113, with platform-specific Local candidates in lines 34-83. It recursively collects .php files while excluding node_modules/ and vendor/ on lines 116-127, then runs [ '-l', file ] for each file on lines 130-145. A failed PHP process sets the script exit code to 1 on lines 148-152.

=== build/package-theme.js ===

This script creates and validates the installable WordPress theme ZIP. It is the only build file that creates a release archive, and it does not deploy or upload anything.

The package process:

* Uses the fixed archive slug MNYphoto-theme so the ZIP opens with the correct theme directory name.
* Writes the archive to wp-content/zipped-theme/MNYphoto-theme.zip, creating the destination directory when necessary.
* Supports a --preflight mode. The preflight checks that the destination exists or can be created, is a directory, and is writable. The npm run package command runs this check before building assets.
* Uses an explicit runtime allowlist rather than copying the entire theme directory. The allowlist includes the PHP templates, inc/, languages/, page-templates/, template-parts/, style.css, readme.txt, screenshot.png, and the generated dist/css/, dist/js/, dist/images/, and dist/icons/ directories.
* Refuses to continue if any allowlisted source entry is missing.
* Compresses the archive using archiver and writes it first to a temporary .partial file.
* Reads the completed ZIP directory and compares the archive inventory against the allowlist. This catches missing files, unexpected extra files, and entries outside the MNYphoto-theme/ archive root.
* Deletes the temporary partial archive when packaging fails and renames the validated temporary archive to the final ZIP only after inventory validation succeeds.

The package intentionally excludes development-only material such as src/, build/, package.json, package-lock.json, README.md, and node_modules/. The generated dist/ assets are included because WordPress needs them at runtime.

The package npm script runs the complete release sequence: preflight the destination, run npm run build to generate and validate fresh assets, then run this script again to create and validate the ZIP.

The fixed ZIP destination and archive slug are defined in build/package-theme.js, lines 7-10. The current output is wp-content/zipped-theme/MNYphoto-theme.zip, with an internal MNYphoto-theme/ root. The complete runtime allowlist is the runtimeEntries array on lines 12-18. This script does not read .gitignore or .deployignore.

Packaging writes a .partial archive, reads its ZIP directory, and compares invalid roots, missing entries, and extra entries before renaming the validated file. Those behaviors are implemented in build/package-theme.js, lines 45-94 and 110-148. The --preflight mode only verifies that the destination exists or can be created and is writable; it exits before checking runtime entries or creating an archive, as shown on lines 20-30 and 96-101.

=== build/test-theme.js ===

This is a standalone lightweight sanity-check script. It is not currently connected to an npm script and is not invoked by npm run build.

When run directly with node build/test-theme.js, it:

* Reads functions.php and confirms that it references setup.php, enqueue.php, and customizer.php.
* Inspects direct files in template-parts/ and rejects a direct PHP file whose name does not begin with content-.
* Prints Production checks passed. if those limited checks succeed.

It does not run PHP, boot WordPress, inspect nested page-* template-part directories, verify the complete template inventory, build assets, lint PHP, or create a ZIP. The more complete structure checks are performed by build/validate.js, which is the validator used by the production build.

The entire implementation is one line in build/test-theme.js, line 1. It reads functions.php and checks for the text setup.php, enqueue.php, and customizer.php; it examines only the immediate entries returned by readdirSync(root/template-parts); and it prints Production checks passed. when those narrow checks succeed. No npm script references this file in package.json, lines 5-9, so it runs only when invoked directly with node build/test-theme.js.

=== build/README.md ===

This is documentation, not a Node.js executable. It explains the current build scripts, source graphs, generated outputs, PHP and archive boundaries, WordPress enqueue integration, and GitHub Actions workflow. It does not participate in npm run dev, npm run build, npm run lint:php, or npm run package.

The runtimeEntries allowlist in build/package-theme.js, lines 12-18, excludes the entire build/ directory, so this documentation file is not placed in the installable theme ZIP. The root .deployignore also excludes wp-content/themes/MNYphoto/build/ on lines 1-4.
