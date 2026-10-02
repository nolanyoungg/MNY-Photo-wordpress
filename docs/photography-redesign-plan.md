# MNY Photo — photography website redesign

> Archived concept 01. The [revised concept 02 plan](photography-redesign-plan-02.md) supersedes this proposal's photography categories, navigation, hero, and visual direction.

**Status:** Concept 01, awaiting Nolan's design approval. Prepared October 1, 2026.

This proposal replaces the current agency-style presentation with a complete photography website. The current deliverable is a plan and a working HTML concept. PHP templates, theme styles, and production behavior have not been changed for this proposal. Existing npm-tooling changes in the working tree are separate and preserved.

## Review the concept

Open [photography-concept-01.html](photography-concept-01.html) in a browser. It is self-contained apart from the photographs in `docs/assets/photography-concept-01/`; keep that folder beside the HTML when copying it. No npm install or WordPress instance is needed.

The main navigation switches between complete page examples. The logo returns home. Portfolio filters, the photo viewer, service accordions, blog article links, mobile navigation, sample search, and the demonstration inquiry form work. The form sends and saves nothing. “Review notes” also links to the campaign and 404 examples.

| Example | Preview link |
| --- | --- |
| Homepage | [Home](photography-concept-01.html#home) |
| Services | [Services](photography-concept-01.html#services) |
| About | [About](photography-concept-01.html#about) |
| Portfolio, replacing the Work label | [Portfolio](photography-concept-01.html#portfolio) |
| Blog and three sample stories | [Blog](photography-concept-01.html#blog) |
| Contact | [Contact Us](photography-concept-01.html#contact) |
| Search and empty results | [Search](photography-concept-01.html#search) |
| Existing policy page, new typography | [Privacy layout](photography-concept-01.html#privacy) |
| Existing campaign page, new design | [Campaign](photography-concept-01.html#campaign) |
| Missing-page recovery | [404](photography-concept-01.html#not-found) |

The hash navigation is a convenience for reviewing several HTML examples in one file. The WordPress implementation will retain ordinary page URLs and server-rendered content.

## Proposed direction: The quiet frame

- **Mood:** Personal, calm, photographic, and editorial. Large images do the storytelling, with restrained text and generous spacing.
- **Color:** Warm ivory `#f5f3ed`, charcoal `#242520`, soft stone `#e8e9df`, and olive `#555c40` for details and focus states.
- **Typography:** Expressive serif headlines with occasional italic emphasis; a plain sans serif for navigation, descriptions, and controls. The preview uses system fonts and needs no font service.
- **Composition:** A wide photographic homepage hero, staggered portrait images, simple rules, readable article columns, and a dark inquiry section. No autoplay hero, carousel, or decorative dashboard panels.
- **Photography:** A broad mix of portraits, couples, weddings, and brand imagery is proposed. These categories are an assumption for review, not confirmed service offerings.
- **Voice:** Warm and direct, centered on the experience of being photographed. Sample copy avoids invented prices, awards, reviews, availability, delivery promises, and a fabricated biography.

The temporary wordmark is a layout suggestion. Final identity, photographs, biography, service area, session types, and contact details will use MNY Photo's actual materials. Stock photos are clearly labeled as examples; [credits and source links](photography-concept-credits.md) are included.

## Preserve the site structure

The main header retains **Services, About, Portfolio, and Blog**, plus the existing Contact Us action and homepage access through the logo. “Work” becomes “Portfolio” in visible navigation and headings. Services and Portfolio have photographic desktop menus; mobile uses a compact menu with the same primary destinations.

Keep existing page records, page IDs, template assignments, posts, menus, privacy content, and current URLs. The theme source can establish the template inventory, but the actual WordPress page and menu inventory must also be checked during implementation. Additional existing pages will continue to render through the redesigned generic page template.

Keep `page-templates/page-template-work.php` as the assignment-compatible entry point, rename its visible template label to Portfolio, and compose it from new portfolio parts. Existing Work URLs and internal route keys remain compatible. Do not silently change the page slug or delete/recreate the page. If a `/portfolio/` URL is later desired, explicitly map the existing page and add a permanent redirect from its old URL.

## Page designs and new template parts

Paths below are relative to `wp-content/themes/MNYphoto/`. All listed sections will receive newly written photography markup; this is a complete visual redesign rather than a color change to the existing sections. Top-level templates remain thin and include the new parts.

| Existing entry point to preserve | New parts and composition |
| --- | --- |
| `header.php`, `footer.php` | New shared header, primary navigation, photographic menu panels, mobile navigation, inquiry CTA, and footer parts under `template-parts/global/`. Preserve WordPress hooks and registered menu locations. |
| `front-page.php` | `page-front-page/content-front-page-{hero,introduction,portfolio,experience,services,process,journal,cta}.php`: statement and wide image, selected stories, personal approach, service choices, session process, and recent posts. |
| `page-templates/page-template-services.php` | `page-services/content-services-{hero,sessions,preparation,faq,cta}.php`: photo hero, detailed session types, planning guidance, practical questions, and inquiry link. |
| `page-templates/page-template-about-us.php` | `page-about-us/content-about-us-{hero,story,values,cta}.php`: photographer introduction, approved biography and actual portrait, approach, and contact invitation. |
| `page-templates/page-template-work.php` | `page-portfolio/content-portfolio-{hero,filters,gallery,viewer,cta}.php`: new Portfolio presentation, category controls, responsive photographs, captions, and keyboard-accessible viewer. |
| `home.php` | `page-blog/content-blog-{hero,featured,grid,pagination,cta}.php`: featured story, post cards, categories, and working WordPress pagination. |
| `single.php` | `page-blog/content-blog-single-{hero,article,navigation,related,comments,cta}.php`: real title, author/date, featured photo, editor content, previous/next posts, related stories, and existing comments where enabled. |
| `page-templates/page-template-contact-us.php` | `page-contact-us/content-contact-us-{hero,details,inquiry,cta}.php`: real contact information, service area, photo, and the maintained contact path. |
| `page-templates/page-template-privacy-policy.php` | `page-privacy-policy/content-privacy-policy-{hero,body}.php`: calm typography around the existing policy content and dates. |
| `page-templates/page-template-ppc-lp-2026.php` | `page-ppc-lp-2026/content-ppc-lp-2026-{hero,session,process,cta}.php`: a focused photography campaign with the existing page assignment retained. |
| `archive.php`, `search.php`, `index.php` | New `page-archive`, `page-search`, and shared result-card parts: genuine query results, category/archive titles, pagination, and helpful empty states. The HTML search demonstrates layout using sample articles only. |
| `page.php` | New `page-default` hero and body parts, retaining `the_content()` and multipage content navigation. |
| `404.php` | New `page-404` hero and recovery parts linking to Portfolio, the homepage, and search. |

Use the repository's `page-*` folders and `content-*` naming pattern. Shared cards and navigation belong in shared parts instead of copied markup. Once replacement templates work, remove obsolete agency sections only after verifying nothing still includes them. Update the template validator's required inventory to the approved new structure; do not weaken its missing-file or architecture checks.

## WordPress implementation approach

1. **Composition and compatibility.** Use [`get_template_part()`](https://developer.wordpress.org/reference/functions/get_template_part/) from the preserved entry templates. Keep existing helpers where they provide the needed behavior. Prefix new functions/settings with `mnyphoto_` or `MNYPHOTO_`; use the required `mnyphoto-theme` text domain for new strings, appropriate guards, sanitization, and output escaping. Avoid unrelated renames of legacy helpers.
2. **Editable content.** Preserve existing editor content and use WordPress Pages, posts, featured images, Media Library attachments, and gallery blocks where practical. Inspect the current theme's content controls before adding settings. The portfolio can initially use the existing page and category-grouped galleries; a new content type is not necessary for the approved layout.
3. **Images.** Replace concept stock with an approved MNY Photo selection and meaningful captions/alt text. Use [`wp_get_attachment_image()`](https://developer.wordpress.org/reference/functions/wp_get_attachment_image/) for generated image sizes and responsive image attributes. Reserve image dimensions, load the hero promptly, lazy-load lower photographs, and choose crops per viewport. Preserve the full photograph in the viewer. Do not ship the preview's stock gallery as MNY Photo's portfolio.
4. **Navigation.** Preserve configured menus and destinations, including additional existing menu items. Update the Work display label to Portfolio without changing destination identity. Menus must support click, keyboard, Escape, focus return, touch, and operation without hover. Normal page links remain usable without JavaScript.
5. **Progressive behavior.** Keep all core content and links server-rendered. Enhance portfolio filtering, viewing, and navigation with small JavaScript components. Avoid hiding readable content behind animation initialization. Honor reduced motion.
6. **Inquiries.** Keep forms presentation-only unless there is an existing maintained integration to retain. Visual approval does not create a new submission endpoint, email delivery promise, booking service, or data store. Any requested processing integration needs its own complete validation, consent/privacy, spam protection, errors, and delivery handling under repository rules.
7. **Source assets.** Build the design in `src/scss/` and `src/js/`, then regenerate the tracked production bundles with the npm build. Do not paste the standalone preview into PHP or hand-edit generated bundles. Keep the established build tooling.

## Implementation sequence after design approval

1. Confirm the approved look and session categories; inventory real WordPress pages, menu assignments, content, photography, and the current contact path. Record any missing business copy or assets without inventing them.
2. Build the shared visual system, header, desktop menus, mobile navigation, footer, and shared components.
3. Write the new page-specific template parts and update every entry template in the table to compose them. Connect genuine WordPress content, images, and URLs.
4. Implement gallery filters/viewer, responsive crops, inquiry presentation, article layouts, archives/search, and empty states. Preserve current functionality throughout.
5. Update theme documentation, image provenance, accessibility notes, and template checks to match the final implementation.
6. Run theme validation with Node 24.11.0+ and npm 9+: `npm ci`, `npm run lint`, `npm run build`, and the documented packaging command. Inspect the generated diff and package contents.
7. Verify in the designated WordPress preview environment: every retained page and template, real nav destinations, posts and pagination, search, comments where enabled, contact behavior, narrow/mobile/desktop layouts, keyboard focus, reduced motion, and missing-image/empty-content states. Static HTML checks alone do not establish WordPress runtime correctness.

Approval starts implementation of the selected concept. This proposal does not publish or deploy a redesign. Production deployment and the required live-site verification remain separate steps.

## Preview validation

- Checked all 13 page/article states at desktop, tablet, and mobile widths (1440, 768, 390, and 320 pixels). Fixed narrow-screen heading overflow and rechecked the affected views.
- Exercised mobile navigation, the desktop service menu and Escape dismissal, portfolio filtering, filtered lightbox navigation and Escape, service accordions, article routing, search results and empty results, the skip link, and the local inquiry confirmation.
- Confirmed the preview JavaScript parses, all seven directly referenced local image/document files exist, and browser checks produced no console warnings or errors.
- Confirmed this proposal did not alter the pre-existing tracked working-tree diff. No theme build is required for these standalone documentation artifacts; WordPress runtime and build validation belong to implementation.

## Review decision

Approve this direction, request specific changes, or reject it. The most useful feedback is the overall mood, typography, amount of whitespace, photo arrangement, and whether the proposed portrait/couple/wedding/brand mix fits MNY Photo. The actual photos and business copy can be supplied during implementation.
