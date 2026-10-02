MNY Photo — five moving portfolio proposals

Outputs in docs/: portfolio-concept-11.html through portfolio-concept-15.html.
Comparison index: portfolio-motion.html. Each HTML export is standalone, with
embedded WebP photographs, Manrope fonts, CSS, JavaScript, and the font license.
The existing ten proposals are preserved.

Build: node docs/assets/portfolio-motion/build.mjs
Source fonts and license: ../portfolio-redesign/manrope-*.ttf and Manrope-OFL.txt.
Photo sources: the existing theme dist/images/photography WebP files.
The six photographs are AI-generated design examples, not client work.

11 Mosaic Drift: horizontal grid of square, tall, and wide photographs.
12 Vertical Gallery: opposing columns containing different image heights.
13 Double Exposure: opposing horizontal rows of equal square photographs.
14 Moving Frames: three horizontal rows of mixed-width frames at different speeds.
15 Endless Gallery: continuously moving, equal-size, edge-to-edge photo panels.

Design 12 revision: only its bottom contact invitation is replaced with a six-way
photography selector (contact-12.mjs and contact-12.css). Native radio inputs swap
the preview photo, session guidance, and inquiry link through scoped CSS. Arrow
keys select a category; Tab reaches the chosen panel's links. The selector works
without JavaScript, honors reduced motion, and stacks into a two-column choice
grid on phones. The inquiry links use the existing contact form's ?category=
parameter. The hero, navigation, six portfolio sections, footer, and shared motion
runtime remain unchanged. Browsers without :has support see all six suggestions.
The section is titled "Contact Us" and uses a soft blue-to-lilac gradient with
dark text and slate selection/button states. The footer keeps its original color.

All five are full portfolio pages with six service sections, a contact invitation,
footer, and full-image viewer. Only Services and Blog have header dropdowns.
The hero loops automatically; ordinary hover does not pause it. A small overlay
button pauses/resumes motion. Open menus, the photo viewer, a hidden document,
and an offscreen hero suspend playback. Reduced-motion preferences produce a
still, manually scrollable gallery. There is no hero-bottom control strip.

Loop strategy: measure each original photo group, append enough inert copies to
cover the viewport plus one complete cycle, and translate by elapsed time modulo
the group length. Padding inside each group makes the cycle's final gap identical
to its internal gaps. This supports reverse travel and avoids restarting at a
visibly different image. Resizing retains cycle position and recalculates coverage.
The hero is decorative; the six collections below supply accessible photographs,
headings, native navigation, and keyboard-operated image enlargement.

The downloaded frontend-design skill was removed at Nolan's request. These drafts
do not use it, and no replacement skill was installed. No production theme files
were changed. A selected design can use content-work-hero.php, per-service
content-work-[service].php parts, the existing Work page template, and the retained
source/build/dist workflow.

Verification: CSS parsing and JavaScript syntax checks passed. Loop geometry was
checked for 1,875 combinations of direction, elapsed time, cycle position, image
group length, and 320–3840px viewport width; coverage and elapsed-time speed passed.
HTML structure, unique IDs, all six sections, native anchors, embedded image/font
validity, and independent-file resources were checked. Actual browser rendering
and interactive visual behavior are unverified: prior browser policy blocked
local-file access, and that restriction was not bypassed.
