/** S061 photo strip: native scrolling until motion can be enhanced. */
export function initAboutPhotos() {
  const root = document.querySelector('.mny-about-061 .part-photos');
  if (!root) return;

  const section = root.querySelector('.photo-section');
  const toggle = root.querySelector('.pause');
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)');
  let paused = false;
  let visible = false;

  const sync = () => {
    root.classList.toggle('paused', paused || reduced.matches);
    root.classList.toggle('in-view', visible && !document.hidden);
    toggle.textContent = paused ? toggle.dataset.playLabel : toggle.dataset.pauseLabel;
    toggle.setAttribute('aria-pressed', String(paused));
  };

  toggle.addEventListener('click', () => {
    paused = !paused;
    sync();
  });
  if ('IntersectionObserver' in window) {
    new IntersectionObserver((entries) => {
      visible = entries[0].isIntersecting;
      sync();
    }, { rootMargin: '100px' }).observe(section);
  } else {
    visible = true;
  }
  reduced.addEventListener('change', sync);
  document.addEventListener('visibilitychange', sync);
  sync();
  root.classList.add('enhanced');
}
