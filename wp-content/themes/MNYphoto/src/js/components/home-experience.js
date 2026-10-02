/** Continuous gallery motion and the homepage collection preview. */
export function initHomeExperience() {
  const collectionSection = document.querySelector('[data-home-services]');
  if (collectionSection) {
    const rows = [...collectionSection.querySelectorAll('[data-home-service]')];
    const photos = [...collectionSection.querySelectorAll('[data-home-preview]')];
    rows.forEach(row => {
      const select = () => {
        rows.forEach(item => item.classList.toggle('is-current', item === row));
        photos.forEach(photo => photo.classList.toggle('is-current', photo.dataset.homePreview === row.dataset.homeService));
      };
      row.addEventListener('pointerenter', select);
      row.addEventListener('focus', select);
    });
  }

  const hero = document.querySelector('.hero');
  if (!hero) return;
  const gallery = hero.querySelector('#hero-gallery');
  const track = hero.querySelector('#hero-track');
  const pauseButton = hero.querySelector('#hero-pause');
  const frames = [...track.children];
  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
  const clones = frames.map(frame => {
    const copy = frame.cloneNode(true);
    copy.dataset.clone = 'true';
    copy.setAttribute('aria-hidden', 'true');
    copy.querySelector('a').tabIndex = -1;
    copy.querySelector('img').loading = 'eager';
    copy.querySelector('img').removeAttribute('fetchpriority');
    return copy;
  });
  track.append(...clones);
  frames.forEach(frame => { frame.querySelector('img').loading = 'eager'; });

  let offset = 0;
  let cycleWidth = 0;
  let frameWidth = 0;
  let request = null;
  let lastTime = null;
  let userPaused = false;
  let inView = true;
  let drag = null;
  let dragged = false;
  const wrap = value => ((value % cycleWidth) + cycleWidth) % cycleWidth;
  const draw = () => { track.style.transform = 'translate3d(' + (-offset) + 'px,0,0)'; };
  const canMove = () => !userPaused && !reducedMotion.matches && inView && !document.hidden &&
    !drag && !track.contains(document.activeElement) &&
    document.querySelector('.site-header')?.dataset.menuOpen !== 'true' && !document.querySelector('dialog[open]');

  function tick(time) {
    request = null;
    if (!canMove() || !cycleWidth) { lastTime = null; return; }
    // Constant physical speed, with no interval, slide dwell, or wrap transition.
    if (lastTime !== null) offset = wrap(offset + (time - lastTime) * (frameWidth > 450 ? 0.022 : 0.028));
    lastTime = time;
    draw();
    request = requestAnimationFrame(tick);
  }

  function syncPlayback() {
    if (request !== null) cancelAnimationFrame(request);
    request = null;
    lastTime = null;
    const playing = canMove();
    hero.dataset.playing = String(playing);
    pauseButton.hidden = reducedMotion.matches;
    pauseButton.dataset.paused = String(userPaused);
    pauseButton.setAttribute('aria-label', userPaused ? pauseButton.dataset.playLabel : pauseButton.dataset.pauseLabel);
    if (playing) request = requestAnimationFrame(tick);
  }

  function resize() {
    const progress = cycleWidth ? offset / cycleWidth : 0;
    frameWidth = frames[0].getBoundingClientRect().width;
    cycleWidth = frameWidth * frames.length;
    offset = progress * cycleWidth;
    if (!reducedMotion.matches) draw();
    syncPlayback();
  }

  function motionPreference() {
    hero.classList.toggle('hero-static', reducedMotion.matches);
    clones.forEach(frame => { frame.hidden = reducedMotion.matches; });
    gallery.scrollLeft = 0;
    offset = 0;
    if (reducedMotion.matches) track.style.removeProperty('transform');
    else draw();
    resize();
  }

  pauseButton.addEventListener('click', () => { userPaused = !userPaused; syncPlayback(); });
  track.addEventListener('focusin', event => {
    const index = frames.indexOf(event.target.closest('.hero-frame'));
    if (index >= 0 && !reducedMotion.matches) {
      offset = index * frameWidth;
      gallery.scrollLeft = 0;
      draw();
    }
    syncPlayback();
  });
  track.addEventListener('focusout', () => { queueMicrotask(syncPlayback); });
  document.addEventListener('visibilitychange', syncPlayback);
  document.addEventListener('mnyphoto:menu', syncPlayback);
  document.addEventListener('mnyphoto:viewer', syncPlayback);
  reducedMotion.addEventListener('change', motionPreference);
  new ResizeObserver(resize).observe(gallery);
  new IntersectionObserver(entries => { inView = entries[0].isIntersecting; syncPlayback(); }).observe(hero);

  gallery.addEventListener('pointerdown', event => {
    if (event.pointerType !== 'touch' || reducedMotion.matches) return;
    drag = { x: event.clientX, offset, pointerId: event.pointerId };
    dragged = false;
    syncPlayback();
  });
  gallery.addEventListener('pointermove', event => {
    if (!drag || event.pointerId !== drag.pointerId) return;
    const distance = event.clientX - drag.x;
    if (Math.abs(distance) > 8) {
      dragged = true;
      gallery.setPointerCapture(event.pointerId);
      offset = wrap(drag.offset - distance);
      draw();
    }
  });
  const stopDrag = () => { drag = null; syncPlayback(); };
  gallery.addEventListener('pointerup', stopDrag);
  gallery.addEventListener('pointercancel', stopDrag);
  gallery.addEventListener('click', event => {
    if (dragged) { event.preventDefault(); dragged = false; }
  });
  motionPreference();
}
