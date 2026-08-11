# Accessibility requirements

MNY Photo targets keyboard, screen-reader, touch, and reduced-motion use as first-class modes.

- Keep the `#content` landmark and skip link in every page composition.
- Do not remove visible `:focus-visible` styles. New controls need an accessible name, a logical tab order, and keyboard equivalents.
- The mobile menu, desktop mega panels, accordion, tabs, and image modal synchronize their ARIA state in `src/js/` and retain essential content without JavaScript.
- The image modal traps focus, restores it to the launching figure, and closes with Escape.
- Motion-enhanced reveals and navigation canvas effects stop when `prefers-reduced-motion: reduce` is active.
- Use meaningful alt text for informative photographs and `alt=""` for decorative images. A visible caption should add context instead of repeating alt text.
- Preserve intrinsic image dimensions or an explicit aspect ratio. Do not lazy-load the likely LCP image.
- Presentation forms must remain honest until a plugin supplies processing. A future integration needs server-side validation, sanitization, nonces, error summaries, consent text, and a privacy-policy update.
- Recheck color contrast, zoom to 200%, 320px reflow, keyboard operation, and screen-reader labels after design or content changes.
