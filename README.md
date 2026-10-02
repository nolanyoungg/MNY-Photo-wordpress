# MNY-Photo-wordpress
Wordpress repo for site MNY photo

## GITHUB WORKFLOW

The repository uses one combined GitHub Actions workflow:

`.github/workflows/build.yml`

### When it runs

The workflow runs for pull requests targeting the `production` branch. GitHub runs it when a pull request is opened, reopened, or updated with new commits.

The workflow is a validation and build workflow. It is not a deployment workflow.

### What it does

The workflow runs on a GitHub-hosted Ubuntu runner and uses the theme directory as its working directory:

`wp-content/themes/MNYphoto`

It performs these steps in order:

1. Checks out the repository.
2. Sets up Node.js 24 and caches npm data using the theme's `package-lock.json`.
3. Runs `npm ci` to install the exact locked development dependencies, including Webpack, Sass, and the theme's build tools.
4. Runs `npm run lint` to syntax-check PHP and run ESLint against authored JavaScript. If either fails, the workflow stops.
5. Runs `npm run build` after lint succeeds.
6. Runs `git diff --exit-code -- dist/css/bundle.css dist/js/bundle.js` to reject stale committed bundles.

The production build:

- Compiles the SCSS source into `dist/css/bundle.css`.
- Bundles and minifies the JavaScript into `dist/js/bundle.js`.
- Runs `build/validate.js` to validate the expected theme structure.
- Preserves the static files in `dist/images` and `dist/icons`.
- Does not generate production source maps.

### Failure behavior

The workflow fails if dependency installation, PHP/JavaScript linting, Webpack, the theme structure validator, or the committed-bundle check fails. Because the lint and build commands run sequentially, a failed lint prevents the asset build from running.

### What the workflow does not do

The workflow does not:

- Run `npm install`.
- Run `npm run package`.
- Create a ZIP file or upload a GitHub Actions artifact.
- Call the Pressable API.
- Commit or push generated files back to the repository.
- Deploy the theme directly.

The GitHub runner's generated `dist` files are temporary and disappear when the workflow finishes. Fresh production bundles must therefore be generated locally with `npm run build` and committed to Git when the repository tracks those generated files. Pressable then deploys the pushed production commit through its existing Git integration.

## Local theme tooling

Use Node 24.11.0+ and npm 9+. From `wp-content/themes/MNYphoto`:

```powershell
npm ci --no-audit --no-fund
npm run dev
# Stop the watcher with Ctrl+C before verification:
npm run lint
npm run build
```

See the [theme documentation](wp-content/themes/MNYphoto/README.md) and
[Shibey parity report](wp-content/themes/MNYphoto/build/tooling-parity.md) for all six commands, package options, versions, and validation results.
