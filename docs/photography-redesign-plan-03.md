# MNY Photo redesign — concept 03

**Status: design review only.** October 1, 2026. This proposal responds to Nolan's four-panel photography reference and replaces concept 02's visual direction. WordPress implementation follows design approval, as requested. Previous concepts remain available for comparison.

Open [photography-concept-03.html](photography-concept-03.html). The HTML uses local styles and JavaScript in [assets/photography-concept-03/](assets/photography-concept-03/) and the six existing generated photographs in [assets/photography-concept-02/](assets/photography-concept-02/). Keep both asset folders with the HTML. No external fonts, scripts, or image requests are required.

## Visual direction: Your world, in focus

The opening composition follows the supplied reference: four tall, edge-to-edge photo panels, navigation laid over the photographs, restrained white captions, and a narrow charcoal control strip. The photographs fill the first screen. The MNY Photo identity and actual navigation stay intact.

Each panel has a small collection number, a short title, a photography category, and a link to the relevant portfolio collection. The strip moves horizontally, carrying the photographs and titles together. The first arrangement features pets, portraits, landscapes, and homes; families and events enter as the gallery advances.

The revised palette is neutral throughout:

| Role | Color |
| --- | --- |
| Hero controls, solid inner-page header, inquiry section, footer | Charcoal `#202020` |
| Main page background | Near-white `#fafafa` |
| Alternate sections | Light gray `#eeeeee` |
| Body text | Charcoal `#202020` |
| Secondary text on light surfaces | Gray `#686868` |
| Footer secondary text | Light gray `#bcbcbc` |

White navigation, borders, and controls sit over the photographs. The rest of the site uses simple sans serif typography, square image edges, generous spacing, and quiet rules. Natural color comes from the photographs. The footer and its large “Let's make something worth keeping” invitation form one continuous charcoal section.

## Header and categories

- **Services and Blog are the only dropdowns**, on desktop and mobile.
- **About and Portfolio are direct links.** Work becomes Portfolio as a visible label while retaining its existing WordPress identity and URL.
- **Contact Us stays a direct link**, and the logo returns home.
- Desktop dropdowns support hover previews, click to keep open, outside-click dismissal, and Escape. Mobile menus expand with buttons and remain scrollable.

Exactly six photography offerings appear throughout the preview: **Pets; Portraits; Family; Homes & real estate; Events; Landscapes.** Portraits include college graduation, high school seniors, children, and individual/self-portrait sessions. The portrait subtypes are not separate top-level categories.

These requirements supersede older theme instructions describing About or Work dropdowns.

## Moving gallery

- Four equal photo panels above 900 px; two between 561 and 900 px; one at 560 px and below.
- A 6.5-second interval advances the strip by one photograph. Bookend panels provide a continuous loop in both directions.
- Previous, next, pause/play, and six labeled collection controls remain available. Touch swipes also navigate.
- Manual selection pauses automatic movement. Play explicitly resumes it.
- Automatic movement pauses for gallery hover/focus, open menus or dialogs, an offscreen hero, and a hidden tab.
- Reduced-motion preferences disable automatic movement and transitions. Manual navigation remains available.
- Only visible panels expose their links to keyboard users and the accessibility tree. Automatic changes are not repeatedly announced; manual selections have a short status message.
- The HTML contains four static panels as a fallback. This prototype's other page views require JavaScript; the eventual WordPress site will render essential content and destinations server-side.

Panel photographs are intentionally tightly cropped to match the reference. Portfolio photo viewers show the complete photographs. For the production site, choose dedicated vertical crops with appropriate focal points, especially for groups and buildings, and supply optimized responsive sizes.

## Page previews retained

The new neutral design covers Home, Services, About, Portfolio, Blog, individual articles, Contact, Search, Privacy, the graduation campaign, and the 404 preview. All navigation stays within the HTML sample using hash routes. These routes illustrate the design; they do not replace the site's WordPress URLs.

The six filters, full-image portfolio viewer, sample story search, service detail links, and inquiry demonstration remain available. The contact form sends and stores nothing. The biography, posts, business details, and other example text remain review placeholders.

## Photo provenance

This revision reuses the six AI-generated concept photographs already commissioned for concept 02. No new photographs were generated, and the source image files were not altered. The original prompts remain in [photography-concept-02-prompts.json](photography-concept-02-prompts.json).

The preview labels these photographs as AI-generated examples. They are not represented as MNY Photo client work. The supplied screenshot is used as a layout reference, not as a source of portfolio images or another brand's identity.

## Implementation after approval

1. Preserve existing pages, posts, URLs, template assignments, content, and working integrations. Keep the `page-template-work.php` filename and page identity; update the visible label to Portfolio.
2. Create new photography template parts for navigation, the panel gallery, introductions, six-category service listings, portfolio and image viewer, process, blog cards, inquiry invitation, and footer. Update page templates to include those parts using the repository's established naming conventions.
3. Apply the approved design to `front-page.php`, Services, About, Portfolio, Contact, Privacy, campaign, and generic page templates, as well as `home.php`, `single.php`, archives, search, and 404. Preserve enabled comments, pagination, editor content, WordPress hooks, and native menu destinations.
4. Connect real media, posts, biography, and business details through existing WordPress APIs and theme helpers. Preserve the maintained contact handling while updating its presentation. Replace prototype hash routes with native destinations.
5. Put production CSS and JavaScript in the theme's source tree and regenerate bundles with the existing tooling. Update the template inventory validator for the new parts rather than disabling checks.
6. Validate lint/build/package checks and actual WordPress page rendering, menus, forms, keyboard navigation, reduced motion, mobile layouts, image loading, and responsive crops before preparing production changes.

No theme PHP, theme source styles/scripts, production bundles, or deployment settings are changed by concept 03. The previous tooling work remains separate and preserved.

## Preview validation

- Checked 13 page/article routes at five viewport targets (1440, 900, 768, 390, and 320 px): no horizontal overflow or broken loaded images in the exercised states.
- Visually reviewed the four-panel desktop hero, the two-panel tablet view, the one-panel phone view, the mobile Services menu, and the charcoal inquiry/footer section. Confirmed equal panel widths and the first desktop panel aligned at the viewport edge after the gallery settles.
- Observed automatic gallery movement and verified manual next/previous wrapping, collection selection, pause/play, and pausing when the hero is offscreen or a menu is open.
- Confirmed that Services and Blog are the only dropdown triggers, the mobile catalog contains all six categories, Blog contains the three sample articles, and Escape closes a dropdown and returns focus to its trigger.
- Followed a Blog story, loaded the Family portfolio filter, opened its complete photograph, and dismissed the viewer with Escape.
- Checked JavaScript syntax and local file references. Browser logs contained no warnings or errors in the exercised views. Verified that the pre-existing tracked theme/tooling diff was unchanged.

Reduced-motion handling is implemented; the operating system preference was not changed during these checks. The checks cover the local HTML prototype. Actual WordPress rendering, real content, maintained forms, and production image optimization remain part of implementation after design approval.
