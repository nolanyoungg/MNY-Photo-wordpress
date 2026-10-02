# Theme build system

Run from `wp-content/themes/MNYphoto`, using Node 24.11.0+ and npm 9+.
The validated combination is Node 24.11.0 / npm 11.6.1. CI uses Node 24.
The commands and dependency ranges match the Shibey checkout recorded in
[tooling-parity.md](tooling-parity.md).

## Commands

```powershell
npm ci --no-audit --no-fund
npm run dev
# Stop the watcher before final verification:
npm run lint
npm run build
# Optional local archive:
npm run package
```

| Command | Files and tools | Behavior and output |
| --- | --- | --- |
| `dev` | Webpack CLI, `webpack.config.js`, `src/js/main.js`, imported JS/SCSS, loaders | Watches and rebuilds `dist/js/bundle.js`, `dist/css/bundle.css`, and adjacent source maps. Does not lint or validate PHP/templates. |
| `build` | Same pipeline in production, then `validate.js` | Minified CSS/JS, no source maps; nonzero exit on compilation or source-contract failure. Does not run lint. |
| `lint` | npm, `lint:php`, `lint:js` | Runs PHP then JavaScript checks; stops on first failing command. No build output. |
| `lint:js` | ESLint, `@eslint/js`, `globals`, `eslint.config.js` | Recommended rules for authored JS; ignores generated bundles and dependencies. Diagnostics and exit status. |
| `lint:php` | Node, `lint-php.js`, `style.css`, PHP runtime | Minimum-version gate and syntax check for each PHP file; diagnostics and summary. |
| `package` | `package-theme.js`, production build, `archiver` | Preflight, build/validate, create ZIP, verify its inventory, finalize timestamped archive. No upload or deployment. |

No formatting-check, type-check, npm test, separate validate, or aggregate verify
script exists in the reference. `lint` is the aggregate lint command;
`npm run lint` followed by `npm run build` is the complete normal verification.
MNY Photo's existing `node build/test-theme.js` remains available separately.

## Configuration and source graph

- `package.json` defines the six commands, development dependencies, and engines.
- `package-lock.json` v3 records exact versions. Use `npm ci` for reproducible installs.
- `.editorconfig` matches Shibey's editor whitespace conventions; it is not a formatter or check.
- Neither theme declares a package manager, `.npmrc`, `.nvmrc`, or `.node-version`.
- `build/webpack.config.js` is behaviorally identical to Shibey's configuration and was retained.

```text
src/js/main.js
├── imports components and utilities
└── imports ../scss/main.scss
    └── @use abstracts, base, components, layout, and page styles
               ↓
         sass-loader → css-loader → MiniCssExtractPlugin
               ↓
         dist/css/bundle.css
Webpack module graph → dist/js/bundle.js
```

The JavaScript entry initializes navigation, accordions, article contents/copy-link,
metrics, homepage effects, reading progress, reveal, service directory, tabs, and
work filtering. The existing modal and debounce helpers remain available but are
not reachable from the active entry; they are still covered by ESLint.

Production mode uses compressed Sass and Webpack optimization, including the
reference Webpack version's CSS minimization. Development mode expands CSS and
emits source maps. Output cleanup preserves authored `dist/images/` and
`dist/icons/`. There is no separate image copying or optimization pipeline.
The final build removes watch-mode maps.

## JavaScript lint

`eslint --config build/eslint.config.js .` applies ESLint recommended rules.
Browser modules under `src/js/` use browser globals and ES modules; build
JavaScript uses Node globals and CommonJS. `dist/` and `node_modules/` are ignored.
The checks are not suppressed for MNY Photo and do not reformat source.

## PHP syntax gate

