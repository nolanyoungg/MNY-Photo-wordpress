/** Ten standalone portfolio proposals extending the approved directions 11–13. */
import { readFile, writeFile } from 'node:fs/promises';

const here = new URL('./', import.meta.url);
const docs = new URL('../../', import.meta.url);
const repository = new URL('../../../', import.meta.url);
const previous = new URL('../portfolio-motion/', import.meta.url);
const fonts = new URL('../portfolio-redesign/', import.meta.url);
const live = 'https://mnyphoto.mystagingwebsite.com';
const escape = value => String(value).replaceAll('&', '&amp;').replaceAll('"', '&quot;').replaceAll('<', '&lt;').replaceAll('>', '&gt;');

const services = [
  { id: 'pets', name: 'Pets', title: 'Their personality.<br>Every little bit of it.', description: 'The head tilt. The happy sprint. The way they look at you. Unhurried photographs of a very important member of the family.', scope: 'Pet portraits · Outdoor sessions · Pets & their people', alt: 'A golden retriever running through a meadow of white flowers', position: '50% 46%' },
  { id: 'portraits', name: 'Portraits', title: 'A new chapter.<br>A familiar you.', description: 'A milestone worth celebrating, or a moment just for yourself. Portraits with room to move, settle in, and feel like you.', scope: 'College graduation · High school seniors · Kids · Individual & self-portrait sessions', alt: 'An adult graduate smiling in a navy cap and gown on a leafy campus', position: '50% 30%' },
  { id: 'family', name: 'Family', title: 'Your favorite people.<br>As they are, right now.', description: 'A little laughter, a little closeness, and all the things that make this season yours. There’s room for everyone to be themselves.', scope: 'Family sessions · Generational portraits · Everyday moments', alt: 'Two parents and two children walking together along a sunny meadow path', position: '50% 25%' },
  { id: 'homes', name: 'Homes & real estate', title: 'Good light.<br>A sense of place.', description: 'Thoughtful photographs that show how a space feels, how the rooms connect, and what makes a home worth a second look.', scope: 'Property listings · Rentals · Interiors · Exteriors', alt: 'A white two-story house with a wooden front door and a landscaped lawn', position: '50% 50%' },
  { id: 'events', name: 'Events', title: 'Be in the moment.<br>Keep it for later.', description: 'The people, the atmosphere, the little exchanges. Photographs that let you return to the feeling of being there.', scope: 'Celebrations · Community gatherings · School & business events', alt: 'Guests laughing around a garden dinner table beneath string lights', position: '50% 40%' },
  { id: 'landscapes', name: 'Landscapes', title: 'Some places<br>stay with you.', description: 'Wide horizons, quiet corners, and light that changes everything. A collection for the places that ask you to slow down.', scope: 'Natural scenery · Outdoor locations · Seasonal landscapes', alt: 'A still mountain lake reflecting forest ridges under a soft sunrise', position: '50% 50%' },
];
for (const service of services) {
  for (const [key, suffix] of [['src', ''], ['small', '-768']]) {
    const bytes = await readFile(new URL(`wp-content/themes/MNYphoto/dist/images/photography/${service.id}${suffix}.webp`, repository));
    service[key] = `data:image/webp;base64,${bytes.toString('base64')}`;
  }
}
const subject = id => services.find(item => item.id === id);
const all = services.map(item => item.id);
const rotate = offset => [...all.slice(offset), ...all.slice(0, offset)];

