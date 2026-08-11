export const initReadingProgress = () => {
  const progress = document.querySelector('[data-reading-progress]');
  const article = document.querySelector('.article-content, .entry-content');
  if (!progress || !article) return;

  const update = () => {
    const start = article.offsetTop;
    const distance = Math.max(article.offsetHeight - window.innerHeight, 1);
    const percent = Math.min(Math.max(((window.scrollY - start) / distance) * 100, 0), 100);
    progress.style.width = `${percent}%`;
    progress.parentElement?.style.setProperty('--reading-progress', `${percent}%`);
    document.querySelector('.article-contents__progress')?.style.setProperty('--article-read', `${percent}%`);
  };

  update();
  window.addEventListener('scroll', update, { passive: true });
  window.addEventListener('resize', update);
};
