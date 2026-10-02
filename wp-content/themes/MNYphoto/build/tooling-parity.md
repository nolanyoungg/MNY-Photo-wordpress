# MNY Photo / Shibey npm tooling parity

Completed locally on October 1, 2026. No commit, push, merge, upload, or deployment
was performed. Shibey was used only as a read-only reference.

## Verified checkouts

| Repository | Remote | Branch | Commit | Theme |
| --- | --- | --- | --- | --- |
| MNY Photo, before edits | `https://github.com/nolanyoungg/MNY-Photo-wordpress.git` | `production` | `ec8235dade87bab64a415ad8e9bc47c14e2846c0` | `wp-content/themes/MNYphoto/` |
| Shibey reference | `https://github.com/nolanyoungg/shibey-wordpress.git` | `staging` | `ac99cee12bde9a720406d9d9847c262ed0ebc589` | `wp-content/themes/NOLAN-YOUNG-theme/` |

Both working trees were clean before work. The reference manifest, lockfile,
build scripts, source/enqueue paths, instructions, documentation, editor config,
and CI were inspected. Contrary to MNY's stale root guidance, this checkout already
contained source and build tooling. That guidance now reflects the actual path.

## Before/after command inventory

All six script names and script strings now match Shibey's reference manifest.
Commands below are invoked with `npm run <name>`.

| Command | MNY before | MNY after / Shibey equivalent | Dependencies and outputs |
| --- | --- | --- | --- |
| `dev` | Webpack development watch | Preserved, with matched toolchain | `webpack.config.js`, JS/SCSS imports, Webpack/loaders/Sass → both bundles and source maps; long-running. |
| `build` | Production Webpack + basic file/naming validation | Same command; expanded MNY-specific source contracts | Webpack pipeline + `validate.js` → minified CSS/JS, no maps, validation result. |
| `lint` | Missing | Added aggregate PHP then JS lint | npm child commands → diagnostics/status; stops if PHP fails. |
| `lint:js` | Missing | Added ESLint recommended checks | ESLint, `@eslint/js`, `globals`, `eslint.config.js` → authored browser/Node JS diagnostics. |
| `lint:php` | PHP discovery and syntax check | Reference runner with minimum-version gate, bounded processes, complete scan/failure diagnostics | Node, PHP, `style.css`, theme PHP → selected runtime and syntax totals. |
| `package` | Fixed-name runtime-only ZIP | Timestamped full-theme ZIP excluding root dependencies; old runtime mode retained via `-- --runtime-only` | `package-theme.js`, `archiver`, production build → validated ZIP under `wp-content/zipped-theme/`. |

The reference defines no npm test, formatting-check, type-check, separate validate,
or aggregate verify command. Its aggregate lint and production validation are
available above. MNY's standalone `node build/test-theme.js` is preserved and passes.
No empty scripts, disabled lint rules, or copied Shibey site features were added.

## Dependency and lockfile changes

| Direct development dependency | MNY locked before | Final locked version (matches Shibey) |
| --- | --- | --- |
| `@eslint/js` | absent | 10.0.1 |
| `archiver` | 8.0.0 | 8.0.0 |
| `css-loader` | 7.1.4 | 7.1.5 |
| `eslint` | absent | 10.11.0 |
| `globals` | absent | 17.12.0 |
| `mini-css-extract-plugin` | 2.10.2 | 2.10.2 |
| `sass` | 1.102.0 | 1.104.0 |
| `sass-loader` | 16.0.8 | 16.0.8 |
| `webpack` | 5.100.2 | 5.110.3 |
| `webpack-cli` | 6.0.1 | 6.0.1 |

Manifest dependency ranges and engines match Shibey exactly. All existing MNY
dependencies remain; neither theme has production npm dependencies. MNY's package
name and version remain `mnyphoto-theme@0.0.1`.

The lockfile remains version 3. npm 11.6.1 updated MNY's existing lockfile; it was
not replaced with Shibey's file or populated with invented dependency records.
Reference-version resolution was used to avoid newer transitive packages.
All **249 dependency package/version pairs** match Shibey, including the minifier.
npm retained three equivalent entries at nested locations (`@types/node`,
`undici-types`, and `minimizer-webpack-plugin`). Temporary resolution overrides
were removed before the final install; none remain in the manifest.

A final clean `npm ci --no-audit --no-fund` succeeded and left the lockfile hash
unchanged. `npm ls --depth=0` passed. No automatic audit fix or force upgrade ran.

## Changed files and reasons

Paths are repository-relative.

| File | Reason |
| --- | --- |
| `wp-content/themes/MNYphoto/package.json` | Six reference commands, dependencies, and Node/npm engines. |
| `wp-content/themes/MNYphoto/package-lock.json` | npm-generated reference dependency versions and root metadata. |
| `wp-content/themes/MNYphoto/.editorconfig` | Reference editor conventions; no formatting sweep. |
| `wp-content/themes/MNYphoto/build/eslint.config.js` | Reference recommended rules, browser/Node environments, generated/dependency ignores. |
| `wp-content/themes/MNYphoto/build/lint-php.js` | Reference PHP discovery/version/syntax runner, using MNY's PHP header. |
| `wp-content/themes/MNYphoto/build/validate.js` | Retain MNY inventory and add applicable reference source contracts. |
| `wp-content/themes/MNYphoto/build/package-theme.js` | Full-theme timestamped packaging, required-file/inventory checks, preserved runtime-only option. |
| `wp-content/themes/MNYphoto/src/js/components/site-navigation.js` | Remove one redundant empty-array initialization flagged by ESLint; both try/catch paths still assign the value. |
| `wp-content/themes/MNYphoto/dist/css/bundle.css` | Regenerated by the matched production toolchain, including CSS minimization. |
| `wp-content/themes/MNYphoto/dist/js/bundle.js` | Regenerated after the lint correction. |
| `.github/workflows/build.yml` | Node 24, aggregate lint, and stale committed-bundle gate; existing PR trigger and MNY paths retained. |
| `.deployignore` | Exclude the new editor config from server deployment. |
| `AGENTS.md` | Correct obsolete theme path/source-tree description and document current tooling. |
| `wp-content/themes/MNYphoto/AGENTS.md` | Extend documented command surface to the authorized parity commands. |
| `README.md` | Current CI steps and local command sequence. |
| `wp-content/themes/MNYphoto/README.md` | Exact install/development/verification/package instructions; link to current build documentation. |
| `wp-content/themes/MNYphoto/build/README.md` | Consolidate build behavior, configuration, source contracts, integration boundaries, and vendor references. |
| `wp-content/themes/MNYphoto/build/tooling-parity.md` | This inventory, comparison, change record, test evidence, and exceptions. |