const designs = [
  { n: 16, name: 'Open Mosaic', family: 'Mosaic', inspired: 11, layout: 'stagger', light: false, heading: 'All the things<br>worth keeping.', lead: 'Your people. Your places. Your very good pets.', note: 'An expansive, mixed-size mosaic with a title tucked into the lower left. An airy, staggered portfolio follows.', intro: 'A little of everything.<br>A lot to remember.' },
  { n: 17, name: 'Gallery Columns', family: 'Columns', inspired: 12, layout: 'alternating', light: false, heading: 'The good stuff.<br>Collected.', lead: 'Photographs of the life happening around you.', note: 'Six slender photo columns drift in alternating directions behind a centered title. Large alternating collections below.', intro: 'Six ways to see<br>what matters.' },
  { n: 18, name: 'Square Dance', family: 'Rows', inspired: 13, layout: 'grid', light: true, heading: 'Life, in good company.', lead: 'For the people, pets, and places you never want to forget.', note: 'A clean white introduction above two generous rows of square photographs. A compact three-column portfolio.', intro: 'Find your kind<br>of photograph.' },
  { n: 19, name: 'The Contact Sheet', family: 'Mosaic', inspired: 11, layout: 'editorial', light: true, heading: 'A life.<br>In a thousand frames.', lead: 'A moving collection of little moments and wide-open views.', note: 'A three-level contact sheet with large, small, and panoramic images below an editorial title. Wide feature sections.', intro: 'The portfolio,<br>one collection at a time.' },
  { n: 20, name: 'Still / Moving', family: 'Columns', inspired: 12, layout: 'alternating', light: true, heading: 'Make room<br>for the<br>memories.', lead: 'Thoughtful photography. A little less posing. A little more you.', note: 'A quiet white title panel beside four moving photo columns. Photography and typography share the screen.', intro: 'For this chapter.<br>And the next.' },
  { n: 21, name: 'Parallel Lives', family: 'Rows', inspired: 13, layout: 'pairs', light: true, heading: 'So much to hold on to.', lead: 'The everyday. The once-in-a-lifetime. And everything between.', note: 'Opposing square-photo rows frame a generous white title band. Six collections arranged as spacious pairs.', intro: 'What would you<br>like to remember?' },
  { n: 22, name: 'Wide Open', family: 'Mosaic', inspired: 11, layout: 'editorial', light: false, heading: 'Room for<br>your whole world.', lead: 'People, pets, celebrations, and places. All welcome here.', note: 'Panoramic rectangles meet tall portraits and small squares in a wide, continuous mosaic. Centered, oversized type.', intro: 'Take a closer look.' },
  { n: 23, name: 'Quiet Current', family: 'Columns', inspired: 12, layout: 'bands', light: true, heading: 'Life moves.<br>Keep the<br>feeling.', lead: 'A collection of people, places, and moments that stay.', note: 'A still white center column sits between moving photo galleries. An understated, horizontal collection layout.', intro: 'Your story has<br>more than one side.' },
  { n: 24, name: 'Frame by Frame', family: 'Rows', inspired: 13, layout: 'grid', light: true, heading: 'Good days.<br>Great photographs.', lead: 'Six collections. A whole world worth a closer look.', note: 'Three fine-spaced rows of square photographs create a lively contact sheet beneath a split editorial heading.', intro: 'Something here<br>will feel like you.' },
  { n: 25, name: 'Collected Moments', family: 'Mosaic', inspired: 11, layout: 'stagger', light: false, heading: 'Nothing ordinary<br>about your everyday.', lead: 'The MNY Photo portfolio. Made of the things that matter.', note: 'Two independent mosaic ribbons move in opposite directions against charcoal. A quieter, white portfolio below.', intro: 'A collection<br>close to home.' },
];

