export function initSiteNavigation() {
  const header = document.querySelector('.site-header');
  const nav = document.getElementById('main-nav');
  const mobileToggle = document.querySelector('.mobile-toggle');
  const mobileMedia = window.matchMedia('(max-width:800px)');
  let currentMenu = null;
  function displayMenu(key) {
    currentMenu = key;
    document.querySelectorAll('[data-menu]').forEach(button => {
      const open = button.dataset.menu === key;
      button.setAttribute('aria-expanded',String(open));
      document.getElementById(button.getAttribute('aria-controls')).hidden = !open;
    });
    header.dataset.menuOpen = String(Boolean(key) || nav.classList.contains('open'));
    document.dispatchEvent(new Event('mnyphoto:menu'));
  }
  function closeMenus() {displayMenu(null);}
  function closeMobile() {nav.classList.remove('open');mobileToggle.setAttribute('aria-expanded','false');mobileToggle.setAttribute('aria-label','Open main menu');header.dataset.menuOpen = String(Boolean(currentMenu));document.dispatchEvent(new Event('mnyphoto:menu'));}
  document.querySelectorAll('[data-menu]').forEach(button => button.addEventListener('click',() => {
    const key = button.dataset.menu;
    if (currentMenu === key) closeMenus();
    else displayMenu(key);
  }));
  mobileToggle.addEventListener('click',() => {
    const open = !nav.classList.contains('open');
    nav.classList.toggle('open',open);
    mobileToggle.setAttribute('aria-expanded',String(open));
    mobileToggle.setAttribute('aria-label',open ? 'Close main menu' : 'Open main menu');
    closeMenus();
  });
  document.addEventListener('click',event => {
    const activeGroup = currentMenu && header.querySelector(`[data-nav-group="${currentMenu}"]`);
    if (activeGroup && !activeGroup.contains(event.target)) closeMenus();
    if (!header.contains(event.target)) closeMobile();
  });
  document.addEventListener('keydown',event => {
    if (event.key !== 'Escape') return;
    if (currentMenu) {const trigger = document.querySelector(`[data-menu="${currentMenu}"]`);closeMenus();trigger.focus();}
    else if (nav.classList.contains('open')) {closeMobile();mobileToggle.focus();}
  });
  mobileMedia.addEventListener('change',() => {closeMenus();closeMobile();});


  document.querySelectorAll('[data-service]>a').forEach(link => {
    const select = () => {
      const id = link.parentElement.dataset.service;
      document.querySelectorAll('[data-service]').forEach(option => option.classList.toggle('active',option.dataset.service === id));
      document.querySelectorAll('[data-service-stage]').forEach(stage => {stage.hidden = stage.dataset.serviceStage !== id;});
    };
    link.addEventListener('pointerenter',select);
    link.addEventListener('focus',select);
  });
  header.addEventListener('click',event => {if (event.target.closest('a')) {closeMenus();closeMobile();}});
}
