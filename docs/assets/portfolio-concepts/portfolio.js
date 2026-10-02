/* Progressive enhancement for the static portfolio design drafts. */
(() => {
  const menus = [...document.querySelectorAll('.menu')];
  menus.forEach((menu) => {
    menu.addEventListener('toggle', () => {
      if (menu.open) menus.forEach((other) => { if (other !== menu) other.open = false; });
    });
    menu.addEventListener('click', (event) => {
      if (event.target.closest('a')) menu.open = false;
    });
  });
  document.addEventListener('click', (event) => {
    menus.forEach((menu) => { if (!menu.contains(event.target)) menu.open = false; });
  });
  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') menus.forEach((menu) => {
      if (menu.open) { menu.open = false; menu.querySelector('summary').focus(); }
    });
  });

  const collections = [...document.querySelectorAll('.collection[id]')];
  const navigation = [...document.querySelectorAll('.collection-nav a')];
  if ('IntersectionObserver' in window && navigation.length) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        navigation.forEach((link) => {
          if (link.hash === `#${entry.target.id}`) link.setAttribute('aria-current', 'location');
          else link.removeAttribute('aria-current');
        });
      });
    }, { rootMargin: '-15% 0px -55% 0px', threshold: 0 });
    collections.forEach((section) => observer.observe(section));
  }

  const dialog = document.querySelector('.photo-viewer');
  const photos = [...document.querySelectorAll('[data-photo]')];
  if (!dialog || !photos.length || typeof dialog.showModal !== 'function') return;
  const viewerImage = dialog.querySelector('.viewer-image');
  const viewerTitle = dialog.querySelector('#viewer-title');
  const viewerCategory = dialog.querySelector('#viewer-category');
  const counter = dialog.querySelector('[data-viewer-count]');
  let active = 0;
  let returnFocus;
  function showPhoto(index) {
    active = (index + photos.length) % photos.length;
    const link = photos[active];
    viewerImage.src = link.href;
    viewerImage.alt = link.querySelector('img').alt;
    viewerTitle.textContent = link.dataset.title;
    viewerCategory.textContent = `MNY PHOTO / ${link.dataset.category}`;
    counter.textContent = `${String(active + 1).padStart(2, '0')} / ${String(photos.length).padStart(2, '0')}`;
  }
  photos.forEach((link, index) => link.addEventListener('click', (event) => {
    if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
    event.preventDefault();
    returnFocus = link;
    showPhoto(index);
    dialog.showModal();
    document.documentElement.classList.add('viewer-open');
  }));
  dialog.querySelector('[data-close-viewer]').addEventListener('click', () => dialog.close());
  dialog.querySelector('[data-previous-photo]').addEventListener('click', () => showPhoto(active - 1));
  dialog.querySelector('[data-next-photo]').addEventListener('click', () => showPhoto(active + 1));
  dialog.addEventListener('keydown', (event) => {
    if (event.key === 'ArrowLeft') { event.preventDefault(); showPhoto(active - 1); }
    if (event.key === 'ArrowRight') { event.preventDefault(); showPhoto(active + 1); }
  });
  dialog.addEventListener('click', (event) => { if (event.target === dialog) dialog.close(); });
  dialog.addEventListener('close', () => {
    document.documentElement.classList.remove('viewer-open');
    returnFocus?.focus({ preventScroll: true });
  });
})();