Webpack configuration and all PHP, SCSS, content, images, and icons are unchanged.
The existing manual sanity script remains unchanged.

## Verification results

Runtime used: **Node 24.11.0, npm 11.6.1, PHP 8.5.6 CLI** on Windows.
The shell initially had Node 22.15.0/npm 10.9.2; those were not used for the final
npm workflow. An official Node 24.11.0 archive was downloaded to temporary storage
and checked against the vendor SHA-256 list. No global runtime was changed.

| Check | Result |
| --- | --- |
| Final clean `npm ci --no-audit --no-fund` | Passed; lockfile unchanged. |
| Direct dependencies and reference lock versions | Passed; all 249 dependency versions match. |
| `npm run lint` | Passed: 79 PHP files, zero syntax failures; ESLint passed. |
| `npm run build` | Passed: Webpack 5.110.3; 52 template parts, six page templates, seven include modules, references and versions validated. |
| `node build/test-theme.js` | Passed; existing MNY-only manual sanity check preserved. |
| `npm run dev` | Started successfully and emitted both development source maps. |
| JavaScript watch edit | Passed; a temporary DOM marker appeared in rebuilt JS. |
| SCSS watch edit | Passed; a temporary selector appeared in rebuilt CSS. |
| Watch restoration/stop | Both markers disappeared after restoring original source bytes. Watch process tree was stopped. Sandbox denied initial process cleanup; approved targeted cleanup succeeded. |
| Default `npm run package` | Passed; full theme, one MNY archive root, no dependencies or maps, exact inventory validated. |
| `npm run package -- --runtime-only` | Passed; original fixed-name runtime ZIP, 93 files, no development tooling/dependencies/maps. |
| Negative source-validation probes | Correctly rejected a missing runtime file, missing bootstrap include, invalid PHP opening, broken template reference, absent template header, version mismatch, and unimported initializer. Every probe was restored. |
| Negative PHP probes | Invalid syntax, explicit empty PHP binary, and below-minimum runtime rejected; valid PHP at a path containing spaces passed. |
| Isolated PHP enqueue harness | Passed single CSS/JS enqueue, correct existing asset paths/URLs, mtime versions, deferred head script, inline no-js switch, and conditional comment-reply. Used test doubles, not a running WordPress instance. |
| Final assets | Both bundles at existing paths; production maps absent; static images/icons unchanged; consecutive production builds reproducible. |
| `git diff --check` | Passed. |
| Shibey working tree | Remains clean and unchanged. |

The initial ESLint failure was fixed at its source. Sandbox cache/download/process
restrictions were resolved through approved access. No command failure remains
unresolved.

### Output comparison

- Sass 1.104.0's compressed output from unchanged SCSS equals the previous tracked
  stylesheet before Webpack minimization.
- Matched Webpack production optimization reduces CSS from 237,923 bytes
  (excluding its final newline) to 225,296 bytes. This is generated optimization,
  with no authored style changes.
- The rebuilt JavaScript is identical to the previous bundle except removal of
  the redundant `=[]` initialization (12,614 → 12,611 bytes excluding newline).
- Source entry points, filenames, WordPress handles/URLs, defer behavior, and
  static media are unchanged.
- CI's `git diff --exit-code` against HEAD is expected to report the intentionally
  regenerated bundles until these local changes are committed. Reproducibility
  was checked by comparing consecutive builds; no commit was made for testing.

## Necessary differences and untested boundaries

- Validation targets MNY's actual six page templates, 52 parts, seven include
  modules, `initX` functions, version 0.0.1, and PHP 7.4 header.
- MNY lacks Shibey's `theme.json`, local LICENSE/third-party-notices files,
  centralized routing module, and companion-plugin architecture. These were not
  copied or fabricated. Existing mail processing remains in `inc/contact.php`;
  existing showcase routes and direct URL fallbacks remain supported.
- The MNY ZIP retains the established `MNYphoto-theme/` internal root. Its
  runtime-only packaging option and standalone sanity script remain available.
- CI keeps MNY's existing PR-to-production trigger; Shibey's staging/push triggers
  are environment-specific and were not introduced.
- Neither reference formatting checks nor type checks/tests exist to run.
- Full WordPress/browser rendering, deployed assets/caches, PHP 7.4 compatibility,
  and a hosted GitHub Actions run were **not tested**. The named Local sandbox
  `nolan-young-theme-template-9999-masterd` was absent. Work stayed in this repository,
  as requested; no other local theme or live site was replaced for testing.
- All applicable npm commands and local checks are working. The remaining
  verification boundary is rendered/runtime testing in an approved WordPress
  environment, not an unresolved npm parity failure.

Exact ongoing commands and vendor references are in [README.md](README.md).
