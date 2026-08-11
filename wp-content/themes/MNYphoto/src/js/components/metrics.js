import { prefersReducedMotion } from '../utilities/prefers-reduced-motion';

export const initMetrics = () => {
  const metrics = [...document.querySelectorAll('[data-metric]')];
  if (!metrics.length) return;

  const animate = (element) => {
    const target = Number(element.dataset.metric || 0);
    const prefix = element.dataset.prefix || '';
    const suffix = element.dataset.suffix || '';
    const duration = 900;
    const start = performance.now();
    const decimals = String(target).includes('.') ? 1 : 0;

    if (prefersReducedMotion()) {
      element.textContent = `${prefix}${target.toFixed(decimals)}${suffix}`;
      return;
    }

    const frame = (now) => {
      const progress = Math.min((now - start) / duration, 1);
      const eased = 1 - ((1 - progress) ** 3);
      element.textContent = `${prefix}${(target * eased).toFixed(decimals)}${suffix}`;
      if (progress < 1) requestAnimationFrame(frame);
    };
    requestAnimationFrame(frame);
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) return;
      animate(entry.target);
      observer.unobserve(entry.target);
    });
  }, { threshold: 0.5 });

  metrics.forEach((metric) => observer.observe(metric));
};
