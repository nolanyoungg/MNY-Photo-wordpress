const headingId = (heading, index) => {
  if (heading.id) return heading.id;

  const base = heading.textContent
    .trim()
    .toLowerCase()
    .replace(/[^a-z0-9\s-]/g, '')
    .replace(/\s+/g, '-')
    .replace(/-+/g, '-')
    .replace(/^-|-$/g, '');

  heading.id = base || `article-section-${index + 1}`;
  return heading.id;
};

export const initArticleContents = () => {
  const article = document.querySelector('.article-content');
  const contents = document.querySelector('[data-article-toc]');
  if (!article || !contents) return;

  const headings = [...article.querySelectorAll('h2, h3')];
  if (!headings.length) return;

  const links = headings.map((heading, index) => {
    const link = document.createElement('a');
    link.href = `#${headingId(heading, index)}`;
    link.textContent = heading.textContent.trim();
    if (heading.tagName === 'H3') link.classList.add('is-subsection');
    return link;
  });

  contents.replaceChildren(...links);

  if (!('IntersectionObserver' in window)) return;

  const activate = (id) => {
    links.forEach((link) => {
      link.classList.toggle('is-active', link.hash === `#${id}`);
    });
  };

  const observer = new IntersectionObserver((entries) => {
    const visible = entries
      .filter((entry) => entry.isIntersecting)
      .sort((a, b) => a.boundingClientRect.top - b.boundingClientRect.top);
    if (visible[0]) activate(visible[0].target.id);
  }, {
    rootMargin: '-18% 0px -68% 0px',
    threshold: 0,
  });

  headings.forEach((heading) => observer.observe(heading));
};

export const initCopyArticleLink = () => {
  const copyLink = document.querySelector('[data-copy-link]');
  if (!copyLink || !navigator.clipboard) return;

  copyLink.addEventListener('click', async (event) => {
    event.preventDefault();
    await navigator.clipboard.writeText(copyLink.href);
    const label = copyLink.querySelector('span');
    if (!label) return;
    const original = label.textContent;
    label.textContent = 'Link copied';
    window.setTimeout(() => {
      label.textContent = original;
    }, 1800);
  });
};
