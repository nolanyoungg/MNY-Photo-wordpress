/** Export the glass header using the actual theme markup, styles and navigation. */
import { readFile, writeFile } from 'node:fs/promises';
import { Script } from 'node:vm';

const docs = new URL('../../', import.meta.url);
const theme = new URL('../../../wp-content/themes/MNYphoto/', import.meta.url);
let html = await readFile(new URL('portfolio-concept-12.html', docs), 'utf8');
const headerSource = await readFile(new URL('template-parts/page-shared/content-shared-header.php', theme), 'utf8');
const headerStyles = await readFile(new URL('src/scss/layout/header.scss', theme), 'utf8');
const portfolioStyles = await readFile(new URL('src/scss/pages/portfolio.scss', theme), 'utf8');
const heroSource = await readFile(new URL('template-parts/page-portfolio/00-portfolio-hero.php', theme), 'utf8');
const navigationSource = await readFile(new URL('src/js/components/site-navigation.js', theme), 'utf8');
const esc = value => value.replaceAll('&', '&amp;').replaceAll('"', '&quot;').replaceAll('<', '&lt;');
const originalHeader = html.match(/<header\b[\s\S]*?<\/header>/)?.[0];
const brand = originalHeader?.match(/<a class="logo"[\s\S]*?<\/a>/)?.[0];
if (!brand) throw new Error('Could not locate the approved sample identity.');

const services = [
  ['pets', 'Pets'], ['portraits', 'Portraits'], ['family', 'Family'],
  ['homes', 'Homes & real estate'], ['events', 'Events'], ['landscapes', 'Landscapes'],
];
const live = 'https://mnyphoto.mystagingwebsite.com';
function dropdown(key, label, href, links) {
  return `<div class="nav-group" data-nav-group="${key}"><div class="nav-row"><a href="${href}">${label}</a><button type="button" class="nav-toggle" aria-label="${label} menu" aria-expanded="false" aria-controls="${key}-menu" data-menu="${key}"><span class="nav-toggle-label" aria-hidden="true">${label}</span><svg class="nav-chevron" width="18" height="18" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="m5 8 7 7 7-7" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" /></svg></button></div><div id="${key}-menu" class="dropdown" hidden><div class="shell preview-menu-links">${links}</div></div></div>`;
}
const nav = dropdown('services', 'Services', `${live}/what-we-do/`, services.map(([id, label]) => `<a href="#${id}">${esc(label)}</a>`).join(''))
  + `<a href="${live}/who-we-are/">About</a><a href="#portfolio" aria-current="page">Portfolio</a>`
  + dropdown('blog', 'Blog', `${live}/resources/`, `<a href="${live}/resources/">Read the blog</a><a href="${live}/?s=photography">Find a photography article</a>`);

let header = headerSource.slice(headerSource.indexOf('<header'));
header = header.replace("<?php get_template_part( 'template-parts/page-shared/content', 'shared-brand' ); ?>", brand)
  .replace('<?php mnyphoto_primary_navigation(); ?>', nav)
  .replace("<?php echo esc_url( mnyphoto_url( 'contact' ) ); ?>", '#contact')
  .replace(/<\?php (?:esc_attr_e|esc_html_e)\( '([^']+)', 'mnyphoto-theme' \); \?>/g, (_, label) => esc(label));
if (header.includes('<?php') || !header.includes('mnyphoto-header-contact-cutout')) throw new Error('Incomplete header export.');

html = html.replace('<html lang="en">', '<html lang="en" class="no-js">')
  .replace('</head>', '<script>document.documentElement.classList.replace("no-js", "js");</script></head>')
  .replace(/<title>.*?<\/title>/, '<title>Liquid glass navigation — MNY Photo header preview 02</title>')
  .replace(originalHeader, header);
const heroCopySource = heroSource.match(/<div class="portfolio-hero-copy">[\s\S]*?<\/div>/)?.[0];
const heroCopyStyles = portfolioStyles.match(/\/\* Hero readability panel:[\s\S]*?\/\* End hero readability panel\. \*\//)?.[0];
if (!heroCopySource || !heroCopyStyles) throw new Error('Could not locate the shared hero panel.');
const heroCopy = heroCopySource.replace('portfolio-hero-copy', 'hero-copy')
  .replace(/<\?php echo wp_kses_post\( __\( '([^']+)', 'mnyphoto-theme' \) \); \?>/g, (_, text) => text)
  .replace(/<\?php esc_html_e\( '([^']+)', 'mnyphoto-theme' \); \?>/g, (_, text) => esc(text));
if (heroCopy.includes('<?php')) throw new Error('Incomplete hero panel export.');
html = html.replace(/<div class="hero-copy">[\s\S]*?<\/div>/, heroCopy);
const previewHeroStyles = heroCopyStyles.replaceAll('.mny-portfolio .portfolio-hero-copy', '.hero-copy');
const adapterStyles = `
.vertical-gallery .site-header{position:absolute;inset:0 0 auto;display:block;min-height:0;padding:0;background:linear-gradient(#0006,transparent);border:0;color:white}
.screen-reader-text{position:absolute;width:1px;height:1px;margin:-1px;padding:0;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}
.preview-menu-links{display:flex;flex-wrap:wrap;gap:12px}
.preview-menu-links a{font-size:14px;font-weight:600;min-height:44px;padding:10px 16px;background:#eee;border-radius:10px}
.preview-menu-links a:hover,.preview-menu-links a:focus-visible{background:#202020;color:white}
@media(max-width:800px){.preview-menu-links{display:grid;grid-template-columns:1fr}.preview-menu-links a{font-size:15px}}
`;
html = html.replace('</head>', `<style>${headerStyles}\n${adapterStyles}\n${previewHeroStyles}</style></head>`);

// Like the theme, keep the gallery moving behind open navigation menus.
const oldMenuCondition = '!menus.some(menu => menu.open) && !viewer.open';
if (!html.includes(oldMenuCondition)) throw new Error('Could not locate the sample motion menu condition.');
html = html.replace(oldMenuCondition, '!viewer.open');
const navigation = navigationSource.replace('export function initSiteNavigation()', 'function initSiteNavigation()');
html = html.replace('</body>', `<script>${navigation}\ninitSiteNavigation();</script></body>`);

// Parse the export without executing browser code; runtime verification is separate.
for (const match of html.matchAll(/<script([^>]*)>([\s\S]*?)<\/script>/g)) {
  if (!match[1].includes('text/plain')) new Script(match[2]);
}
await writeFile(new URL('header-preview-02.html', docs), html);
await writeFile(new URL('header-preview-01.html', docs), html);
console.log('Created docs/header-preview-02.html and refreshed header-preview-01.html.');
