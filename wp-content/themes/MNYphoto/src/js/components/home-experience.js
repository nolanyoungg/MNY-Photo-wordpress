export function initHomeExperience() {
  const reducedMotion = window.matchMedia('(prefers-reduced-motion:reduce)');
  const hero = document.querySelector('.hero');
  if (!hero) return;
  const track = document.getElementById('hero-track');
  const gallery = document.getElementById('hero-gallery');
  const pauseButton = document.getElementById('hero-pause');
  const originalFrames = [...track.children];
  const heroCategories = originalFrames.map(frame => ({id:frame.dataset.slide,name:frame.dataset.name,full:frame.dataset.name}));
  // Four bookend panels keep the full desktop strip populated through each wrap.
  const bookends = 4;
  let heroPosition = bookends;
  let heroTimer = null;
  let transitionTimer = null;
  let userPaused = false;
  let hoverPaused = false;
  let focusPaused = false;
  let heroInView = true;
  let heroMoving = false;
  const clone = frame => {
    const copy = frame.cloneNode(true);
    copy.setAttribute('aria-hidden','true');
    copy.querySelector('a').tabIndex = -1;
    copy.querySelector('img').loading = 'eager';
    copy.querySelector('img').removeAttribute('fetchpriority');
    return copy;
  };
  track.prepend(...originalFrames.slice(-bookends).map(clone));
  track.append(...originalFrames.slice(0,bookends).map(clone));
  originalFrames.forEach(frame => {frame.querySelector('img').loading = 'eager';});
  const heroFrames = [...track.querySelectorAll('.hero-frame')];
  const heroIndex = () => (heroPosition - bookends + heroCategories.length) % heroCategories.length;
  function visiblePanels() {return window.matchMedia('(max-width:560px)').matches ? 1 : window.matchMedia('(max-width:900px)').matches ? 2 : 4;}
  function updateHero(jump = false) {
    const index = heroIndex();
    const category = heroCategories[index];
    const count = visiblePanels();
    const cardWidth = gallery.getBoundingClientRect().width / count;
    if (jump) track.classList.add('no-transition');
    track.style.transform = 'translateX('+(-heroPosition * cardWidth)+'px)';
    heroFrames.forEach((frame,position) => {
      const visible = position >= heroPosition && position < heroPosition + count;
      frame.classList.toggle('is-active',position === heroPosition);
      frame.setAttribute('aria-hidden',String(!visible));
      frame.querySelector('a').tabIndex = visible ? 0 : -1;
    });
    document.getElementById('hero-word').textContent = category.heroName || category.name;
    document.getElementById('hero-count').textContent = '0'+(index + 1)+' / 06';
    document.querySelectorAll('[data-hero-category]').forEach(button => button.setAttribute('aria-pressed',String(Number(button.dataset.heroCategory) === index)));
    if (jump) requestAnimationFrame(() => requestAnimationFrame(() => track.classList.remove('no-transition')));
  }
  function finishMove() {
    clearTimeout(transitionTimer);
    if (heroPosition < bookends) {heroPosition += heroCategories.length;updateHero(true);}
    if (heroPosition >= bookends + heroCategories.length) {heroPosition -= heroCategories.length;updateHero(true);}
    heroMoving = false;
  }
  function showHero(position,manual = false) {
    if (heroMoving) finishMove();
    heroPosition = position;
    if (manual) userPaused = true;
    if (reducedMotion.matches) heroPosition = heroIndex() + bookends;
    updateHero(reducedMotion.matches);
    heroMoving = !reducedMotion.matches;
    transitionTimer = setTimeout(finishMove,1150);
    if (manual) document.getElementById('hero-announcement').textContent = 'Gallery starts with '+heroCategories[heroIndex()].full.toLowerCase()+'. Automatic movement paused.';
    syncPlayback();
  }
  function syncPlayback() {
    clearTimeout(heroTimer);
    pauseButton.disabled = reducedMotion.matches;
    const label = reducedMotion.matches ? 'Automatic gallery motion disabled by reduced-motion preference' : userPaused ? pauseButton.dataset.playLabel : pauseButton.dataset.pauseLabel;
    pauseButton.setAttribute('aria-label',label);
    pauseButton.innerHTML = '<span aria-hidden="true">'+(userPaused || reducedMotion.matches ? '▷' : 'Ⅱ')+'</span>';
    const canPlay = !userPaused && !hoverPaused && !focusPaused && heroInView && !document.hidden && !reducedMotion.matches && document.querySelector('.site-header').dataset.menuOpen !== 'true' && !document.querySelector('dialog[open]');
    hero.dataset.playing = String(canPlay);
    if (canPlay) heroTimer = setTimeout(() => showHero(heroPosition + 1),6500);
  }
  track.addEventListener('transitionend',event => {if (event.target === track && event.propertyName === 'transform') finishMove();});
  pauseButton.addEventListener('click',() => {userPaused = !userPaused;if (!userPaused) focusPaused = false;syncPlayback();});
  document.getElementById('hero-previous').addEventListener('click',() => {if (heroMoving) finishMove();showHero(heroPosition - 1,true);});
  document.getElementById('hero-next').addEventListener('click',() => {if (heroMoving) finishMove();showHero(heroPosition + 1,true);});
  document.querySelectorAll('[data-hero-category]').forEach(button => button.addEventListener('click',() => showHero(Number(button.dataset.heroCategory) + bookends,true)));
  gallery.addEventListener('pointerenter',event => {if (event.pointerType !== 'touch') {hoverPaused = true;syncPlayback();}});
  gallery.addEventListener('pointerleave',() => {hoverPaused = false;syncPlayback();});
  hero.addEventListener('focusin',() => {focusPaused = true;syncPlayback();});
  hero.addEventListener('focusout',event => {if (!hero.contains(event.relatedTarget)) {focusPaused = false;syncPlayback();}});
  document.addEventListener('visibilitychange',syncPlayback);
  document.addEventListener('mnyphoto:menu',syncPlayback);
  document.addEventListener('mnyphoto:viewer',syncPlayback);
  reducedMotion.addEventListener('change',() => {finishMove();updateHero(true);syncPlayback();});
  new ResizeObserver(() => {finishMove();updateHero(true);}).observe(gallery);
  new IntersectionObserver(entries => {heroInView = entries[0].isIntersecting;syncPlayback();},{threshold:0}).observe(hero);
  let touchStart = null;
  gallery.addEventListener('pointerdown',event => {if (event.pointerType === 'touch') touchStart = {x:event.clientX,y:event.clientY};});
  gallery.addEventListener('pointerup',event => {
    if (!touchStart) return;
    const distance = event.clientX - touchStart.x;
    const vertical = event.clientY - touchStart.y;
    touchStart = null;
    if (Math.abs(distance) > 55 && Math.abs(distance) > Math.abs(vertical)) {if (heroMoving) finishMove();showHero(heroPosition + (distance < 0 ? 1 : -1),true);}
  });
  gallery.addEventListener('pointercancel',() => {touchStart = null;});
  updateHero(true);

}
