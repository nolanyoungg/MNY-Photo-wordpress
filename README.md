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
2. Sets up Node.js 22 and caches npm data using the theme's `package-lock.json`.
3. Runs `npm ci` to install the exact locked development dependencies, including Webpack, Sass, and the theme's build tools.
4. Runs `npm run lint:php` to check the theme's PHP files for syntax errors. If this step fails, the workflow stops and does not build the assets.
5. Runs `npm run build` after PHP linting succeeds.

The production build:

- Compiles the SCSS source into `dist/css/bundle.css`.
- Bundles and minifies the JavaScript into `dist/js/bundle.js`.
- Runs `build/validate.js` to validate the expected theme structure.
- Preserves the static files in `dist/images` and `dist/icons`.
- Does not generate production source maps.

### Failure behavior

The workflow fails if dependency installation, PHP linting, Webpack, or the theme structure validator fails. Because the lint and build commands run sequentially, a failed PHP lint prevents the asset build from running.

### What the workflow does not do

The workflow does not:

- Run `npm install`.
- Run `npm run package`.
- Create a ZIP file or upload a GitHub Actions artifact.
- Call the Pressable API.
- Commit or push generated files back to the repository.
- Deploy the theme directly.

The GitHub runner's generated `dist` files are temporary and disappear when the workflow finishes. Fresh production bundles must therefore be generated locally with `npm run build` and committed to Git when the repository tracks those generated files. Pressable then deploys the pushed production commit through its existing Git integration.
