/** Independent vertical loops for the approved Portfolio page. */
export function initPortfolio() {
  const root = document.querySelector('.mny-portfolio');
  const hero = root?.querySelector('[data-portfolio-hero]');
  if (!hero) return;
  const pause = hero.querySelector('[data-portfolio-pause]');
  const preference = window.matchMedia('(prefers-reduced-motion: reduce)');
  const lanes = [...hero.querySelectorAll('[data-portfolio-lane]')].map(element => ({
    element, track: element.querySelector('.portfolio-track'), group: element.querySelector('.portfolio-group'),
    speed: Number(element.dataset.speed), offset: 0, distance: 0,
  }));
  let userPaused = false;
  let inView = true;
  let frame = null;
  let previousTime = null;
  const paint = lane => { lane.track.style.transform = `translate3d(0,${preference.matches ? 0 : -lane.offset}px,0)`; };
  function measure() {
    lanes.forEach(lane => {
      const distance = lane.group.getBoundingClientRect().height;
      if (!(distance > 0)) return;
      const fraction = lane.distance ? lane.offset / lane.distance : 0;
      lane.distance = distance;
      lane.offset = fraction * distance;
      const copies = Math.max(2, Math.ceil(lane.element.clientHeight / distance) + 1);
      while (lane.track.children.length < copies) {
        const duplicate = lane.group.cloneNode(true);
        duplicate.dataset.clone = 'true';
        duplicate.setAttribute('aria-hidden', 'true');
        duplicate.inert = true;
        duplicate.querySelectorAll('img').forEach(image => image.removeAttribute('fetchpriority'));
        lane.track.append(duplicate);
      }
      while (lane.track.children.length > copies) lane.track.lastElementChild.remove();
      paint(lane);
    });
  }
  const canMove = () => !userPaused && !preference.matches && inView && !document.hidden &&
    (!hero.contains(document.activeElement) || document.activeElement === pause) &&
    document.querySelector('.site-header')?.dataset.menuOpen !== 'true' && !document.querySelector('dialog[open]');
  function tick(time) {
    frame = null;
    if (!canMove()) { previousTime = null; return; }
    const elapsed = previousTime === null ? 0 : time - previousTime;
    previousTime = time;
    lanes.forEach(lane => {
      if (!lane.distance) return;
      lane.offset = ((lane.offset + lane.speed * elapsed / 1000) % lane.distance + lane.distance) % lane.distance;
      paint(lane);
    });
    frame = requestAnimationFrame(tick);
  }
  function sync() {
    hero.dataset.reduced = String(preference.matches);
    hero.dataset.playing = String(canMove());
    pause.hidden = preference.matches;
    pause.setAttribute('aria-label', userPaused ? pause.dataset.playLabel : pause.dataset.pauseLabel);
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
  hero.classList.add('portfolio-motion-ready');
  measure();
  pause.addEventListener('click', () => { userPaused = !userPaused; sync(); });
  hero.addEventListener('focusin', sync);
  hero.addEventListener('focusout', () => queueMicrotask(sync));
  ['visibilitychange', 'mnyphoto:menu', 'mnyphoto:viewer'].forEach(event => document.addEventListener(event, sync));
  preference.addEventListener('change', () => {
    if (!preference.matches) lanes.forEach(lane => { lane.element.scrollTop = 0; });
    measure();
    sync();
  });
  const resize = new ResizeObserver(measure);
  lanes.forEach(lane => { resize.observe(lane.element); resize.observe(lane.group); });
  new IntersectionObserver(entries => { inView = entries[0].isIntersecting; sync(); }).observe(hero);
  sync();

  root.querySelectorAll('[data-portfolio-plan]').forEach(link => link.addEventListener('click', () => {
    const radio = document.getElementById(`session-${link.dataset.portfolioPlan}`);
    if (radio) radio.checked = true;
  }));
  // Existing shared links use ?collection=; keep those destinations useful.
  const collection = new URL(location.href).searchParams.get('collection');
  const target = collection && [...root.querySelectorAll('.portfolio-collection')].find(section => section.id === collection);
  if (target && !location.hash) {
    const reveal = () => target.scrollIntoView({ block: 'start', behavior: 'instant' });
    if (document.readyState === 'complete') reveal();
    else window.addEventListener('load', reveal, { once: true });
  }
}
