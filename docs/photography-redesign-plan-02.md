# MNY Photo redesign — concept 02

**Status: archived design proposal, not theme implementation.** Superseded by [concept 03](photography-redesign-plan-03.md) following Nolan's hero/header reference and palette feedback. This document and its HTML remain available for comparison.

Open [photography-concept-02.html](photography-concept-02.html). Its CSS, JavaScript, and all six photographs are local under [assets/photography-concept-02/](assets/photography-concept-02/). Keep the HTML and that asset folder together. The preview needs no WordPress instance, npm install, external scripts, remote fonts, or network image requests.

## The new direction

**Life in every frame:** a brighter, more energetic photography website. White space, deep blue-green typography, a soft yellow-green accent, a blue Contact Us button, and large, closely framed images. Bold sans serif titles combine with a restrained italic serif for a personal touch.

The homepage opens with a moving strip of photographs. The large center image slides into place with neighboring images visible at the edges. The headline changes with it: “Life, unleashed.” for pets, “Life, celebrated.” for portraits, “Life, together.” for families, and corresponding titles for the other collections.

Below the hero: a short introduction, six photographic service cards, selected photographs, a personal approach section, a three-step session overview, and recent blog stories. A bright inquiry section and simple footer complete the page.

## Exactly six photography categories

| Category | Included examples |
| --- | --- |
| Pets | Pet portraits, outdoor pet sessions, pets with their people |
| Portraits | College graduation, high school seniors, kids, individual and self-portrait sessions |
| Family | Family sessions, generations together, everyday family moments |
| Homes & real estate | Houses, property listings, rentals, interiors and exteriors |
| Events | Gatherings, celebrations, school and business events |
| Landscapes | Natural scenery, outdoor locations, seasonal landscapes |

These six categories are used consistently in the service menu, hero controls, homepage cards, Services page, Portfolio filters, contact selector, and footer. The original concept's extra offerings are removed from this version. Portrait subtypes remain within Portraits rather than becoming extra primary categories.

## Header behavior

- **Services:** a dropdown with all six categories. On desktop, a category selector updates a photograph, description, and linked session details. It supports hover previews and a click to keep the menu open. On mobile, each expanded category includes its description and links without depending on hover.
- **About:** a direct page link, with no dropdown.
- **Portfolio:** a direct page link, with no dropdown. This replaces the visible Work label.
- **Blog:** an editorial dropdown with three sample stories and a link to the full blog. The implementation will use real WordPress posts and handle sparse content gracefully.
- **Contact Us:** a direct contact link. The logo links home.

Only Services and Blog receive dropdown triggers on both desktop and mobile. Click outside or Escape dismisses the open panel. The mobile menu is scrollable and keeps every primary page available. Nolan's latest header requirements supersede older instructions describing Work and About dropdowns.

## Moving hero behavior

- Six slides, one for each requested photography category; autoplay advances every 6.5 seconds.
- The image strip slides horizontally while the title changes with a short fade and vertical movement.
- Previous/next buttons, direct category buttons, a pause/play control, and touch swipe support.
- Manual image selection pauses autoplay. A deliberate Play action resumes it.
- Automatic motion pauses while the photo area is hovered, focus is in the hero, a dropdown or dialog is open, the hero is offscreen, or the tab is hidden.
- Reduced-motion preferences disable autoplay and animated transitions while preserving manual navigation.
- Inactive slides stay out of keyboard order and the accessibility tree. Automatic slide changes do not repeatedly announce themselves; manual changes have a concise status message.
- A static first photograph and headline remain in the HTML as the non-JavaScript fallback. The final WordPress version will also render all essential page content and destinations server-side.

## Page previews

The HTML holds multiple page states so the design can be reviewed in one file. This convenience does not replace the site's WordPress URLs.

