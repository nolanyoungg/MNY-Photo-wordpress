# MNYphoto WordPress Theme

MNYphoto-theme is a custom classic WordPress theme for a studio-style digital agency site. It combines server-rendered WordPress templates with a small, component-based front-end layer for navigation, content interactions, filtering, and progressive enhancement.

The current theme contains demonstration and placeholder content. Replace the copy, contact details, project information, and media before using it for a production site.

Theme is looking good. 8-26

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

Run from `wp-content/themes/MNYphoto`. Use **Node.js 24.11.0 or newer** and
**npm 9 or newer**, matching Shibey's engines; Node 24 is used in CI. This
workflow was verified with Node 24.11.0 and its bundled npm 11.6.1.
PHP is also required for linting (minimum 7.4, read from `style.css`).

```powershell
cd wp-content/themes/MNYphoto
node --version
npm --version
npm ci --no-audit --no-fund
npm run dev
```

The development command watches JavaScript and SCSS, writes development source
maps, and keeps running. Stop it with Ctrl+C before the final production build.
Edit `src/`; never edit the generated bundles.

```powershell
npm run lint
npm run build
```

`lint` runs `lint:php` followed by `lint:js`. Both can also run independently.
PHP lint selects `PHP_BINARY`, PATH, then Local runtimes; it checks syntax under
the reported PHP version. JavaScript lint uses ESLint recommended rules for
browser source and Node build scripts. `build` compiles production assets and
validates MNY Photo's templates, includes, references, versions, and initializer imports.
It does not run lint. There are no npm test, type-check, or formatting-check scripts.

Review and commit rebuilt `dist/css/bundle.css` and `dist/js/bundle.js` with source
changes. CI rebuilds and rejects stale committed bundles. To check after committing:

```powershell
git diff --exit-code -- dist/css/bundle.css dist/js/bundle.js
```

### Portable theme ZIP

```powershell
npm run package
```

This preflights the destination, builds production assets, and validates a ZIP
containing the **complete theme except root `node_modules/`**, like Shibey. The
ZIP retains MNY Photo's existing `MNYphoto-theme/` internal root and is written as:

```text
wp-content/zipped-theme/MNYphoto-theme-MM-DD-YYYY-hh-mm-ss-AM-or-PM.zip
```

For the previous fixed-name runtime-only archive, use:

```powershell
npm run package -- --runtime-only
```

That writes `wp-content/zipped-theme/MNYphoto-theme.zip` using the original runtime
allowlist. Neither command uploads or deploys anything, and neither runs lint.
Run `npm run lint` before packaging. Archives are ignored by Git.

See [build/README.md](build/README.md) for command behavior, validation boundaries,
and configuration. The [parity report](build/tooling-parity.md) records the reference
commit, before/after commands, locked versions, changes, and verification results.

## Editing rules

- Edit JavaScript and SCSS in `src/`; do not hand-edit `dist/css/bundle.css` or `dist/js/bundle.js`.
- After changing source assets, run `npm run build` and review the generated files before committing.
- Keep WordPress PHP markup and behavior in the root templates, `inc/`, and `template-parts/` directories.
- Keep `dist/images` and `dist/icons` intact; the Webpack clean step is configured to preserve them.
- Use the supplied package command when a deployable ZIP is needed and choose the runtime-only option when development files should be excluded.

## Useful references

- [WordPress Theme Handbook](https://developer.wordpress.org/themes/)
- [Webpack entry points](https://webpack.js.org/concepts/entry-points/)
- [MiniCssExtractPlugin](https://webpack.js.org/plugins/mini-css-extract-plugin/)
- [sass-loader](https://webpack.js.org/loaders/sass-loader/)
- [npm ci](https://docs.npmjs.com/cli/commands/npm-ci)

## License

MNYphoto-theme is licensed under the GNU General Public License, version 2.0 or later. See [LICENSE](https://www.gnu.org/licenses/gpl-2.0.html).

## Build files

The build system is documented in [build/README.md](build/README.md).
Its command definitions live in [package.json](package.json); exact resolved
dependencies live in [package-lock.json](package-lock.json).
