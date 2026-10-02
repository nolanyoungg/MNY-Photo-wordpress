/** Build five standalone portfolio pages with continuously moving photo heroes. */
import { readFile, writeFile } from 'node:fs/promises';
import { renderSessionPicker } from './contact-12.mjs';
const assets=new URL('./',import.meta.url);
const docs=new URL('../../',import.meta.url);
const repository=new URL('../../../',import.meta.url);
const fonts=new URL('../portfolio-redesign/',import.meta.url);
const esc=value=>String(value).replaceAll('&','&amp;').replaceAll('"','&quot;').replaceAll('<','&lt;').replaceAll('>','&gt;');
const pad=n=>String(n).padStart(2,'0');
const live='https://mnyphoto.mystagingwebsite.com';
const services=[
  {id:'pets',name:'Pets',title:'A little wild. Entirely themselves.',description:'Unhurried pet portraits with room for the head tilts, happy sprints, and familiar expressions.',scope:'Pet portraits, outdoor sessions, and pets with their people.',alt:'A golden retriever running through a meadow of small white flowers',position:'50% 46%'},
  {id:'portraits',name:'Portraits',title:'Your next chapter, in the frame.',description:'Natural portraits for a milestone, a new beginning, or simply a moment for yourself.',scope:'College graduation, high school seniors, kids, and individual or self-portrait sessions.',alt:'An adult graduate smiling in a navy cap and gown on a leafy campus',position:'50% 30%'},
  {id:'family',name:'Family',title:'The people who make it yours.',description:'The closeness, the laughter, and the little things you’ll want to remember about this season together.',scope:'Family sessions, generational portraits, and everyday moments.',alt:'Two parents and two children walking together along a sunlit meadow path',position:'50% 25%'},
  {id:'homes',name:'Homes & real estate',title:'Make a place feel possible.',description:'A clear, thoughtful view of the space, its light, and the details that make a first impression.',scope:'Homes for sale, rentals, interiors, and exteriors.',alt:'A white two-story home with a wooden front door and a landscaped front lawn',position:'50% 50%'},
  {id:'events',name:'Events',title:'Be there. Keep the feeling.',description:'Candid photographs of the people, atmosphere, and exchanges that bring a gathering to life.',scope:'Celebrations, community gatherings, and school or business events.',alt:'Guests laughing around a garden dinner table beneath string lights',position:'50% 40%'},
  {id:'landscapes',name:'Landscapes',title:'A reason to look a little longer.',description:'Open spaces, changing skies, and the quiet details of a place worth remembering.',scope:'Natural scenery, outdoor locations, and seasonal landscapes.',alt:'A still mountain lake reflecting forest ridges and a soft sunrise',position:'50% 50%'},
];
for(const c of services){
  c.src=`data:image/webp;base64,${(await readFile(new URL(`wp-content/themes/MNYphoto/dist/images/photography/${c.id}.webp`,repository))).toString('base64')}`;
  c.small=`data:image/webp;base64,${(await readFile(new URL(`wp-content/themes/MNYphoto/dist/images/photography/${c.id}-768.webp`,repository))).toString('base64')}`;
}
const byId=id=>services.find(c=>c.id===id);
const designs=[
  {n:11,name:'Mosaic Drift',className:'mosaic-drift',description:'Large squares, tall portraits, and wide photographs travel together in one seamless horizontal mosaic.',heading:'Your world.<br>Always in motion.',lead:'People, pets, places. Photographs that bring you back.'},
  {n:12,name:'Vertical Gallery',className:'vertical-gallery',description:'Five columns of mixed-height photographs move vertically in alternating directions.',heading:'A life full<br>of good things.',lead:'Six collections. A thousand reasons to remember.'},
  {n:13,name:'Double Exposure',className:'double-exposure',description:'Two rows of square photographs glide continuously in opposite directions.',heading:'Life happens.<br>Keep a little of it.',lead:'Photography for your people, your places, and everything that matters.'},
  {n:14,name:'Moving Frames',className:'moving-frames',description:'Three staggered rows of wide, square, and narrow frames move at different speeds.',heading:'Every shape.<br>Every kind of story.',lead:'Find your kind of photography.'},
  {n:15,name:'Endless Gallery',className:'endless-gallery',description:'Tall, equal-size photo panels move edge to edge, with collection titles traveling with them.',heading:'A world worth<br>holding on to.',lead:'The MNY Photo portfolio.'},
];
function img(id,{small=false,eager=false,decorative=false}={}){
  const c=byId(id);
  return `<img src="${small?c.small:c.src}" width="${small?768:1536}" height="${small?512:1024}" alt="${decorative?'':esc(c.alt)}" loading="${eager?'eager':'lazy'}" decoding="async" style="object-position:${c.position}">`;
}
function tile(id,index,caption=false){return `<div class="motion-tile tile-${index+1}" data-subject="${id}">${img(id,{small:true,eager:true,decorative:true})}${caption?`<span>${esc(byId(id).name)}</span>`:''}</div>`;}
function lane(ids,{axis='x',speed=35,kind='row',caption=false}={}){
  return `<div class="loop-lane lane--${kind}" data-loop data-axis="${axis}" data-speed="${speed}"><div class="loop-track"><div class="loop-group">${ids.map((id,i)=>tile(id,i,caption)).join('')}</div></div></div>`;
}
function hero(design){
  let board='';
  switch(design.n){
    case 11:board=lane(['pets','portraits','landscapes','family','homes','events'],{speed:38,kind:'mosaic'});break;
    case 12:board=[['portraits','landscapes','pets'],['family','events','homes'],['pets','portraits','landscapes'],['homes','family','events'],['landscapes','pets','portraits']].map((ids,i)=>lane(ids,{axis:'y',speed:i%2?-25:29,kind:'column'})).join('');break;
    case 13:board=lane(['pets','portraits','family','homes','events','landscapes'],{speed:40,kind:'square'})+lane(['homes','landscapes','events','pets','family','portraits'],{speed:-34,kind:'square'});break;
    case 14:board=lane(['landscapes','portraits','pets','family','homes','events'],{speed:29,kind:'varied'})+lane(['homes','events','family','landscapes','portraits','pets'],{speed:-42,kind:'varied'})+lane(['portraits','pets','landscapes','events','family','homes'],{speed:35,kind:'varied'});break;
    case 15:board=lane(['pets','portraits','landscapes','homes','family','events'],{speed:35,kind:'panels',caption:true});break;
  }
  return `<!-- Future WordPress part: template-parts/page-work/content-work-hero.php -->
  <section class="hero" aria-labelledby="portfolio-title" data-motion-hero>
    <div class="motion-board" aria-hidden="true">${board}</div>
    <div class="hero-shade" aria-hidden="true"></div>
    <div class="hero-copy"><h1 id="portfolio-title">${design.heading}</h1><p>${design.lead}</p><a href="#collections">Explore the portfolio <span aria-hidden="true">↓</span></a></div>
    <button class="motion-toggle" type="button" aria-label="Pause moving photographs" aria-pressed="false" data-motion-toggle hidden><span aria-hidden="true">Ⅱ</span></button>
  </section>`;
}
const logo=`<a class="logo" href="${live}/" aria-label="MNY Photo home"><strong>MNY</strong><span>PHOTO</span></a>`;
function header(design){return `<a class="skip-link" href="#portfolio">Skip to portfolio</a><header class="site-header ${design.n===13?'site-header--light':''}">${logo}<nav class="main-nav" aria-label="Main navigation"><details class="nav-dropdown"><summary>Services <span aria-hidden="true">+</span></summary><div>${services.map(c=>`<a href="#${c.id}">${esc(c.name)}</a>`).join('')}</div></details><a href="${live}/who-we-are/">About</a><a href="#portfolio" aria-current="page">Portfolio</a><details class="nav-dropdown"><summary>Blog <span aria-hidden="true">+</span></summary><div><a href="${live}/resources/">Read the blog</a><a href="${live}/?s=photography">Find a photography article</a></div></details></nav><a href="#contact" class="header-contact">Let’s talk</a></header>`;}
function collections(design){
  return `<section class="collection-intro shell" id="collections"><div><p>The portfolio</p><h2>Find what feels like you.</h2></div><nav aria-label="Photography collections">${services.map(c=>`<a href="#${c.id}">${esc(c.name)}</a>`).join('')}</nav></section><div class="collections shell">${services.map(c=>`<!-- Future WordPress part: template-parts/page-work/content-work-${c.id}.php -->
  <section class="collection collection--${c.id}" id="${c.id}" aria-labelledby="heading-${c.id}"><figure><button class="photo-button" type="button" data-photo="${c.id}" aria-label="View complete ${esc(c.name.toLowerCase())} photograph">${img(c.id)}<span>View full photograph</span></button></figure><div class="collection-copy"><h2 id="heading-${c.id}">${esc(c.name)}</h2>${[11,12,15].includes(design.n)?`<p class="collection-title">${c.title}</p>`:''}<p class="description">${c.description}</p><p class="scope">${c.scope}</p><a href="#contact">Plan a session</a></div></section>`).join('\n')}</div>`;
}
function footer(design){
  const contact=design.n===12?renderSessionPicker({services,img,esc,live}):`<section class="contact-section" id="contact"><div class="shell contact-inner"><div><p>What would you like to remember?</p><h2>Let’s put your<br>story in the frame.</h2></div><div><p>A person, a place, an occasion, or a very good pet. Tell us what you have in mind.</p><a class="button" href="${live}/contact/">Start a conversation</a></div></div></section>`;
  return `${contact}<footer class="site-footer"><div class="shell footer-top">${logo}<nav aria-label="Footer navigation"><a href="${live}/who-we-are/">About</a><a href="#collections">Portfolio</a><a href="${live}/resources/">Blog</a><a href="${live}/contact/">Contact</a></nav><a href="#portfolio">Back to top ↑</a></div><div class="shell footer-bottom"><p>AI-generated design examples, not MNY Photo client work.</p><a href="portfolio-motion.html">Design ${design.n} / ${design.name} · View all five</a></div></footer>`;
}
const viewer=`<dialog id="photo-viewer" class="photo-viewer" aria-labelledby="viewer-title"><div class="viewer-top"><h2 id="viewer-title"></h2><button type="button" data-close-viewer aria-label="Close photograph">×</button></div><img class="viewer-image" alt=""><div class="viewer-bottom"><p>Complete photograph · AI-generated example</p><div><button type="button" data-previous aria-label="Previous photograph">←</button><span data-viewer-counter></span><button type="button" data-next aria-label="Next photograph">→</button></div></div></dialog>`;
let fontCss='';
for(const [file,weight] of [['manrope-400.ttf',400],['manrope-600.ttf',600],['manrope-800.ttf',800]])fontCss+=`@font-face{font-family:Manrope;font-weight:${weight};font-style:normal;font-display:swap;src:url(data:font/ttf;base64,${(await readFile(new URL(file,fonts))).toString('base64')}) format('truetype')}\n`;
const license=await readFile(new URL('Manrope-OFL.txt',fonts),'utf8');
const base=await readFile(new URL('base.css',assets),'utf8');
const js=await readFile(new URL('motion.js',assets),'utf8');
const contactCss=await readFile(new URL('contact-12.css',assets),'utf8');
for(const design of designs){
  let css=await readFile(new URL(`design-${design.n}.css`,assets),'utf8');
  if(design.n===12)css+=`\n${contactCss}`;
  const html=`<!doctype html>\n<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="robots" content="noindex,nofollow"><title>${design.name} — MNY Photo portfolio ${design.n}</title><style>${fontCss}\n${base}\n${css}</style></head><body class="${design.className}">${header(design)}<main id="portfolio">${hero(design)}${collections(design)}${footer(design)}</main>${viewer}<script>${js}</script><script type="text/plain" id="font-license">${license}</script></body></html>`;
  await writeFile(new URL(`portfolio-concept-${design.n}.html`,docs),html);
  console.log(`Wrote ${design.n} ${design.name}: ${(Buffer.byteLength(html)/1024/1024).toFixed(2)} MB`);
}
const indexCss=`${fontCss}${base}body{background:#f5f5f5}.index-header{display:flex;align-items:center;justify-content:space-between;padding-block:30px}.index-header .logo{color:#202020}.index-intro{padding:65px 0 45px}.index-intro h1{font-size:clamp(45px,6vw,94px);line-height:1.06;letter-spacing:-.065em;max-width:1050px;margin-bottom:25px}.index-intro p{max-width:630px;color:#626262;font-size:16px}.options{display:grid;grid-template-columns:1fr 1fr;gap:28px;padding-bottom:80px}.option{padding:25px;background:#fff}.option:first-child{grid-column:1/-1;display:grid;grid-template-columns:1.4fr 1fr;gap:40px;align-items:center}.option-preview{height:290px;display:grid;grid-template-columns:1.3fr .7fr;grid-template-rows:1fr 1fr;gap:8px;background:#202020;overflow:hidden}.option-preview img{width:100%;height:100%;object-fit:cover}.option-preview img:first-child{grid-row:1/3}.option-copy{padding-top:24px}.option-copy>span{font-size:12px;color:#707070}.option h2{font-size:31px;letter-spacing:-.045em;line-height:1.1;margin:12px 0 18px}.option-copy p{font-size:14px;color:#626262;max-width:440px;margin-bottom:24px}.option:first-child .option-copy{padding:0}.index-footer{font-size:12px;color:#626262;padding:35px 0 60px;border-top:1px solid #ccc}@media(max-width:700px){.index-intro{padding-top:35px}.options{grid-template-columns:1fr}.option:first-child{display:block;grid-column:auto}.option:first-child .option-copy{padding-top:24px}.option-preview{height:250px}.index-header{font-size:10px}}`;
const index=`<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="robots" content="noindex,nofollow"><title>MNY Photo — five moving portfolio heroes</title><style>${indexCss}</style></head><body><header class="shell index-header">${logo}<span>Five complete portfolio pages</span></header><main class="shell"><section class="index-intro"><h1>Photographs that<br>keep moving.</h1><p>Five new portfolio directions, all with automatically looping photo heroes. Open a full page to see the motion. Each includes all six services and works as a single standalone HTML file.</p></section><section class="options" aria-label="Five portfolio concepts">${designs.map((d,i)=>`<article class="option"><a class="option-preview" href="portfolio-concept-${d.n}.html" aria-label="Open ${d.name}">${img(['pets','portraits','landscapes','family','homes'][i],{small:true,eager:true})}${img('events',{small:true})}${img('landscapes',{small:true})}</a><div class="option-copy"><span>Design ${d.n}</span><h2>${d.name}</h2><p>${d.description}</p><a class="button" href="portfolio-concept-${d.n}.html">Open the moving portfolio</a></div></article>`).join('')}</section></main><footer class="shell index-footer"><p>AI-generated concept photos. A small pause control is available on each hero; reduced-motion preferences display a still gallery. Browser visual verification is pending because local-file access was blocked by browser policy.</p></footer><script type="text/plain" id="font-license">${license}</script></body></html>`;
await writeFile(new URL('portfolio-motion.html',docs),index);
console.log('Wrote the five-design comparison index.');
