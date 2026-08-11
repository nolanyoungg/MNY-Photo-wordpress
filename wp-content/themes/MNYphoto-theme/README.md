# MNY Photo WordPress Theme

MNY Photo is a classic WordPress photography theme with an editorial portfolio, five-practice service system, live journal, accessible presentation forms, and rich desktop/mobile navigation.

## Development

Requirements: WordPress 6.7+, PHP 7.2+, Node.js 20+, and npm.

```text
npm install
npm run dev
npm run build
npm run test
npm run package
```

Source SCSS and JavaScript live in `src/`; WordPress serves compiled files from `dist/`. The packaging script writes `wp-content/zipped-theme/MNYphoto-theme.zip` and excludes source tooling, dependencies, secrets, caches, and maps.

## WordPress setup

Activate **MNY Photo**, assign the included page templates to Services, About Us, Work, Contact Us, Privacy Policy, and the PPC page, then set a static homepage and posts page under Settings → Reading. Assign menus to the Primary and Footer locations. Studio email, availability, and optional social links are editable under Appearance → Customize → MNY Photo studio details.

Forms are intentionally presentation-only. Install a maintained WordPress forms/newsletter plugin and replace or connect the marked forms before accepting visitor data. Processing, storage, delivery, spam controls, and consent records belong in that plugin.

Bundled photo provenance is documented in `dist/img/ATTRIBUTION.md`. Media selected from the WordPress Media Library is rendered with core attachment functions where available.

## Accessibility

See `accessibility/README.md` for keyboard, focus, motion, image, and integration requirements.
