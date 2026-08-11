import { prefersReducedMotion } from '../utilities/prefers-reduced-motion';

const initSculptureDepth = (root) => {
  const sculpture = root.querySelector('[data-home-sculpture]');
  if (!sculpture || prefersReducedMotion()) return;

  sculpture.addEventListener('pointermove', (event) => {
    if (event.pointerType === 'touch' || window.innerWidth <= 900) return;
    const bounds = sculpture.getBoundingClientRect();
    const x = ((event.clientX - bounds.left) / bounds.width) - 0.5;
    const y = ((event.clientY - bounds.top) / bounds.height) - 0.5;
    sculpture.style.setProperty('--sculpture-x', `${(x * 10).toFixed(2)}px`);
    sculpture.style.setProperty('--sculpture-y', `${(y * 10).toFixed(2)}px`);
  });

  sculpture.addEventListener('pointerleave', () => {
    sculpture.style.setProperty('--sculpture-x', '0px');
    sculpture.style.setProperty('--sculpture-y', '0px');
  });
};

const initRoadmapProgress = (root) => {
  const steps = [...root.querySelectorAll('[data-home-process-step]')];
  if (!steps.length || prefersReducedMotion() || !('IntersectionObserver' in window)) return;

  const observer = new IntersectionObserver((entries) => {
    const current = entries.find((entry) => entry.isIntersecting);
    if (!current) return;
    steps.forEach((step) => step.classList.toggle('is-current', step === current.target));
  }, { rootMargin: '-34% 0px -46%', threshold: 0.05 });

  steps.forEach((step) => observer.observe(step));
};

export const initHomeExperience = () => {
  const root = document.querySelector('[data-home-editorial]');
  if (!root) return;
  initSculptureDepth(root);
  initRoadmapProgress(document);
};
