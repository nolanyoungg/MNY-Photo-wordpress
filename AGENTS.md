# MNY Photo WordPress - Agent Instructions

## Repository overview

This repository contains the MNY Photo WordPress site theme. The main implementation is under `wp-content/themes/MNYphoto-theme/`.

Before making changes, read the relevant documentation:

- `README.md` for the repository overview and documented development commands.
- `wp-content/themes/MNYphoto-theme/README.md` for theme setup, packaging, forms, and photo provenance.
- `wp-content/themes/MNYphoto-theme/accessibility/README.md` for accessibility requirements.
- Any applicable workflow or policy files under `.github/` and the directory being changed.

The theme README describes an `src/` build tree and npm commands, but this checkout currently contains no `src/` directory or package manifest. Treat those commands as conditional on the source/tooling being present; do not invent generated output or dependencies.

## General working rules

- Inspect the current files and `git status --short` before editing.
- Preserve existing user changes, untracked files, naming, formatting, and architecture.
- Keep changes focused on the requested behavior. Do not perform unrelated refactors or dependency upgrades.
- Use WordPress core APIs and existing theme helpers before introducing new abstractions.
- Never add credentials, API keys, tokens, private data, or environment-specific secrets to the repository.
- Do not remove working behavior unless the task explicitly requires it.
- Update documentation when a change alters setup, commands, integrations, or content/editor behavior.

## WordPress and PHP conventions

- Keep the `ABSPATH` guard in PHP entrypoints where the existing file uses one.
- Prefix new theme functions, hooks, settings, and globals with `mnyphoto_` or `MNYPHOTO_` as appropriate.
- Use the existing text domain `mnyphoto-theme` for translatable strings.
- Escape output in the context where it is rendered (`esc_html`, `esc_attr`, `esc_url`, or equivalent) and sanitize values at input boundaries.
- Prefer hooks, template APIs, and established WordPress functions over direct database access or hard-coded site URLs.
- Keep forms presentation-only unless the task explicitly adds a maintained integration. Any future data-processing form must include server-side validation, sanitization, nonces, error handling, consent/privacy updates, spam controls, and a clear storage/delivery path.

## Validation

Run the strongest checks available for the files changed. At minimum, inspect the final diff and run:

```text
git diff --check
git status --short
```

For changed PHP files, run `php -l path/to/file.php` when PHP is available. If the package manifest and source tree are present, follow the theme README's npm workflow and run the relevant `npm run test`, `npm run build`, and `npm run package` checks. Do not claim those checks passed when the required tooling is absent.

For front-end or template changes, verify the affected page in WordPress when an installation is available. Recheck keyboard operation, visible focus, reduced-motion behavior, 200% zoom, 320px reflow, image alt text, and the `#content` landmark for relevant changes.

## Nested instructions

`wp-content/themes/MNYphoto-theme/AGENTS.md` adds more specific instructions for theme work. It inherits this file.
