import { prefersReducedMotion } from '../utilities/prefers-reduced-motion';

const currentDirectoryTarget = () => {
  const identifier = decodeURIComponent(window.location.hash.slice(1));
  if (!identifier) return null;

  const target = document.getElementById(identifier);
  return target?.closest('.service-directory') ? target : null;
};

const scrollToDirectoryTarget = (behavior = 'auto') => {
  const target = currentDirectoryTarget();
  if (!target) return;

  target.scrollIntoView({
    behavior: prefersReducedMotion() ? 'auto' : behavior,
    block: 'start',
  });
};

const scheduleDirectoryScroll = (behavior) => {
  window.requestAnimationFrame(() => {
    window.requestAnimationFrame(() => scrollToDirectoryTarget(behavior));
  });
};

export const initServiceDirectory = () => {
  if (!document.querySelector('.service-directory')) return;

  scheduleDirectoryScroll('auto');
  window.addEventListener('hashchange', () => scheduleDirectoryScroll('smooth'));
};
