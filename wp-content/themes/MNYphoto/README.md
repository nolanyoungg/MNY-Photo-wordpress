# MNYphoto WordPress Theme

MNYphoto-theme is a custom classic WordPress theme for a photography site. It combines server-rendered WordPress templates with a small, component-based front-end layer for navigation, content interactions, filtering, and progressive enhancement.

The theme implements the approved Concept 03 photography design. Its six bundled photographs are AI-generated illustrations, identified on the public portfolio and footer until replaced with Media Library images. Existing WordPress pages, posts, and content are retained.

## Approved photography design

The homepage uses a four-panel moving photo gallery, a transparent header, and the charcoal/white/gray palette from `docs/photography-concept-03.html`. Two panels appear on tablets and one on phones. Only Services and Blog have dropdowns. About and Portfolio are direct links; the existing Work page/template filename and URL are preserved.

The six categories are Pets, Portraits, Family, Homes & real estate, Events, and Landscapes. Portraits include college graduation, high school seniors, kids, and individual/self-portrait sessions. In **Appearance > Customize > Photography collections**, choose a Media Library image for each category. Core responsive attachment markup is used; bundled WebP derivatives provide the illustrated defaults.

The hero fills the viewport and moves continuously at a constant speed through all six collections, with a seamless repeated track and no bottom control strip. A small pause/play button overlays the photograph. Keyboard focus inside the gallery, modal dialogs, hidden tabs, and an offscreen hero suspend motion; ordinary hover and open navigation menus do not. Touch dragging is supported. Reduced motion and no-JavaScript modes provide a manually scrollable photo strip. Portfolio filtering supports real URLs and browser history.

On desktop, the full Services and Blog controls are disclosure buttons. Clicking one pins its dropdown until the same control is clicked again, another control is selected, the visitor clicks outside that dropdown and its trigger, or Escape is pressed. Hover previews remain temporary. Rounded chevrons rotate with the expanded state. Native page links remain inside the panels, while mobile retains separate destination links and dropdown buttons. Both the homepage and portfolio galleries continue moving behind open menus, subject to their pause and reduced-motion controls.

The homepage’s five editorial sections remain separate template parts: the studio introduction, interactive collection index, asymmetric selected-photo spread, full-width family-photography approach section, and three-step session guide. Collection previews respond to pointer and keyboard focus; all six service links remain native destinations. Styling is scoped to home-* classes in front-page.scss.

The Portfolio page implements the approved `docs/portfolio-concept-12.html` design.
Its existing Work page assignment and URL are retained, and the template includes
exactly these three new sections under `template-parts/page-portfolio/`:

- `00-portfolio-hero.php` — five continuously looping vertical photo columns,
  reduced to four on tablets and three on phones, with a pause/play control.
- `01-portfolio-services-section.php` — the six alternating photo/service sections,
  collection anchors, and the existing full-image viewer.
- `02-portfolio-cta.php` — the blue-to-lilac **Contact Us** section, with native
  keyboard-operated category choices and category-prefilled inquiry links.

Nolan explicitly requested these numbered filenames; the structure validator
allows these three exact names while retaining the existing naming checks for
other parts. All Portfolio styling is in `src/scss/pages/portfolio.scss`. The
vertical motion lives in `src/js/components/portfolio.js`, independently of the
homepage gallery. Media still uses the six existing Customizer controls and
responsive WordPress attachment markup. Approved page copy is centralized in
`mnyphoto_portfolio_collections()` in the existing photography helper module.
Existing `?collection=` links take visitors to the matching section. The native
CTA selector works without JavaScript; its category is passed to the maintained
contact form. No form is submitted by the selector. The Work template suppresses
the generic closing CTA to avoid showing two invitations, and retains editor
content and the shared footer. Old `page-work` parts remain available.

Manrope font sources and their SIL license are in `src/fonts/`; Webpack emits
the font assets into `dist/images/fonts/`, which is included in theme packages.
The font license is also retained beside the generated font files.

