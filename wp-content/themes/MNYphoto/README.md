# MNYphoto WordPress Theme

MNYphoto-theme is a custom classic WordPress theme for a studio-style digital agency site. It combines server-rendered WordPress templates with a small, component-based front-end layer for navigation, content interactions, filtering, and progressive enhancement.

The current theme contains demonstration and placeholder content. Replace the copy, contact details, project information, and media before using it for a production site.

## What the theme provides

- A classic PHP theme structure built from WordPress templates and organized template parts.
- Theme support for document titles, featured images, custom logos, HTML5 markup, responsive embeds, wide alignment, automatic feeds, and custom menus.
- Primary and Footer navigation locations, plus a Blog sidebar widget area.
- Custom page templates for About Us, Services, Work, Contact Us, PPC Landing Page 2026, and Privacy Policy pages.
- Server-side fallback routes for the showcase pages and journal when a clean installation has not yet created matching published Pages.
- A responsive header with a native WordPress menu, an enhanced Services/About/Work/Blog navigation experience, mobile navigation, and a no-JavaScript fallback.
- A project brief form that uses a WordPress nonce, sanitizes submitted values, validates required fields, rejects submissions that populate the honeypot field, and sends valid submissions to the site administrator through `wp_mail()`.
- Accessibility-oriented behavior including a skip link, semantic landmarks, labeled controls, visible focus states, keyboard-aware navigation, focus management, and reduced-motion handling. These features do not replace accessible content and editorial practices.

## Theme structure

```text
MNYphoto/
├── build/                    # Build, validation, PHP-lint, and packaging scripts
├── dist/                     # Generated production assets committed for WordPress
│   ├── css/bundle.css
│   ├── js/bundle.js
│   ├── images/
│   └── icons/
├── inc/                      # Theme setup, helpers, navigation, forms, and loading
├── languages/                # Translation files, when present
├── page-templates/           # Assignable WordPress page templates
├── src/
│   ├── js/                   # JavaScript entry point, components, and utilities
│   └── scss/                 # Sass entry point and organized style modules
├── template-parts/           # Reusable, page-specific PHP sections
├── functions.php             # Theme bootstrap
├── style.css                 # WordPress theme metadata
├── package.json              # Development commands and dependencies
└── package-lock.json         # Locked npm dependency tree
```

The theme's PHP functions currently use the `nytt99_` prefix to avoid collisions with WordPress, plugins, and other themes. The prefix is an internal implementation detail and does not change the theme's public display name.

## WordPress installation

1. Copy the complete `MNYphoto` directory into `wp-content/themes/`, or create the release ZIP with `npm run package` and upload it through **Appearance > Themes > Add New > Upload Theme**.
2. Activate **MNYphoto-theme**.
3. Set the site title, logo, and other identity settings under **Appearance > Customize**.
4. Assign menus to **Primary navigation** and **Footer navigation** under **Appearance > Menus**.
5. Create the site pages and assign the supplied templates where needed:
   - About Us
   - Services
   - Work
   - Contact Us
   - PPC Landing Page 2026
   - Privacy Policy
6. Configure the site administrator email address. The project brief form sends mail to WordPress's `admin_email` option.
7. Replace the demonstration copy, links, contact details, project data, and placeholder media before launch.

The theme can render several showcase destinations before corresponding Pages exist. Published Pages take precedence when they are created. The supported fallback destinations are `/services/`, `/about-us/`, `/work/`, `/contact-us/`, `/ppc-lp-2026/`, `/journal/`, and `/blog/`.

## Front-end architecture

The source entry points are:

- `src/js/main.js` — JavaScript entry point and component initialization.
- `src/scss/main.scss` — Sass entry point that imports the theme's variables, mixins, base styles, layouts, components, and page styles.

The JavaScript entry point initializes the current interactive modules:

