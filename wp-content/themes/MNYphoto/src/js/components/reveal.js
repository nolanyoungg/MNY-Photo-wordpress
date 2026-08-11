import { prefersReducedMotion } from '../utilities/prefers-reduced-motion';

export const initReveal = () => {
  const elements = [...document.querySelectorAll('[data-reveal]')];
  if (!elements.length) return;

  if (prefersReducedMotion() || !('IntersectionObserver' in window)) {
    elements.forEach((element) => element.classList.add('is-visible'));
    return;
  }

  document.documentElement.classList.add('reveal-ready');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) return;
      entry.target.classList.add('is-visible');
      observer.unobserve(entry.target);
    });
  }, { threshold: 0.04 });

  elements.forEach((element) => observer.observe(element));
};
