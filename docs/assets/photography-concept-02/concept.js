(() => {
  'use strict';

  const asset = 'assets/photography-concept-02/';
  const categories = [
    {id:'pets',name:'Pets',full:'Pet photography',word:'unleashed.',title:'Big personality.<br>Four little paws.',story:'A very good day',description:'The curious looks, the goofy grin, the one-of-a-kind personality. Photographs of your favorite animal, just as they are.',short:'Big personalities. Very good company.',capabilities:['Pet portraits','Outdoor pet sessions','Pets with their people'],alt:'A golden retriever running through a meadow of small white wildflowers'},
    {id:'portraits',name:'Portraits',full:'Portrait photography',word:'celebrated.',title:'Your next chapter.<br>Your kind of portrait.',story:'Here’s to what comes next',description:'A new chapter or simply a moment for yourself. Natural portraits with room for your personality and a little guidance along the way.',short:'Graduates, seniors, kids & individual portraits.',capabilities:['College graduation','High school seniors','Kids’ portraits','Individual & self-portrait sessions'],alt:'An adult college graduate smiling in a navy cap and gown on a leafy university campus'},
    {id:'family',name:'Family',full:'Family photography',word:'together.',title:'Your people.<br>Your kind of perfect.',story:'All of us, right here',description:'The way you laugh together. The familiar hands to hold. A thoughtful record of your family, in this chapter of your lives.',short:'Your favorite people, all in one frame.',capabilities:['Family sessions','Generational portraits','Everyday family moments'],alt:'Two parents and their two children walking together along a sunlit meadow path'},
    {id:'homes',name:'Homes & real estate',heroName:'Homes',full:'Homes & real estate photography',word:'welcoming.',title:'A sense of place.<br>A place to call home.',story:'A welcome worth remembering',description:'A clear, considered view of a property. Photographs that help buyers, renters, and homeowners see the space, the light, and the details.',short:'Homes, listings, interiors & exteriors.',capabilities:['Homes for sale','Rental properties','Interior photography','Exterior photography'],alt:'A white two-story house with dark windows, a wooden front door, a porch, and a landscaped front lawn'},
    {id:'events',name:'Events',full:'Event photography',word:'happening.',title:'Good company.<br>Great memories.',story:'An evening to remember',description:'The energy in the room and the small moments around it. Candid photographs of the people and details that make your event yours.',short:'Gatherings, celebrations & shared moments.',capabilities:['Community gatherings','Celebrations','School & business events'],alt:'Guests laughing together around a garden dinner table beneath warm string lights'},
    {id:'landscapes',name:'Landscapes',full:'Landscape photography',word:'wide open.',title:'A little perspective.<br>A lot of possibility.',story:'Before the world wakes up',description:'The quiet, the scale, the light. Photographs of outdoor places that make you stop for a moment and look a little longer.',short:'Open spaces. New perspectives.',capabilities:['Natural scenery','Outdoor locations','Seasonal landscapes'],alt:'A still mountain lake reflecting misty forest ridges and a soft sunrise'}
  ];
  const posts = [
    {id:'pets',category:'pets',tag:'PETS / SESSION NOTES',title:'A little patience. A lot of personality.',excerpt:'Room for the zoomies, the curious looks, and the very good dog in front of the camera.',lead:'The best pet photographs don’t ask your animal to become someone else. They leave room for the personality you already know and love.',heading:'Start with something familiar.',body:'A favorite place, a little space to explore, and time to settle in are useful starting points. The in-between moments can be just as memorable as the ones we planned.',quote:'Their personality is the point.',ending:'Tell us about your pet: what they enjoy, what helps them feel comfortable, and the little habits you would love to remember. We can build the session around them.'},
    {id:'portraits',category:'portraits',tag:'PORTRAITS / GRADUATION',title:'Here’s to your next chapter.',excerpt:'A few simple ways to make graduation and senior portraits feel like you.',lead:'Graduation photographs can celebrate the achievement and the person behind it. You bring the story; the setting and the light help tell it.',heading:'Make it personal.',body:'A place that matters, clothes you feel good in, and a few details from this chapter can give the photographs their own sense of belonging. Your cap and gown can be part of the session, alongside a look that feels more everyday.',quote:'You’ve come a long way.<br>Let’s give that a moment.',ending:'Whether it’s college graduation, your high school senior year, or an individual portrait just for yourself, there is room for a little direction and plenty of personality.'},
    {id:'homes',category:'homes',tag:'HOMES / BEFORE THE SHOOT',title:'Let your home’s good side show.',excerpt:'Preparing a space so its light, layout, and character can do the talking.',lead:'Good property photographs help someone understand a space. A clear view of the rooms and their details is a great place to begin.',heading:'Give the space some breathing room.',body:'Tidy everyday clutter, straighten soft furnishings, and make sure the rooms and exterior are accessible. The aim is a welcoming, accurate picture of the home, with attention to its natural light and character.',quote:'A thoughtful photograph starts<br>with a little preparation.',ending:'Before photographing a home, we can talk through the rooms, exterior views, and features you would like to show. Your listing or personal project gives the session its focus.'}
  ];
  const byId = id => categories.find(category => category.id === id);
  const image = (category, loading = 'lazy') => `<img src="${asset + category.id}.png" alt="${category.alt}" loading="${loading}">`;
  const capabilityLinks = category => category.capabilities.map((item,index) => `<li><a href="#services-${category.id}--${index}">${item}</a></li>`).join('');

  document.getElementById('service-options').innerHTML = categories.map((category,index) => `<div class="service-option${index === 0 ? ' active' : ''}" data-service="${category.id}"><a href="#services-${category.id}"><span class="number">0${index + 1}</span>${category.name}<span class="arrow" aria-hidden="true">↗</span></a><div class="service-mobile-detail"><p>${category.description}</p><ul>${capabilityLinks(category)}</ul></div></div>`).join('');
  function previewService(id) {
    const category = byId(id);
    document.querySelectorAll('[data-service]').forEach(option => option.classList.toggle('active',option.dataset.service === id));
    document.getElementById('service-stage').innerHTML = `<div class="stage-photo">${image(category,'eager')}</div><div class="stage-copy"><span class="eyebrow">IN THE FRAME</span><h3>${category.name}</h3><p>${category.description}</p><ul>${capabilityLinks(category)}</ul><a class="inline-link" href="#services-${id}">Explore ↗</a></div>`;
  }
  document.querySelectorAll('[data-service]>a').forEach(link => {
    const update = () => previewService(link.parentElement.dataset.service);
    link.addEventListener('pointerenter',update);
    link.addEventListener('focus',update);
  });
  previewService('pets');
  document.getElementById('home-services').innerHTML = categories.map((category,index) => `<a class="service-card" href="#services-${category.id}"><div class="service-image">${image(category)}</div><span class="card-number">0${index + 1}</span><div class="service-card-heading"><h3>${category.name}</h3><span aria-hidden="true">↗</span></div><p>${category.short}</p></a>`).join('');
  document.getElementById('service-directory').innerHTML = categories.map((category,index) => `<article class="service-detail" id="service-${category.id}" tabindex="-1"><div class="detail-photo">${image(category)}</div><div class="detail-copy"><p class="eyebrow">0${index + 1} / ${category.full.toUpperCase()}</p><h2>${category.title}</h2><p>${category.description}</p><ul class="capabilities">${category.capabilities.map((item,capIndex) => `<li id="cap-${category.id}-${capIndex}" tabindex="-1">${item}</li>`).join('')}</ul><a class="inline-link" href="#contact-${category.id}">Let’s talk ${category.id === 'homes' ? 'about your property' : 'about your session'} ↗</a></div></article>`).join('');
  document.getElementById('inquiry-category').insertAdjacentHTML('beforeend',categories.map(category => `<option value="${category.id}">${category.name}</option>`).join(''));
  document.getElementById('footer-categories').insertAdjacentHTML('beforeend',categories.map(category => `<a href="#services-${category.id}">${category.name}</a>`).join(''));

  function photoCard(category) {
    return `<article class="photo-card" data-category="${category.id}"><button type="button" data-photo="${category.id}" aria-label="Open ${category.story}"><div class="photo-image">${image(category)}</div><div class="photo-meta"><h3>${category.story}</h3><p>${category.name} ↗</p></div></button></article>`;
  }
  document.getElementById('featured-grid').innerHTML = [categories[1],categories[5]].map(photoCard).join('');
  document.getElementById('portfolio-grid').innerHTML = categories.map(photoCard).join('');
  document.getElementById('portfolio-filters').innerHTML = `<button type="button" data-filter="all" aria-pressed="true">All photographs</button>` + categories.map(category => `<button type="button" data-filter="${category.id}" aria-pressed="false">${category.name}</button>`).join('');
  let activeFilter = 'all';
  function filterPortfolio(id) {
    activeFilter = byId(id) ? id : 'all';
    document.querySelectorAll('[data-filter]').forEach(button => button.setAttribute('aria-pressed',String(button.dataset.filter === activeFilter)));
    document.querySelectorAll('#portfolio-grid .photo-card').forEach(card => {card.hidden = activeFilter !== 'all' && card.dataset.category !== activeFilter;});
    document.getElementById('portfolio-status').textContent = activeFilter === 'all' ? 'Showing all 6 concept photographs.' : `Showing 1 ${byId(activeFilter).name.toLowerCase()} concept photograph.`;
  }
  document.querySelectorAll('[data-filter]').forEach(button => button.addEventListener('click',() => filterPortfolio(button.dataset.filter)));
  filterPortfolio('all');

  function postCard(post) {
    return `<a href="#article-${post.id}" class="post-card"><div class="post-image">${image(byId(post.category))}</div><div class="post-copy"><span class="tag">${post.tag}</span><h3>${post.title}</h3><p class="post-excerpt">${post.excerpt}</p><span class="inline-link">Read story ↗</span></div></a>`;
  }
  document.querySelectorAll('[data-posts]').forEach(grid => {grid.innerHTML = posts.map(postCard).join('');});
  document.getElementById('search-results').innerHTML = posts.map(postCard).join('');
  document.getElementById('search-form').addEventListener('submit',event => {
    event.preventDefault();
    const query = document.getElementById('search-input').value.trim().toLowerCase();
    const matches = posts.filter(post => `${post.title} ${post.tag} ${post.excerpt}`.toLowerCase().includes(query));
    document.getElementById('search-results').innerHTML = matches.map(postCard).join('');
    document.getElementById('search-status').textContent = matches.length ? `${matches.length} sample ${matches.length === 1 ? 'story' : 'stories'} found.` : 'No matching stories. Try pets, graduation, or home.';
  });
  function renderArticle(post) {
    document.getElementById('article').innerHTML = `<div class="shell page-heading article-heading"><a class="inline-link" href="#blog" style="margin-bottom:30px">← Back to the blog</a><p class="eyebrow">${post.tag}</p><h1>${post.title}</h1><p>${post.excerpt}</p></div><div class="shell article-hero-photo">${image(byId(post.category),'eager')}</div><article class="article-body"><p class="article-lead">${post.lead}</p><h2>${post.heading}</h2><p>${post.body}</p><blockquote>${post.quote}</blockquote><p>${post.ending}</p><p class="small-note">Illustrative article with an AI-generated example photograph. Existing published posts will remain WordPress-managed.</p><a class="inline-link" href="#contact-${post.category}">Plan your photographs ↗</a></article>`;
  }

  const header = document.querySelector('.site-header');
  const nav = document.getElementById('main-nav');
  const mobileToggle = document.querySelector('.mobile-toggle');
  const mobileMedia = window.matchMedia('(max-width:800px)');
  let pinnedMenu = null;
  let currentMenu = null;
  function displayMenu(key) {
    currentMenu = key;
    document.querySelectorAll('[data-menu]').forEach(button => {
      const open = button.dataset.menu === key;
      button.setAttribute('aria-expanded',String(open));
      document.getElementById(button.getAttribute('aria-controls')).hidden = !open;
    });
    syncPlayback();
  }
  function closeMenus() {pinnedMenu = null;displayMenu(null);}
  function closeMobile() {nav.classList.remove('open');mobileToggle.setAttribute('aria-expanded','false');mobileToggle.setAttribute('aria-label','Open main menu');}
  document.querySelectorAll('[data-menu]').forEach(button => button.addEventListener('click',() => {
    const key = button.dataset.menu;
    if (pinnedMenu === key && currentMenu === key) closeMenus();
    else {pinnedMenu = key;displayMenu(key);}
  }));
  document.querySelectorAll('[data-nav-group]').forEach(group => {
    group.addEventListener('pointerenter',event => {if (!mobileMedia.matches && event.pointerType !== 'touch' && !pinnedMenu) displayMenu(group.dataset.navGroup);});
    group.addEventListener('pointerleave',() => {if (!mobileMedia.matches && !pinnedMenu && !group.contains(document.activeElement)) displayMenu(null);});
    group.addEventListener('focusout',event => {if (!pinnedMenu && !group.contains(event.relatedTarget)) displayMenu(null);});
  });
  mobileToggle.addEventListener('click',() => {
    const open = !nav.classList.contains('open');
    nav.classList.toggle('open',open);
    mobileToggle.setAttribute('aria-expanded',String(open));
    mobileToggle.setAttribute('aria-label',open ? 'Close main menu' : 'Open main menu');
    closeMenus();
  });
  document.addEventListener('click',event => {if (!header.contains(event.target)) {closeMenus();closeMobile();}});
  document.addEventListener('keydown',event => {
    if (event.key !== 'Escape') return;
    if (currentMenu) {const trigger = document.querySelector(`[data-menu="${currentMenu}"]`);closeMenus();trigger.focus();}
    else if (nav.classList.contains('open')) {closeMobile();mobileToggle.focus();}
  });
  mobileMedia.addEventListener('change',() => {closeMenus();closeMobile();});

  const reducedMotion = window.matchMedia('(prefers-reduced-motion:reduce)');
  const hero = document.querySelector('.hero');
  const track = document.getElementById('hero-track');
  const gallery = document.getElementById('hero-gallery');
  const pauseButton = document.getElementById('hero-pause');
  let heroPosition = 1;
  let heroTimer = null;
  let transitionTimer = null;
  let userPaused = false;
  let hoverPaused = false;
  let focusPaused = false;
  let heroInView = true;
  let heroMoving = false;
  let currentView = 'home';
  function slideMarkup(category,index,clone = false) {
    return `<figure class="hero-frame" data-slide="${category.id}" ${clone ? 'data-clone="true"' : ''} aria-hidden="true" role="group" aria-roledescription="slide" aria-label="${index + 1} of 6: ${category.full}">${image(category,index < 2 ? 'eager' : 'lazy')}<figcaption><span class="photo-index">0${index + 1} / 06</span><div><span class="eyebrow">${category.full.toUpperCase()}</span><h2>${category.title}</h2></div><a href="#portfolio-${category.id}" class="image-link" tabindex="-1" aria-label="Explore ${category.full.toLowerCase()}">↗</a></figcaption></figure>`;
  }
  track.innerHTML = slideMarkup(categories[5],5,true) + categories.map((category,index) => slideMarkup(category,index)).join('') + slideMarkup(categories[0],0,true);
  track.querySelectorAll('img').forEach(img => {img.loading = 'eager';});
  const heroFrames = [...track.querySelectorAll('.hero-frame')];
  document.getElementById('hero-categories').innerHTML = categories.map((category,index) => `<button type="button" data-hero-category="${index}" aria-pressed="${index === 0}"><span class="slide-num">0${index + 1}</span>${category.heroName || category.name}</button>`).join('');
  function updateHero(jump = false) {
    const index = (heroPosition - 1 + categories.length) % categories.length;
    const category = categories[index];
    const width = heroFrames[0].getBoundingClientRect().width / (heroFrames[0].classList.contains('is-active') ? 1 : .96);
    // offsetWidth is unaffected by each frame's visual scale.
    const cardWidth = heroFrames[0].offsetWidth || width;
    const gap = parseFloat(getComputedStyle(track).gap);
    if (jump) track.classList.add('no-transition');
    track.style.transform = `translateX(${(gallery.clientWidth - cardWidth) / 2 - heroPosition * (cardWidth + gap)}px)`;
    heroFrames.forEach((frame,position) => {
      const active = position === heroPosition;
      frame.classList.toggle('is-active',active);
      frame.setAttribute('aria-hidden',String(!active));
      frame.querySelector('a').tabIndex = active ? 0 : -1;
    });
    const word = document.getElementById('hero-word');
    if (word.textContent !== category.word) {
      word.textContent = category.word;
      if (!reducedMotion.matches) word.animate([{opacity:0,transform:'translateY(9px)'},{opacity:1,transform:'translateY(0)'}],{duration:550,easing:'ease-out'});
    }
    document.querySelectorAll('[data-hero-category]').forEach(button => button.setAttribute('aria-pressed',String(Number(button.dataset.heroCategory) === index)));
    if (jump) requestAnimationFrame(() => requestAnimationFrame(() => track.classList.remove('no-transition')));
  }
  function finishMove() {
    clearTimeout(transitionTimer);
    if (heroPosition === 0) {heroPosition = categories.length;updateHero(true);}
    if (heroPosition === categories.length + 1) {heroPosition = 1;updateHero(true);}
    heroMoving = false;
  }
  function showHero(position,manual = false) {
    if (heroMoving) finishMove();
    heroPosition = position;
    if (manual) userPaused = true;
    if (reducedMotion.matches) heroPosition = ((position - 1 + categories.length) % categories.length) + 1;
    updateHero(reducedMotion.matches);
    heroMoving = !reducedMotion.matches;
    transitionTimer = setTimeout(finishMove,900);
    if (manual) document.getElementById('hero-announcement').textContent = `Showing ${categories[(heroPosition - 1 + categories.length) % categories.length].full}. Automatic movement paused.`;
    syncPlayback();
  }
  function syncPlayback() {
    clearTimeout(heroTimer);
    pauseButton.disabled = reducedMotion.matches;
    const label = reducedMotion.matches ? 'Automatic gallery motion disabled by reduced-motion preference' : userPaused ? 'Play moving gallery' : 'Pause moving gallery';
    pauseButton.setAttribute('aria-label',label);
    pauseButton.innerHTML = `<span aria-hidden="true">${userPaused || reducedMotion.matches ? '▷' : 'Ⅱ'}</span>`;
    const canPlay = currentView === 'home' && !userPaused && !hoverPaused && !focusPaused && heroInView && !document.hidden && !reducedMotion.matches && !currentMenu && !document.querySelector('dialog[open]');
    hero.dataset.playing = String(canPlay);
    if (canPlay) heroTimer = setTimeout(() => showHero(heroPosition + 1),6500);
  }
  track.addEventListener('transitionend',event => {if (event.target === track && event.propertyName === 'transform') finishMove();});
  pauseButton.addEventListener('click',() => {userPaused = !userPaused;if (!userPaused) focusPaused = false;syncPlayback();});
  document.getElementById('hero-previous').addEventListener('click',() => {if (heroMoving) finishMove();showHero(heroPosition - 1,true);});
  document.getElementById('hero-next').addEventListener('click',() => {if (heroMoving) finishMove();showHero(heroPosition + 1,true);});
  document.querySelectorAll('[data-hero-category]').forEach(button => button.addEventListener('click',() => showHero(Number(button.dataset.heroCategory) + 1,true)));
  gallery.addEventListener('pointerenter',event => {if (event.pointerType !== 'touch') {hoverPaused = true;syncPlayback();}});
  gallery.addEventListener('pointerleave',() => {hoverPaused = false;syncPlayback();});
  hero.addEventListener('focusin',() => {focusPaused = true;syncPlayback();});
  hero.addEventListener('focusout',event => {if (!hero.contains(event.relatedTarget)) {focusPaused = false;syncPlayback();}});
  document.addEventListener('visibilitychange',syncPlayback);
  reducedMotion.addEventListener('change',() => {finishMove();updateHero(true);syncPlayback();});
  new ResizeObserver(() => updateHero(true)).observe(gallery);
  new IntersectionObserver(entries => {heroInView = entries[0].isIntersecting;syncPlayback();},{threshold:0}).observe(hero);
  let touchStart = null;
  gallery.addEventListener('pointerdown',event => {if (event.pointerType === 'touch') touchStart = event.clientX;});
  gallery.addEventListener('pointerup',event => {if (touchStart === null) return;const distance = event.clientX - touchStart;touchStart = null;if (Math.abs(distance) > 55) {if (heroMoving) finishMove();showHero(heroPosition + (distance < 0 ? 1 : -1),true);}});
  gallery.addEventListener('pointercancel',() => {touchStart = null;});
  updateHero(true);

  const viewer = document.getElementById('photo-viewer');
  const notes = document.getElementById('review-dialog');
  let viewerPhotos = categories;
  let viewerIndex = 0;
  function showPhoto(index) {
    viewerIndex = (index + viewerPhotos.length) % viewerPhotos.length;
    const category = viewerPhotos[viewerIndex];
    const photo = document.getElementById('viewer-image');
    photo.src = `${asset + category.id}.png`;photo.alt = category.alt;
    document.getElementById('viewer-title').textContent = category.story;
    document.getElementById('viewer-caption').textContent = `${category.name} · ${viewerIndex + 1} / ${viewerPhotos.length} · AI-generated design example`;
  }
  document.querySelectorAll('[data-photo]').forEach(button => button.addEventListener('click',() => {
    viewerPhotos = button.closest('#portfolio-grid') && activeFilter !== 'all' ? [byId(activeFilter)] : categories;
    showPhoto(viewerPhotos.findIndex(category => category.id === button.dataset.photo));
    viewer.showModal();syncPlayback();
  }));
  document.getElementById('viewer-previous').addEventListener('click',() => showPhoto(viewerIndex - 1));
  document.getElementById('viewer-next').addEventListener('click',() => showPhoto(viewerIndex + 1));
  viewer.addEventListener('keydown',event => {if (event.key === 'ArrowLeft') {event.preventDefault();showPhoto(viewerIndex - 1);}if (event.key === 'ArrowRight') {event.preventDefault();showPhoto(viewerIndex + 1);}});
  document.querySelectorAll('[data-open-notes]').forEach(button => button.addEventListener('click',() => {notes.showModal();syncPlayback();}));
  document.querySelectorAll('[data-close]').forEach(button => button.addEventListener('click',() => document.getElementById(button.dataset.close).close()));
  document.querySelectorAll('[data-dismiss-notes]').forEach(link => link.addEventListener('click',() => notes.close()));
  document.querySelectorAll('dialog').forEach(dialog => {
    dialog.addEventListener('close',syncPlayback);
    dialog.addEventListener('click',event => {if (event.target !== dialog) return;const rect = dialog.getBoundingClientRect();if (event.clientX < rect.left || event.clientX > rect.right || event.clientY < rect.top || event.clientY > rect.bottom) dialog.close();});
  });

  function route(initial = false) {
    const requested = location.hash.slice(1) || 'home';
    const [base,capability] = requested.split('--');
    const article = posts.find(post => `article-${post.id}` === requested);
    const service = categories.find(category => base === `services-${category.id}`);
    const collection = categories.find(category => requested === `portfolio-${category.id}`);
    const contact = categories.find(category => requested === `contact-${category.id}`);
    let view = article ? 'article' : service ? 'services' : collection ? 'portfolio' : contact ? 'contact' : requested;
    if (!document.querySelector(`.page-view#${CSS.escape(view)}`)) view = 'not-found';
    if (article) renderArticle(article);
    if (collection) filterPortfolio(collection.id);
    else if (view === 'portfolio') filterPortfolio('all');
    if (contact) document.getElementById('inquiry-category').value = contact.id;
    currentView = view;
    document.querySelectorAll('.page-view').forEach(page => {page.hidden = page.id !== view;});
    document.querySelectorAll('.main-nav a[href]').forEach(link => {
      const active = link.hash === `#${view}` || (view === 'article' && link.hash === '#blog');
      if (active) link.setAttribute('aria-current','page');else link.removeAttribute('aria-current');
    });
    document.getElementById('closing-cta').hidden = view === 'contact';
    document.title = `MNY Photo — ${article ? article.title : view === 'home' ? 'Life in every frame' : view.charAt(0).toUpperCase() + view.slice(1)} · Concept 02`;
    closeMenus();closeMobile();syncPlayback();
    if (view === 'home') requestAnimationFrame(() => updateHero(true));
    if (!initial) {document.getElementById('main').focus({preventScroll:true});window.scrollTo({top:0,behavior:'instant'});}
    if (service) requestAnimationFrame(() => {
      const target = document.getElementById(capability === undefined ? `service-${service.id}` : `cap-${service.id}-${capability}`) || document.getElementById(`service-${service.id}`);
      target.focus({preventScroll:true});target.scrollIntoView({block:capability === undefined ? 'start' : 'center',behavior:initial || reducedMotion.matches ? 'instant' : 'smooth'});
    });
  }
  window.addEventListener('hashchange',() => route());
  document.querySelector('.skip-link').addEventListener('click',event => {event.preventDefault();const main = document.getElementById('main');main.focus();main.scrollIntoView();});
  document.getElementById('inquiry-form').addEventListener('submit',event => {event.preventDefault();document.getElementById('inquiry-result').hidden = false;});
  route(true);
})();
