/* Pure loop geometry, shared by horizontal and vertical galleries. */
function mnyLoopOffset(position, distance, pixelsPerSecond, elapsedMs) {
  if (!(distance > 0)) return 0;
  return (((position + pixelsPerSecond * elapsedMs / 1000) % distance) + distance) % distance;
}
function mnyLoopCopies(viewport, distance) {
  return distance > 0 ? Math.max(2, Math.ceil(viewport / distance) + 1) : 2;
}

/* DOM behavior: one animation frame loop drives every lane in this hero. */
(() => {
  const hero = document.querySelector('[data-motion-hero]');
  const pause = document.querySelector('[data-motion-toggle]');
  const preference = window.matchMedia('(prefers-reduced-motion: reduce)');
  const menus = [...document.querySelectorAll('.nav-dropdown')];
  const viewer = document.getElementById('photo-viewer');
  const lanes = [...document.querySelectorAll('[data-loop]')].map(element => ({
    element, track: element.querySelector('.loop-track'), group: element.querySelector('.loop-group'),
    axis: element.dataset.axis, speed: Number(element.dataset.speed), offset: 0, distance: 0,
  }));
  let userPaused = false;
  let inView = true;
  let frame = null;
  let previousTime = null;

  function paint(lane) {
    const offset = preference.matches ? 0 : -lane.offset;
    lane.track.style.transform = lane.axis === 'y'
      ? `translate3d(0,${offset}px,0)` : `translate3d(${offset}px,0,0)`;
  }
  function measure() {
    lanes.forEach(lane => {
      const size = lane.group.getBoundingClientRect();
      const distance = lane.axis === 'y' ? size.height : size.width;
      if (!(distance > 0)) return;
      const fraction = lane.distance ? lane.offset / lane.distance : 0;
      lane.distance = distance;
      lane.offset = fraction * distance;
      const viewport = lane.axis === 'y' ? lane.element.clientHeight : lane.element.clientWidth;
      const copies = mnyLoopCopies(viewport, distance);
      while (lane.track.children.length < copies) {
        const duplicate = lane.group.cloneNode(true);
        duplicate.dataset.clone = 'true';
        duplicate.setAttribute('aria-hidden', 'true');
        duplicate.inert = true;
        lane.track.append(duplicate);
      }
      while (lane.track.children.length > copies) lane.track.lastElementChild.remove();
      paint(lane);
    });
  }
  function canMove() {
    return !userPaused && !preference.matches && inView && !document.hidden &&
      !menus.some(menu => menu.open) && !viewer.open;
  }
  function tick(time) {
    frame = null;
    if (!canMove()) { previousTime = null; return; }
    const elapsed = previousTime === null ? 0 : time - previousTime;
    previousTime = time;
    lanes.forEach(lane => {
      lane.offset = mnyLoopOffset(lane.offset, lane.distance, lane.speed, elapsed);
      paint(lane);
    });
    frame = requestAnimationFrame(tick);
  }
  function sync() {
    hero.dataset.reduced = String(preference.matches);
    hero.dataset.playing = String(canMove());
    pause.setAttribute('aria-label', userPaused ? 'Play moving photographs' : 'Pause moving photographs');
    pause.setAttribute('aria-pressed', String(userPaused));
    pause.querySelector('span').textContent = userPaused ? '▶' : 'Ⅱ';
    if (canMove()) {
      if (frame === null) { previousTime = null; frame = requestAnimationFrame(tick); }
    } else {
      if (frame !== null) cancelAnimationFrame(frame);
      frame = null;
      previousTime = null;
    }
  }
  if (hero && lanes.length) {
    hero.classList.add('motion-ready');
    measure();
    pause.hidden = false;
    pause.addEventListener('click', () => { userPaused = !userPaused; sync(); });
    document.addEventListener('visibilitychange', sync);
    preference.addEventListener('change', () => {
      if (!preference.matches) lanes.forEach(lane => {
        lane.element.scrollLeft = 0;
        lane.element.scrollTop = 0;
      });
      measure();
      sync();
    });
    if ('ResizeObserver' in window) {
      const resize = new ResizeObserver(measure);
      lanes.forEach(lane => { resize.observe(lane.element); resize.observe(lane.group); });
    } else window.addEventListener('resize', measure);
    if ('IntersectionObserver' in window) {
      new IntersectionObserver(entries => { inView = entries[0].isIntersecting; sync(); }, { threshold: 0 })
        .observe(hero);
    }
    sync();
  }
  menus.forEach(menu => {
    menu.addEventListener('toggle', () => {
      if (menu.open) menus.forEach(other => { if (other !== menu) other.open = false; });
      sync();
    });
    menu.addEventListener('click', event => { if (event.target.closest('a')) menu.open = false; });
  });
  document.addEventListener('click', event => menus.forEach(menu => {
    if (!menu.contains(event.target)) menu.open = false;
  }));
  document.addEventListener('keydown', event => {
    if (event.key !== 'Escape') return;
    menus.forEach(menu => { if (menu.open) { menu.open = false; menu.querySelector('summary').focus(); } });
  });

  const photos = [...document.querySelectorAll('.photo-button')];
  let active = 0;
  let lastPhoto;
  function show(index) {
    active = (index + photos.length) % photos.length;
    const source = photos[active].querySelector('img');
    const destination = viewer.querySelector('.viewer-image');
    destination.src = source.src;
    destination.alt = source.alt;
    viewer.querySelector('#viewer-title').textContent = document.getElementById(`heading-${photos[active].dataset.photo}`).textContent;
    viewer.querySelector('[data-viewer-counter]').textContent = `${active + 1} / ${photos.length}`;
  }
  if (typeof viewer?.showModal === 'function') {
    photos.forEach((button,index) => button.addEventListener('click', () => {
      lastPhoto = button;
      show(index);
      viewer.showModal();
      document.documentElement.classList.add('viewer-open');
      sync();
    }));
    viewer.querySelector('[data-close-viewer]').addEventListener('click', () => viewer.close());
    viewer.querySelector('[data-previous]').addEventListener('click', () => show(active - 1));
    viewer.querySelector('[data-next]').addEventListener('click', () => show(active + 1));
    viewer.addEventListener('keydown', event => {
      if (event.key === 'ArrowLeft') { event.preventDefault(); show(active - 1); }
      if (event.key === 'ArrowRight') { event.preventDefault(); show(active + 1); }
    });
    viewer.addEventListener('close', () => {
      document.documentElement.classList.remove('viewer-open');
      lastPhoto?.focus({ preventScroll: true });
      sync();
    });
  }
})();
