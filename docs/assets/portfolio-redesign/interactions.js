(() => {
  const menus = [...document.querySelectorAll('.dropdown')];
  menus.forEach(menu => {
    menu.addEventListener('toggle', () => {
      if (menu.open) menus.forEach(other => { if (other !== menu) other.open = false; });
    });
    menu.addEventListener('click', event => { if (event.target.closest('a')) menu.open = false; });
  });
  document.addEventListener('click', event => menus.forEach(menu => {
    if (!menu.contains(event.target)) menu.open = false;
  }));
  document.addEventListener('keydown', event => {
    if (event.key !== 'Escape') return;
    menus.forEach(menu => {
      if (menu.open) { menu.open = false; menu.querySelector('summary').focus(); }
    });
  });

  const collectionPhotos = [...document.querySelectorAll('.collection .open-photo')];
  const previewImage = document.querySelector('.selector-picture img');
  const previewLink = document.querySelector('[data-preview-link]');
  const previewName = document.querySelector('[data-preview-name]');
  const previewButtons = [...document.querySelectorAll('[data-preview]')];
  function preview(id) {
    const original = collectionPhotos.find(button => button.dataset.photo === id);
    if (!original || !previewImage) return;
    const source = original.querySelector('img');
    previewImage.src = source.src;
    previewImage.alt = source.alt;
    previewImage.style.objectPosition = source.style.objectPosition;
    previewLink.href = `#${id}`;
    previewName.textContent = document.getElementById(`${id}-heading`).textContent;
    previewButtons.forEach(button => button.setAttribute('aria-pressed', String(button.dataset.preview === id)));
  }
  previewButtons.forEach(button => {
    button.addEventListener('click', () => preview(button.dataset.preview));
  });
  if (previewImage) document.documentElement.classList.add('has-preview');

  const viewer = document.getElementById('photo-viewer');
  const review = document.getElementById('review-dialog');
  let activeIndex = 0;
  let lastTrigger;
  const canDialog = typeof viewer?.showModal === 'function';
  function display(index) {
    activeIndex = (index + collectionPhotos.length) % collectionPhotos.length;
    const button = collectionPhotos[activeIndex];
    const original = button.querySelector('img');
    const fullImage = viewer.querySelector('.viewer-image');
    fullImage.src = original.src;
    fullImage.alt = original.alt;
    viewer.querySelector('#viewer-heading').textContent = document.getElementById(`${button.dataset.photo}-heading`).textContent;
    viewer.querySelector('[data-viewer-position]').textContent = `${activeIndex + 1} / ${collectionPhotos.length}`;
  }
  function open(dialog, trigger) {
    lastTrigger = trigger;
    dialog.showModal();
    document.documentElement.classList.add('dialog-open');
  }
  if (canDialog) {
    collectionPhotos.forEach((button, index) => button.addEventListener('click', () => {
      display(index);
      open(viewer, button);
    }));
    document.querySelector('[data-open-review]').addEventListener('click', event => open(review, event.currentTarget));
    document.querySelectorAll('[data-close-dialog]').forEach(button => button.addEventListener('click', () => button.closest('dialog').close()));
    [viewer, review].forEach(dialog => {
      dialog.addEventListener('close', () => {
        document.documentElement.classList.remove('dialog-open');
        lastTrigger?.focus({preventScroll:true});
      });
      dialog.addEventListener('click', event => { if (event.target === dialog) dialog.close(); });
    });
    viewer.querySelector('[data-viewer-previous]').addEventListener('click', () => display(activeIndex - 1));
    viewer.querySelector('[data-viewer-next]').addEventListener('click', () => display(activeIndex + 1));
    viewer.addEventListener('keydown', event => {
      if (event.key === 'ArrowLeft') { event.preventDefault(); display(activeIndex - 1); }
      if (event.key === 'ArrowRight') { event.preventDefault(); display(activeIndex + 1); }
    });
  }
})();