- Site navigation and mega-menu behavior.
- Accordions and tabs.
- Article contents and copy-link controls.
- Home-page experience and metrics.
- Reveal-on-scroll behavior.
- Work filtering and service-directory interactions.
- Reading progress.

The SCSS is organized into abstract variables/mixins, base elements and typography, reusable buttons/cards/forms, header/footer layout, and page-specific styles.

### How Webpack produces the two WordPress assets

`main.js` imports `../scss/main.scss` as a build-time dependency. This lets Webpack follow the JavaScript and Sass source from one dependency graph; it does not send CSS inside the JavaScript file or make WordPress enqueue a combined asset.

```text
src/js/main.js
├── imports JavaScript components
└── imports ../scss/main.scss for the build
             ↓
          Webpack
          ├── dist/js/bundle.js
          └── dist/css/bundle.css
```

`sass-loader` compiles the SCSS, `css-loader` processes the CSS, and `MiniCssExtractPlugin` writes the extracted stylesheet to the existing `dist/css/bundle.css` path. It is not a second CSS bundle; it is the Webpack step that generates the one CSS bundle the theme already expects.

WordPress still loads the two files separately in `inc/enqueue.php`:

- `dist/css/bundle.css` is enqueued as the theme stylesheet.
- `dist/js/bundle.js` is enqueued as a deferred script in the document head.
- Both assets use their file modification time as the WordPress version value for cache busting.
- WordPress's `no-js`/`js` document class is updated with a small inline script before the bundle runs.
- The comment-reply script is loaded only for singular posts or pages where comments are open and threaded comments are enabled.

Production builds compile compressed CSS, enable Webpack's production JavaScript optimization, disable production source maps, and clean generated CSS/JavaScript output while preserving `dist/images` and `dist/icons`.

## PHP architecture

`functions.php` loads the theme modules in `inc/`:

- `setup.php` registers theme supports, menu locations, the Blog sidebar, and clean-install showcase route fallbacks.
- `helpers.php` contains reusable URL and presentation helpers used by templates.
- `enqueue.php` loads the generated CSS and JavaScript assets.
- `template-tags.php` contains reusable template output helpers.
- `customizer.php` registers theme customizer behavior.
- `navigation.php` renders the enhanced navigation panels, native menu, dynamic blog cards, and safe fallback menu.
- `contact.php` handles the project brief form submission.

Most page markup is kept in `template-parts/page-*` directories. This keeps the top-level templates small and lets each page section be edited independently. The structure validator checks that those parts use the expected page directory and `content-*.php` naming convention.

## Development workflow

Run the commands from `wp-content/themes/MNYphoto`, not from the repository root.

### Install dependencies

```powershell
npm ci
```

`npm ci` performs a clean install from `package-lock.json`. It is the appropriate install command for CI and for reproducing the locked theme toolchain locally. Do not commit `node_modules/`.

### Watch source files

```powershell
npm run dev
```

Webpack runs in development mode, watches the JavaScript and SCSS dependency graph, and emits development source maps. Edit files in `src/` and let Webpack regenerate `dist/`.

### Create and validate production assets

```powershell
npm run build
```

This runs the production Webpack configuration and then `build/validate.js`. The validator confirms that required runtime files and the expected template-part structure are present.

### Validate PHP syntax

```powershell
npm run lint:php
```

This runs `php -l` against the theme's PHP files. It checks PHP syntax; it is not a WordPress Coding Standards or PHPStan analysis.

### Create the installable theme ZIP

```powershell
npm run package
```

The package command preflights the destination, builds fresh production assets, and creates a validated archive at:

```text
wp-content/zipped-theme/MNYphoto-theme.zip
```

The archive contains the runtime theme files needed by WordPress, including PHP templates, `style.css`, `readme.txt`, translation files, and the generated CSS, JavaScript, image, and icon assets. Development source files, build scripts, npm metadata, and `node_modules/` are intentionally not included.

