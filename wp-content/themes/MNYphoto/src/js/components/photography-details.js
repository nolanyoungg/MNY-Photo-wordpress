/** Focus real server-rendered service targets and support skip links. */
export function initPhotographyDetails() {
  const focusTarget = () => {
    let id;
    try { id = decodeURIComponent(location.hash.slice(1)); } catch { return; }
    if (!id.startsWith('service-') && !id.startsWith('cap-')) return;
    const target = document.getElementById(id);
    if (target) {target.focus({preventScroll:true});target.scrollIntoView({block:id.startsWith('cap-') ? 'center' : 'start'});}
  };
  window.addEventListener('hashchange',focusTarget);
  if (location.hash) window.addEventListener('load',focusTarget,{once:true});
  document.querySelector('.skip-link')?.addEventListener('click',() => document.getElementById('content')?.focus());
}