function image(id, { small = false, eager = false, decorative = false } = {}) {
  const item = subject(id);
  return `<img src="${small ? item.small : item.src}" width="${small ? 768 : 1536}" height="${small ? 512 : 1024}" alt="${decorative ? '' : escape(item.alt)}" loading="${eager ? 'eager' : 'lazy'}" decoding="async" style="object-position:${item.position}">`;
}
function lane(ids, { axis = 'x', speed = 30, kind = 'squares' } = {}) {
  return `<div class="loop-lane lane--${kind}" data-loop data-axis="${axis}" data-speed="${speed}"><div class="loop-track"><div class="loop-group">${ids.map((id, index) => `<div class="motion-tile tile-${index + 1}" data-subject="${id}">${image(id, { small: true, eager: true, decorative: true })}</div>`).join('')}</div></div></div>`;
}
function columns(count, speed = 22) {
  return Array.from({ length: count }, (_, index) => lane(rotate(index).slice(0, 3), { axis: 'y', speed: index % 2 ? -speed : speed + 4, kind: 'columns' })).join('');
}
function board(design) {
  switch (design.n) {
    case 16: return lane([...all, 'family', 'landscapes'], { kind: 'open-mosaic', speed: 31 });
    case 17: return columns(6, 22);
    case 18: return lane(all, { speed: 34 }) + lane(rotate(3), { speed: -29 });
    case 19: return lane([...all, 'pets', 'portraits', 'events'], { kind: 'contact-mosaic', speed: 29 });
    case 20: return columns(4, 23);
    case 21: return lane(rotate(1), { speed: 32 }) + lane(rotate(4), { speed: -32 });
    case 22: return lane([...all, 'landscapes', 'family'], { kind: 'wide-mosaic', speed: 32 });
    case 23: return columns(4, 20);
    case 24: return lane(rotate(0), { speed: 29 }) + lane(rotate(2), { speed: -35 }) + lane(rotate(4), { speed: 26 });
    case 25: return lane(all, { kind: 'ribbon', speed: 30 }) + lane(rotate(3), { kind: 'ribbon', speed: -27 });
    default: throw new Error('Unknown design');
  }
}
const logo = `<a class="logo" href="${live}/" aria-label="MNY Photo home"><strong>MNY</strong><span>PHOTO</span></a>`;
function header(design) {
  return `<a class="skip-link" href="#portfolio">Skip to portfolio</a><header class="site-header${design.light ? ' site-header--light' : ''}">${logo}<nav class="main-nav" aria-label="Main navigation"><details class="nav-dropdown"><summary>Services <span aria-hidden="true">+</span></summary><div>${services.map(item => `<a href="#${item.id}">${escape(item.name)}</a>`).join('')}</div></details><a href="${live}/who-we-are/">About</a><a href="#portfolio" aria-current="page">Portfolio</a><details class="nav-dropdown"><summary>Blog <span aria-hidden="true">+</span></summary><div><a href="${live}/resources/">Read the blog</a><a href="${live}/?s=photography">Find a photography article</a></div></details></nav><a href="#contact" class="header-contact">Let’s talk</a></header>`;
}
function hero(design) {
  return `<!-- Future part: template-parts/page-work/content-work-hero.php -->
  <section class="hero" data-motion-hero aria-labelledby="portfolio-title"><div class="motion-board" aria-hidden="true">${board(design)}</div><div class="hero-shade" aria-hidden="true"></div><div class="hero-copy"><div class="hero-heading"><p class="eyebrow">MNY Photo / The portfolio</p><h1 id="portfolio-title">${design.heading}</h1></div><div class="hero-caption"><p>${design.lead}</p><a href="#collections">Explore the collections <span aria-hidden="true">↘</span></a></div></div><button class="motion-toggle" type="button" aria-label="Pause moving photographs" aria-pressed="false" data-motion-toggle hidden><span aria-hidden="true">Ⅱ</span></button></section>`;
}
function collections(design) {
  return `<section class="collection-intro shell" id="collections"><div><p>People. Places. Everything between.</p><h2>${design.intro}</h2></div><nav aria-label="Photography collections">${services.map(item => `<a href="#${item.id}">${escape(item.name)}</a>`).join('')}</nav></section><div class="collections shell layout-${design.layout}">${services.map((item, index) => `<!-- Future part: template-parts/page-work/content-work-${item.id}.php -->
  <section class="collection collection--${item.id}" id="${item.id}" aria-labelledby="heading-${item.id}"><figure><button class="photo-button" type="button" data-photo="${item.id}" aria-label="View complete ${escape(item.name.toLowerCase())} photograph">${image(item.id)}<span>View photograph ↗</span></button></figure><div class="collection-copy"><div class="collection-label"><span aria-hidden="true">0${index + 1}</span><h2 id="heading-${item.id}">${escape(item.name)}</h2></div><p class="collection-title">${item.title}</p><p class="description">${item.description}</p><p class="scope">${item.scope}</p><a href="#contact">Let’s plan your session <span aria-hidden="true">↗</span></a></div></section>`).join('\n')}</div>`;
}
function contact() {
  return `<!-- Future part: template-parts/page-work/content-work-contact.php --><section class="contact-section" id="contact"><div class="shell contact-inner"><div><p>There’s a photograph in that.</p><h2>Tell us what<br>you have in mind.</h2></div><div><p>A new chapter. A full house. A favorite place. We’d love to help you remember it.</p><a class="button" href="${live}/contact/">Start a conversation <span aria-hidden="true">↗</span></a></div></div></section>`;
}
function footer(design) {
  return `<footer class="site-footer"><div class="shell footer-top">${logo}<nav aria-label="Footer navigation"><a href="${live}/who-we-are/">About</a><a href="#collections">Portfolio</a><a href="${live}/resources/">Blog</a><a href="${live}/contact/">Contact</a></nav><a href="#portfolio">Back to top ↑</a></div><div class="shell footer-bottom"><p>AI-generated design examples, not MNY Photo client work.</p><a href="portfolio-motion-series-02.html">${design.n} / ${design.name} · Compare all ten</a></div></footer>`;
}
const viewer = `<dialog id="photo-viewer" class="photo-viewer" aria-labelledby="viewer-title"><div class="viewer-top"><h2 id="viewer-title"></h2><button type="button" data-close-viewer aria-label="Close photograph">×</button></div><img class="viewer-image" alt=""><div class="viewer-bottom"><p>Complete photograph · AI-generated example</p><div><button type="button" data-previous aria-label="Previous photograph">←</button><span data-viewer-counter></span><button type="button" data-next aria-label="Next photograph">→</button></div></div></dialog>`;

