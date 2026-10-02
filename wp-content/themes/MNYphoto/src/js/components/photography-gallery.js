/** Native image links and collection URLs work before enhancement. */
export function initPhotographyGallery() {
  const viewer = document.getElementById('photo-viewer');
  const links = [...document.querySelectorAll('[data-photo]')];
  if (!viewer || !links.length) return;
  let collection = links;
  let current = 0;
  let opener;
  const notify = () => document.dispatchEvent(new Event('mnyphoto:viewer'));
  const show = index => {
    current = (index + collection.length) % collection.length;
    const link = collection[current];
    const img = document.getElementById('viewer-image');
    img.src = link.href;
    img.alt = link.querySelector('img').alt;
    document.getElementById('viewer-title').textContent = link.dataset.title;
    document.getElementById('viewer-caption').textContent = link.dataset.caption;
  };
  links.forEach(link => link.addEventListener('click',event => {
    if (event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) return;
    event.preventDefault();
    opener = link;
    collection = links.filter(item => !item.closest('.photo-card').hidden);
    show(collection.indexOf(link));
    viewer.showModal();
    notify();
  }));
  document.querySelector('[data-close="photo-viewer"]').addEventListener('click',() => viewer.close());
  document.getElementById('viewer-previous').addEventListener('click',() => show(current - 1));
  document.getElementById('viewer-next').addEventListener('click',() => show(current + 1));
  viewer.addEventListener('keydown',event => {
    if (event.key === 'ArrowLeft' || event.key === 'ArrowRight') {event.preventDefault();show(current + (event.key === 'ArrowRight' ? 1 : -1));}
  });
  viewer.addEventListener('click',event => {
    if (event.target !== viewer) return;
    const rect = viewer.getBoundingClientRect();
    if (event.clientX < rect.left || event.clientX > rect.right || event.clientY < rect.top || event.clientY > rect.bottom) viewer.close();
  });
  viewer.addEventListener('close',() => {opener?.focus();notify();});

  const filters = [...document.querySelectorAll('[data-filter]')];
  const apply = id => {
    filters.forEach(link => {if (link.dataset.filter === id) link.setAttribute('aria-current','true');else link.removeAttribute('aria-current');});
    document.querySelectorAll('#portfolio-grid .photo-card').forEach(card => {card.hidden = id !== 'all' && card.dataset.category !== id;});
    const label = filters.find(link => link.dataset.filter === id)?.textContent || '';
    document.getElementById('portfolio-status').textContent = label;
  };
  filters.forEach(link => link.addEventListener('click',event => {
    if (event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) return;
    event.preventDefault();apply(link.dataset.filter);history.pushState(null,'',link.href);
  }));
  if (filters.length) window.addEventListener('popstate',() => {
    const id = new URL(location.href).searchParams.get('collection') || 'all';
    apply(filters.some(link => link.dataset.filter === id) ? id : 'all');
  });
}