The runner is copied from the reference and uses MNY Photo's own `Requires PHP:
7.4` header. It does not change the site's PHP version.

1. Collect regular PHP files recursively, case-insensitively, excluding
   `node_modules`, `vendor`, and `.git`. Fail on unreadable directories,
   unexpected symbolic links, or an empty scan.
2. Select explicit `PHP_BINARY`, PHP on PATH, or standard Local runtimes.
   An explicit empty/invalid/too-old binary fails. Automatic discovery can try
   another candidate and reports the actual version, SAPI, path, and source.
3. Run one bounded `php -l` process per file, with `php.ini` disabled and
   diagnostics captured. Fail on parser errors, process failures, or missing
   success output; preserve parser warnings. Report passed/failed/total counts.

```powershell
npm run lint:php
npm run lint:php -- --verbose
npm run lint:php -- --help
$env:PHP_BINARY = 'C:\path\to\php.exe'
npm run lint:php
Remove-Item Env:PHP_BINARY
```

PHP files are parsed, not executed. Passing with PHP 8.5 does not prove PHP 7.4
compatibility, WordPress behavior, coding standards, security, or accessibility.

## Source validation

The production build runs `validate.js` after Webpack. It checks:

- MNY Photo's runtime templates, readme, screenshot, and both compiled bundles.
- All six MNY page templates and their `Template Name:` headers.
- All 52 required template parts in the eight existing `page-*` folders,
  lowercase hyphenated names, and no root-level template parts.
- The seven existing `inc/` modules (including helpers and contact), PHP opening
  tags at byte one, and inclusion from `functions.php`.
- Literal `get_template_part()` targets across theme PHP.
- Native post-link/rewrite boundaries and portable-data boundaries, with the
  existing project-brief mail handler retained in `inc/contact.php`.
- Version agreement between `style.css`, package manifest, and lockfile roots.
- Imports for called `initX` JavaScript initializers in `src/js/main.js`.

Shibey's page inventory, six-module manifest, routing helper, plugin integrations,
and `initialize_` naming are not MNY Photo's structure. The checker uses MNY's
actual files and naming. It does not require Shibey's `theme.json`, LICENSE, or
third-party notices files where MNY has none. Existing clean-install routes and
direct `home_url()` fallbacks remain supported; imposing Shibey's centralized
routing helper would change unrelated functionality.

These are static checks, with the same text-pattern limitations as the reference.
They do not boot WordPress or replace browser testing.

## ZIP packaging

Default `npm run package` behavior matches Shibey:

- Preflight `wp-content/zipped-theme/` for writable output.
- Build fresh production bundles and validate the theme.
- Archive the complete theme except root `node_modules/`, including source,
  tooling, lockfile, documentation, metadata, PHP, and static assets.
- Retain the existing `MNYphoto-theme/` archive root.
- Write `MNYphoto-theme-MM-DD-YYYY-hh-mm-ss-AM-or-PM.zip.partial`, verify exact
  source/archive inventory and required runtime files, then rename to `.zip`.
- Remove partial output on failure. Timestamp uses the local process timezone.

The MNY-specific compatibility option preserves the old runtime package:

```powershell
npm run package -- --runtime-only
```

It writes `wp-content/zipped-theme/MNYphoto-theme.zip` from the original runtime
allowlist: root PHP templates, `inc/`, `languages/`, `page-templates/`,
`template-parts/`, style metadata, readme, screenshot, and `dist/` CSS/JS/images/icons.
Development source, tooling, metadata, and dependencies are excluded in this mode.

Packaging does not apply `.gitignore` or `.deployignore` and never runs lint.
Review the source inventory before sharing a full-theme ZIP. Pressable Git
deployment still excludes development files using the root `.deployignore`.

## WordPress asset loading and CI

`functions.php` loads `inc/enqueue.php` once. Its existing `nytt99_asset_url()`
helper resolves `dist/css/bundle.css` and `dist/js/bundle.js`. WordPress enqueues
one stylesheet and one deferred head script, with file modification times for
cache busting, the existing inline no-js switch, and conditional comment-reply.
Paths, handles, dependencies, and enqueue behavior were not changed.

The repository workflow remains PR-only for `production`, using MNY's theme path:

```text
checkout → Node 24 → npm ci → npm run lint → npm run build
         → git diff --exit-code -- dist/css/bundle.css dist/js/bundle.js
```

Commit reviewed production bundles with source changes to satisfy that last
check. CI does not package, upload, publish, or deploy.

## Vendor references

- [npm clean installation](https://docs.npmjs.com/cli/v11/commands/npm-ci/)
- [npm lockfile semantics](https://docs.npmjs.com/cli/v11/configuring-npm/package-lock-json/)
- [ESLint setup](https://eslint.org/docs/latest/use/getting-started)
- [Webpack output cleanup](https://webpack.js.org/configuration/output/#outputclean)
- [PHP CLI options](https://www.php.net/manual/en/features.commandline.options.php)
- [WordPress script enqueue API](https://developer.wordpress.org/reference/functions/wp_enqueue_script/)