There is currently no `npm test` script in `package.json`. The supported automated checks are the production build/structure validation, PHP syntax validation, and package inventory validation described above.

## Editing rules

- Edit JavaScript and SCSS in `src/`; do not hand-edit `dist/css/bundle.css` or `dist/js/bundle.js`.
- After changing source assets, run `npm run build` and review the generated files before committing.
- Keep WordPress PHP markup and behavior in the root templates, `inc/`, and `template-parts/` directories.
- Keep `dist/images` and `dist/icons` intact; the Webpack clean step is configured to preserve them.
- Use the supplied package command when a deployable ZIP is needed so the archive contains only the intended runtime files.

## Useful references

- [WordPress Theme Handbook](https://developer.wordpress.org/themes/)
- [Webpack entry points](https://webpack.js.org/concepts/entry-points/)
- [MiniCssExtractPlugin](https://webpack.js.org/plugins/mini-css-extract-plugin/)
- [sass-loader](https://webpack.js.org/loaders/sass-loader/)
- [npm ci](https://docs.npmjs.com/cli/commands/npm-ci)

## License

MNYphoto-theme is licensed under the GNU General Public License, version 2.0 or later. See [LICENSE](https://www.gnu.org/licenses/gpl-2.0.html).

## Build files

The files in `build/` are small Node.js tools that handle different parts of the theme workflow. They are intentionally separate so that compiling assets, checking theme structure, checking PHP syntax, and creating a release archive can fail independently and report the relevant problem.

The normal command flow is:

```text
npm run dev       -> build/webpack.config.js in development/watch mode
npm run build     -> build/webpack.config.js in production mode -> build/validate.js
npm run lint:php  -> build/lint-php.js
npm run package   -> package-theme.js --preflight -> npm run build -> package-theme.js
```

There is no `npm test` script. `build/test-theme.js` can be run directly, but it is not part of the current `npm run build`, `npm run lint:php`, or `npm run package` commands.

### `build/webpack.config.js`

This is the Webpack configuration that turns the editable JavaScript and Sass source into the two generated assets loaded by WordPress.

It does the following:

- Uses `src/js/main.js` as the single Webpack entry point. That file imports the JavaScript components and imports `../scss/main.scss` as a build-time dependency.
- Writes the bundled JavaScript to `dist/js/bundle.js`.
- Recognizes `.scss` and `.sass` files and processes them through the loader chain. Webpack applies that chain from right to left: `sass-loader` compiles Sass into CSS, `css-loader` resolves CSS imports and dependencies, and `MiniCssExtractPlugin.loader` extracts the result into a physical CSS file.
- Writes that extracted CSS to the existing `dist/css/bundle.css` path. The plugin does not create a second stylesheet; it is the step that lets Webpack generate the one CSS file the theme already expects.
- Uses compressed Sass output and JavaScript minimization in production mode. Development mode uses expanded CSS and source maps to make debugging easier.
- Disables production source maps and enables development source maps only.
- Cleans generated output under `dist/` between builds while preserving `dist/images/` and `dist/icons/`.
- Receives the Webpack mode from the command line. `npm run dev` explicitly uses development mode and watches for changes; `npm run build` explicitly uses production mode and finishes with structure validation.

This file only builds front-end assets. It does not run PHP, inspect WordPress, create a ZIP, or deploy the theme.

### `build/validate.js`

This is the theme structure validator called after the production Webpack build.

It verifies that:

- Required runtime files exist, including `style.css`, the main PHP bootstrap/templates, `dist/css/bundle.css`, and `dist/js/bundle.js`.
- The expected template-part directories exist for the front page, Services, About Us, Work, Blog, Contact Us, PPC landing page, and 404 page.
- Each expected `content-*.php` template part exists.
- Template parts are kept inside a `page-*` directory instead of being placed directly in `template-parts/` or the theme root.
- Template-part paths use the lowercase, hyphenated naming convention enforced by the validator.
- Every PHP file in `page-templates/` contains a WordPress `Template Name:` header.

If a required file is missing, a template part is misplaced, a filename is invalid, or a page template has no name header, the script throws an error and the build exits unsuccessfully. When everything passes, it reports the number of template parts and page-part folders checked.

This is a filesystem and naming check. It does not boot WordPress, execute PHP, test browser behavior, validate HTML/CSS quality, or confirm that an editor has configured the site correctly.

### `build/lint-php.js`

This is the PHP syntax checker used by `npm run lint:php`. Despite the command name, it is a syntax lint rather than a full WordPress coding-standard linter.

It works as follows:

- If the `PHP_BINARY` environment variable is set, it uses that executable and verifies it responds to `--version`.
- Otherwise, it first looks for `php` on the system `PATH`.
- If PHP is not on `PATH`, it searches common Local development-runtime locations on Windows, macOS, and Linux. On Windows it can find either the normal CLI executable or Local's CLI-capable CGI executable.
- It recursively collects the theme's `.php` files while excluding `node_modules/` and `vendor/`.
- It runs `php -l <file>` once for every PHP file and prints PHP's result directly to the terminal.
- If any file returns a non-zero status, the script exits with status `1`, which lets CI or another calling process fail. If every file passes, it reports the number of files validated.

This script catches parse errors such as missing semicolons, unmatched braces, and malformed PHP syntax. It does not execute WordPress, load plugins, query a database, inspect runtime output, or enforce WordPress Coding Standards, PHPStan rules, security rules, or accessibility rules.

### `build/package-theme.js`

This script creates and validates the installable WordPress theme ZIP. It is the only build file that creates a release archive, and it does not deploy or upload anything.

The package process:

- Uses the fixed archive slug `MNYphoto-theme` so the ZIP opens with the correct theme directory name.
- Writes the archive to `wp-content/zipped-theme/MNYphoto-theme.zip`, creating the destination directory when necessary.
- Supports a `--preflight` mode. The preflight checks that the destination exists or can be created, is a directory, and is writable. The `npm run package` command runs this check before building assets.
- Uses an explicit runtime allowlist rather than copying the entire theme directory. The allowlist includes the PHP templates, `inc/`, `languages/`, `page-templates/`, `template-parts/`, `style.css`, `readme.txt`, `screenshot.png`, and the generated `dist/css/`, `dist/js/`, `dist/images/`, and `dist/icons/` directories.
- Refuses to continue if any allowlisted source entry is missing.
- Compresses the archive using `archiver` and writes it first to a temporary `.partial` file.
- Reads the completed ZIP directory and compares the archive inventory against the allowlist. This catches missing files, unexpected extra files, and entries outside the `MNYphoto-theme/` archive root.
- Deletes the temporary partial archive when packaging fails and renames the validated temporary archive to the final ZIP only after inventory validation succeeds.

The package intentionally excludes development-only material such as `src/`, `build/`, `package.json`, `package-lock.json`, `README.md`, and `node_modules/`. The generated `dist/` assets are included because WordPress needs them at runtime.

The `package` npm script runs the complete release sequence: preflight the destination, run `npm run build` to generate and validate fresh assets, then run this script again to create and validate the ZIP.

### `build/test-theme.js`

This is a standalone lightweight sanity-check script. It is not currently connected to an npm script and is not invoked by `npm run build`.

When run directly with `node build/test-theme.js`, it:

- Reads `functions.php` and confirms that it references `setup.php`, `enqueue.php`, and `customizer.php`.
- Inspects direct files in `template-parts/` and rejects a direct PHP file whose name does not begin with `content-`.
- Prints `Production checks passed.` if those limited checks succeed.

It does not run PHP, boot WordPress, inspect nested `page-*` template-part directories, verify the complete template inventory, build assets, lint PHP, or create a ZIP. The more complete structure checks are performed by `build/validate.js`, which is the validator used by the production build.