| Preview | What it demonstrates |
| --- | --- |
| [Home](photography-concept-02.html#home) | Moving gallery and title, all six services, selected frames, approach, process, blog |
| [Services](photography-concept-02.html#services) | Six detailed sections with links to specific portrait/session types and FAQs |
| [About](photography-concept-02.html#about) | A personal introduction and working approach; actual biography and portrait are still needed |
| [Portfolio](photography-concept-02.html#portfolio) | Six filters and an accessible full-photo viewer with previous/next and Escape |
| [Blog](photography-concept-02.html#blog) | Featured story and three distinct sample articles |
| [Contact](photography-concept-02.html#contact) | Six-category inquiry selector, standard form fields, local demonstration confirmation |
| [Search](photography-concept-02.html#search) | Search the three sample posts, including an empty-result state |
| [Privacy](photography-concept-02.html#privacy) | Typography for the existing policy content |
| [Campaign](photography-concept-02.html#campaign) | Graduation portrait campaign for the existing landing-page template |
| [404](photography-concept-02.html#not-found) | A helpful route back to the portfolio |

Contact fields are a demonstration only. Nothing is sent or saved. Sample copy does not establish pricing, turnaround times, service area, availability, or a booking commitment.

## Generated photographs and prompts

Six original illustrative images were generated with the **built-in image_gen tool**, one prompt per asset. No CLI/API fallback was used. [The exact prompt set](photography-concept-02-prompts.json) is saved for reproducibility and future revisions.

| Saved asset | Subject |
| --- | --- |
| [pets.png](assets/photography-concept-02/pets.png) | Golden retriever running through a meadow |
| [portraits.png](assets/photography-concept-02/portraits.png) | Adult college graduate in a navy cap and gown |
| [family.png](assets/photography-concept-02/family.png) | Parents and children walking together outdoors |
| [homes.png](assets/photography-concept-02/homes.png) | White two-story house with porch and landscaping |
| [events.png](assets/photography-concept-02/events.png) | Guests at a garden gathering under string lights |
| [landscapes.png](assets/photography-concept-02/landscapes.png) | Misty mountain lake at sunrise |

The review strip, notes, portfolio, viewer, and footer identify the images as AI-generated design examples. They do not represent MNY Photo's client work. Real portfolio photographs and verified business information will replace placeholders before the site presents actual commissions. Display crops use CSS; the generated source images are preserved in the repository, with originals retained in the generation output directory.

## Theme implementation after approval

Preserve every existing page, post, template assignment, and URL. Retain the Work page's identity and `page-templates/page-template-work.php` filename while changing its visible label to Portfolio. Do not silently change its slug or recreate the page. About, Services, Contact, Privacy, Blog, campaign pages, and generic pages remain available.

Write all-new photography template parts and update each entry template to include them, following the repository's `page-*` and `content-[page]-[section].php` naming pattern:

| Entry point | New composition |
| --- | --- |
| `header.php`, `footer.php` | Shared photography navigation/footer, Services and Blog panels only, native menu destinations and WordPress hooks preserved |
| `front-page.php` | New gallery hero, introduction, six services, selected photographs, approach, process, blog, and CTA parts |
| `page-template-services.php` | New hero, six-category directory, session details, FAQs, and CTA parts |
| `page-template-about-us.php` | New introduction, real photographer biography/portrait, approach, and CTA parts |
| `page-template-work.php` | New Portfolio hero, six-category filters, gallery, accessible viewer, and CTA parts |
| `home.php`, `single.php` | New blog hero, featured post, grid, pagination, article body, related posts, and existing comments where enabled |
| `page-template-contact-us.php` | New inquiry presentation and business details, preserving the maintained contact handling |
| `page-template-privacy-policy.php` | New readable wrapper around existing policy content |
| `page-template-ppc-lp-2026.php` | New focused campaign within the six-category scope |
| `page.php`, `archive.php`, `search.php`, `index.php`, `404.php` | Matching generic content, real results and pagination, empty states, and recovery layouts |

Custom page entry points remain under `page-templates/`. Audit includes before removing obsolete sections and update the structure validator to the approved inventory rather than disabling its checks. Use native WordPress content/media APIs and existing helpers; introduce new `mnyphoto_` functions only where needed. Use responsive attachment images, meaningful alt text, and real editor content. Source CSS and JavaScript belong in `src/`; regenerate production bundles through the existing build.

The previous plan's preservation and validation approach still applies, but this document controls the visual design, category list, navigation, and hero behavior. There is no deployment or production theme change in this revision.

## Preview checks completed

- Checked 13 page/article states at 1440, 900, 768, 390, and 320 pixels: 65 layout checks with no horizontal overflow.
- Checked all six changing hero titles at those five widths: 30 checks with no clipping or overlap with the introductory copy.
- Observed timed autoplay and the wrap from Landscapes back to Pets; verified manual category selection, previous/next, pause/play, and the corresponding title changes. Reduced-motion handling is implemented; the operating system preference was not changed during testing.
- Verified Services and Blog are the only dropdown triggers, switching menus closes the other one, Escape returns focus, desktop portrait previews show all four requested portrait types, and mobile Services shows the full six-category catalog.
- Followed a high school senior detail link, opened a story from the Blog dropdown, filtered the portfolio, opened and dismissed its photo viewer, searched matching and empty blog results, and exercised the local inquiry confirmation with a preselected portrait category.
- Parsed the JavaScript successfully, checked local asset/document references, and found no browser console warnings or errors in the exercised views. Confirmed the prior tracked theme/tooling diff was unchanged.

These are checks of the HTML design prototype. Actual WordPress rendering, production forms, real content, and final optimized assets will be verified during implementation.

## Review and next steps

Review the moving hero, menu behavior, six categories, and the overall look. Once this direction is approved, build the new template parts and connect real WordPress content and images. Validate the npm lint/build/package workflow and the actual WordPress pages, menus, contact path, keyboard operation, mobile layouts, reduced motion, and image performance before preparing a production change.