let fontCss = '';
for (const weight of [400, 600, 800]) {
  const bytes = await readFile(new URL(`manrope-${weight}.ttf`, fonts));
  fontCss += `@font-face{font-family:Manrope;font-weight:${weight};font-style:normal;font-display:swap;src:url(data:font/ttf;base64,${bytes.toString('base64')}) format('truetype')}\n`;
}
const license = await readFile(new URL('Manrope-OFL.txt', fonts), 'utf8');
const base = await readFile(new URL('base.css', previous), 'utf8');
const common = await readFile(new URL('common.css', here), 'utf8');
const runtime = await readFile(new URL('motion.js', previous), 'utf8');
function document(title, css, body, script = '') {
  return `<!doctype html>\n<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="robots" content="noindex,nofollow"><title>${escape(title)}</title><style>${fontCss}\n${base}\n${css}</style></head>${body}${script ? `<script>${script}</script>` : ''}<script type="text/plain" id="font-license">${license}</script></body></html>`;
}
for (const design of designs) {
  const css = await readFile(new URL(`design-${design.n}.css`, here), 'utf8');
  const body = `<body class="concept-${design.n}">${header(design)}<main id="portfolio">${hero(design)}${collections(design)}${contact()}</main>${footer(design)}${viewer}`;
  const html = document(`${design.n} — ${design.name} | MNY Photo`, `${common}\n${css}`, body, runtime);
  await writeFile(new URL(`portfolio-concept-${design.n}.html`, docs), html);
  console.log(`${design.n} ${design.name}: ${(Buffer.byteLength(html) / 1024 / 1024).toFixed(2)} MB`);
}

const indexCss = await readFile(new URL('index.css', here), 'utf8');
const indexBody = `<body class="comparison"><header class="shell comparison-header">${logo}<a href="portfolio-motion.html">Earlier designs 11–15 ↗</a></header><main class="shell"><section class="comparison-intro"><p>Portfolio studies / 16—25</p><h1>More of<br>what moves you.</h1><div><p>Ten complete pages exploring the mosaics, columns, and photo rows from designs 11, 12, and 13.</p><nav aria-label="Design families"><a href="#mosaic">Mosaics</a><a href="#columns">Columns</a><a href="#rows">Photo rows</a></nav></div></section>${[['Mosaic', 'mosaic', 'From design 11', 'Mixed sizes. One moving canvas.'], ['Columns', 'columns', 'From design 12', 'A gallery in constant flow.'], ['Rows', 'rows', 'From design 13', 'Same-size frames. Opposing rhythms.']].map(([family, id, source, heading]) => `<section class="comparison-family" id="${id}"><div class="family-heading"><p>${source}</p><h2>${heading}</h2></div><div class="comparison-grid">${designs.filter(design => design.family === family).map(design => `<article><a class="mini-preview mini-${id} mini-${design.n}" href="portfolio-concept-${design.n}.html" aria-label="Open design ${design.n}: ${design.name}">${rotate(design.n % 6).map(item => image(item, { small: true })).join('')}<span>${design.n}</span></a><div class="option-title"><h3>${design.name}</h3><a href="portfolio-concept-${design.n}.html" aria-label="Open ${design.name}">↗</a></div><p>${design.note}</p><a class="open-page" href="portfolio-concept-${design.n}.html">Open the full page</a></article>`).join('')}</div></section>`).join('')}</main><footer class="shell comparison-footer"><p>Every sample includes Pets, Portraits, Family, Homes & real estate, Events, and Landscapes.</p><p>Automatically looping galleries · Pause controls · Reduced-motion support</p><p>AI-generated photographs for design exploration.</p></footer>`;
await writeFile(new URL('portfolio-motion-series-02.html', docs), document('MNY Photo — ten more moving portfolios', indexCss, indexBody));
console.log('Comparison: docs/portfolio-motion-series-02.html');