Page entry files include sections from `template-parts/page-*`. Existing required filenames are retained, including compatibility parts for the new shared sections; top-level templates determine which sections render. New shared parts use `page-shared/content-shared-*.php`. The structure validator checks the full inventory, references, and the new `inc/photography.php` module.

`dist/` and `build/` remain in place. Edit the active styles in `src/scss/base/globalelements.scss`, `layout/header.scss`, `layout/footer.scss`, `pages/photography.scss`, `pages/front-page.scss`, and `components/wordpress.scss`. The active JavaScript components are site navigation, home experience, photography gallery, and photography details. Existing unused modules are retained for compatibility; the entry point defines the active build.

Blog cards, archives, single posts, search, comments, and pagination use actual WordPress content. No sample posts are inserted. New photography page templates display their editor content below the composition. Older theme assignments are mapped to the matching photography templates without changing page IDs or URLs: what-we-do (Services), who-we-are (About), work (Portfolio), contact, and policy. Legacy demo/agency content stays saved in WordPress and is not appended by default; enable **Append content from legacy page layouts** in Customize > Photography collections to display it. Ordinary pages and posts continue to render their native content. The inquiry form keeps the existing nonce/honeypot/wp_mail path, now collecting one of the six categories, preferred date, location, name, email, and message. The handler validates category and date on the server. It does not create database entries.

The user-approved release workflow is local lint/build/package validation, production-branch push, then Google Chrome verification on the actual staging URL. The older sandbox-only instructions do not govern this approved rollout. The site must activate the deployed `MNYphoto` folder; a separate older `MNYphoto-theme` installation can remain as a rollback option.

## What the theme provides

- A classic PHP theme structure built from WordPress templates and organized template parts.
- Theme support for document titles, featured images, custom logos, HTML5 markup, responsive embeds, wide alignment, automatic feeds, and custom menus.
- Primary and Footer navigation locations, plus a Blog sidebar widget area.
- Custom page templates for About Us, Services, Portfolio, Contact Us, Portrait Campaign, and Privacy Policy pages.
- Server-side fallback routes for the showcase pages and journal when a clean installation has not yet created matching published Pages.
- A responsive header with a native WordPress menu, an enhanced Services/Blog dropdown navigation experience, mobile navigation, and a no-JavaScript fallback.
- A photography inquiry form that uses a WordPress nonce, sanitizes submitted values, validates required fields, rejects submissions that populate the honeypot field, and sends valid submissions to the site administrator through `wp_mail()`.
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

Legacy theme PHP functions use the `nytt99_` prefix; new photography helpers use `mnyphoto_`. Both avoid collisions with WordPress, plugins, and other themes. The prefix is an internal implementation detail and does not change the theme's public display name.

## WordPress installation

1. Copy the complete `MNYphoto` directory into `wp-content/themes/`, or create the release ZIP with `npm run package` and upload it through **Appearance > Themes > Add New > Upload Theme**.
2. Activate **MNYphoto-theme**.
3. Set the site title, logo, and other identity settings under **Appearance > Customize**.
4. Assign menus to **Primary navigation** and **Footer navigation** under **Appearance > Menus**.
5. Create the site pages and assign the supplied templates where needed:
   - About Us
   - Services
   - Portfolio (existing Work page)
   - Contact Us
   - Portrait Campaign (existing PPC page)
   - Privacy Policy
6. Configure the site administrator email address. The photography inquiry form sends mail to WordPress's `admin_email` option.
7. Replace the demonstration copy, links, contact details, project data, and placeholder media before launch.

The theme can render several showcase destinations before corresponding Pages exist. Published Pages take precedence when they are created. The supported fallback destinations are `/services/`, `/about-us/`, `/work/`, `/contact-us/`, `/ppc-lp-2026/`, `/journal/`, and `/blog/`.

## Front-end architecture

The source entry points are:

- `src/js/main.js` — JavaScript entry point and component initialization.
- `src/scss/main.scss` — Sass entry point that imports the theme's variables, mixins, base styles, layouts, components, and page styles.

The old component files remain available in source. The photography entry point initializes only navigation, the gallery, the photo viewer/filter, and service focus handling. Earlier modules included:

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
- `contact.php` handles the photography inquiry form submission.

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
