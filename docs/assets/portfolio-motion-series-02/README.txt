MNY Photo — moving portfolio proposals 16–25

Requested as ten new complete pages following the approved directions in
11 (mosaic), 12 (columns), and 13 (square rows). Earlier drafts are preserved.
No skills were installed or used. No production theme files were changed.

Build from the repository root:
  node docs/assets/portfolio-motion-series-02/build.mjs

Outputs: docs/portfolio-concept-16.html through portfolio-concept-25.html
Comparison index: docs/portfolio-motion-series-02.html
Each exported HTML contains its images, fonts, CSS, JavaScript, and font license.
All ten include six full service sections, native collection links, Services and
Blog dropdowns only, a contact invitation, footer, and an accessible photo viewer.

16 Open Mosaic — one large interlocking horizontal mosaic; staggered sections.
17 Gallery Columns — six opposing vertical columns; alternating feature sections.
18 Square Dance — centered white title, two square rows; three-column portfolio.
19 The Contact Sheet — three-level mosaic, editorial title; wide feature sections.
20 Still / Moving — white title panel alongside four columns; alternating sections.
21 Parallel Lives — title between opposing square rows; paired service sections.
22 Wide Open — panoramic mosaic and centered overlay title; editorial sections.
23 Quiet Current — white center title between photo columns; horizontal sections.
24 Frame by Frame — three square rows and split heading; compact service grid.
25 Collected Moments — two opposing mosaic ribbons, charcoal introduction;
   staggered service sections on white.

Shared sources reused at export time only:
  ../portfolio-motion/base.css — base navigation, viewer, motion primitives.
  ../portfolio-motion/motion.js — existing elapsed-time infinite-loop runtime.
  ../portfolio-redesign/manrope-*.ttf and Manrope-OFL.txt — licensed fonts.
  wp-content/themes/MNYphoto/dist/images/photography/*.webp — existing six
  AI-generated example photographs. These are not MNY Photo client work.

Motion starts automatically, continues on ordinary hover, pauses through a small
overlay button, and stops for open menus, the image viewer, a hidden document,
and an offscreen hero. Reduced motion yields a still, manually scrollable gallery.
There is no bottom hero control strip. Responsive layouts preserve the intended
photo direction while reducing columns and scaling type on smaller screens.

Future WordPress implementation should retain the existing Work page template,
with content-work-hero.php and separate content-work-[service].php sections under
template-parts/page-work/. Keep the existing src/build/dist workflow. These are
design drafts for selection, not a production implementation or release.

Validation passed: source and embedded CSS parsing, JavaScript syntax, exact HTML
nesting, unique IDs, all six service sections, expected hero lane counts, valid
embedded WebP/TTF bytes, local anchor/file destinations, portrait subtypes, and
1,125 forward/reverse loop coverage cases. The comparison index links all ten.
The theme has no changes. The exporter does not modify earlier proposals.

Verification limitation: browser policy previously blocked local-file previews.
Do not circumvent that restriction. Source/export checks do not verify rendered
appearance, image cropping, or interactive browser behavior.
