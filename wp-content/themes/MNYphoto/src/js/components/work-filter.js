export const initWorkFilter = () => {
  const controls = [...document.querySelectorAll('[data-work-filter]')];
  const projects = [...document.querySelectorAll('[data-project-category]')];
  if (!controls.length || !projects.length) return;

  controls.forEach((control) => control.addEventListener('click', () => {
    const filter = control.dataset.workFilter;
    controls.forEach((candidate) => {
      const isActive = candidate === control;
      candidate.classList.toggle('is-active', isActive);
      candidate.setAttribute('aria-pressed', String(isActive));
    });
    projects.forEach((project) => {
      project.hidden = filter !== 'all' && project.dataset.projectCategory !== filter;
    });
  }));
};
