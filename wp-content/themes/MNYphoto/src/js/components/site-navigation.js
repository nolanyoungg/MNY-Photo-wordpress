import { trapFocus } from '../utilities/focus-trap';

const OPEN_DELAY = 120;
const CLOSE_DELAY = 180;

export const initSiteNavigation = () => {
  const navigation = document.querySelector('.site-navigation');
  const toggle = document.querySelector('[data-nav-toggle]');
  const overlay = document.querySelector('[data-mega-overlay]');
  const menuItems = [...document.querySelectorAll('[data-mega-item]')];
  const header = navigation.closest('.site-header');
  const pageRegions = [document.querySelector('main'), document.querySelector('.site-footer')].filter(Boolean);
  let openTimer;
  let closeTimer;
  let pinnedItem = null;
  let isMobileLayout = window.innerWidth <= 980;

  if (!navigation || !toggle) return;

  const setPageInert = (isInert) => {
    pageRegions.forEach((region) => {
      if (isInert) region.setAttribute('inert', '');
      else region.removeAttribute('inert');
    });
  };

  const panelFor = (item) => item?.querySelector('[data-mega-panel]');
  const triggerFor = (item) => item?.querySelector('[data-mega-trigger]');

  const closeItem = (item, restoreFocus = false) => {
    const panel = panelFor(item);
    const trigger = triggerFor(item);

    panel?.classList.remove('is-open');
    trigger?.setAttribute('aria-expanded', 'false');
    if (restoreFocus) trigger?.focus();
  };

  const syncOverlay = () => {
    const hasOpenPanel = menuItems.some((item) => panelFor(item)?.classList.contains('is-open'));
    overlay?.classList.toggle('is-visible', hasOpenPanel);
    document.body.classList.toggle('is-menu-open', hasOpenPanel || navigation.classList.contains('is-open'));
  };

  const closeAll = (except = null, restoreFocus = false) => {
    menuItems.forEach((item) => {
      if (item !== except) closeItem(item, restoreFocus);
    });
    syncOverlay();
  };

  const setPinnedItem = (item = null) => {
    pinnedItem?.classList.remove('is-pinned');
    pinnedItem = item;
    pinnedItem?.classList.add('is-pinned');
  };

  const syncServiceOptionMode = () => {
    menuItems.forEach((item) => {
      const serviceOptions = [...item.querySelectorAll('.service-option')];
      if (!serviceOptions.length) return;

      if (window.innerWidth <= 980) {
        serviceOptions.forEach((option) => option.classList.remove('is-active'));
      } else if (!serviceOptions.some((option) => option.classList.contains('is-active'))) {
        serviceOptions[0].classList.add('is-active');
      }
    });
  };

  const openItem = (item) => {
    clearTimeout(closeTimer);
    closeAll(item);
    panelFor(item)?.classList.add('is-open');
    triggerFor(item)?.setAttribute('aria-expanded', 'true');
    syncOverlay();
  };

  menuItems.forEach((item) => {
    const trigger = triggerFor(item);
    const panel = panelFor(item);
    let pointerActivating = false;

    trigger?.addEventListener('pointerdown', () => {
      pointerActivating = true;
    });

    trigger?.addEventListener('click', () => {
      if (pinnedItem === item) {
        setPinnedItem();
        closeItem(item);
        syncOverlay();
      } else {
        setPinnedItem(item);
        openItem(item);
      }
      pointerActivating = false;
    });

    item.addEventListener('pointerenter', (event) => {
      if (event.pointerType === 'touch' || window.innerWidth <= 980) return;
      clearTimeout(closeTimer);
      openTimer = window.setTimeout(() => openItem(item), OPEN_DELAY);
    });

    item.addEventListener('pointerleave', (event) => {
      if (event.pointerType === 'touch' || window.innerWidth <= 980) return;
      clearTimeout(openTimer);
      closeTimer = window.setTimeout(() => {
        if (pinnedItem === item) return;
        if (pinnedItem) openItem(pinnedItem);
        else {
          closeItem(item);
          syncOverlay();
        }
      }, CLOSE_DELAY);
    });

    item.addEventListener('focusin', () => {
      if (!pointerActivating && window.innerWidth > 980) openItem(item);
    });

    item.addEventListener('focusout', (event) => {
      if (window.innerWidth <= 980 || item.contains(event.relatedTarget)) return;

      clearTimeout(closeTimer);
      closeTimer = window.setTimeout(() => {
        if (pinnedItem === item) return;
        if (pinnedItem) openItem(pinnedItem);
        else {
          closeItem(item);
          syncOverlay();
        }
      }, CLOSE_DELAY);
    });

    item.querySelectorAll('[data-mega-option]').forEach((option) => {
      const updateFeature = () => {
        const feature = item.querySelector('[data-mega-feature]');
        if (!feature) return;
        if (window.innerWidth <= 980 && feature.classList.contains('service-stage')) return;

        item.querySelectorAll('[data-mega-option]').forEach((candidate) => {
          candidate.classList.toggle('is-active', candidate === option);
        });

        feature.classList.remove('is-refreshing');
        void feature.offsetWidth;
        feature.classList.add('is-refreshing');

        const code = feature.querySelector('[data-mega-code]');
        const title = feature.querySelector('[data-mega-title]');
        const description = feature.querySelector('[data-mega-description]');
        const signal = feature.querySelector('[data-mega-signal]');
        const stat = feature.querySelector('[data-mega-stat]');
        const statLabel = feature.querySelector('[data-mega-stat-label]');
        const position = feature.querySelector('[data-mega-position]');
        const featureLink = feature.querySelector('[data-mega-feature-link]');

        if (code) code.textContent = option.dataset.code || '';
        if (title) title.textContent = option.dataset.title || '';
        if (description) description.textContent = option.dataset.description || '';
        if (signal) signal.textContent = option.dataset.signal || '';
        if (stat) stat.textContent = option.dataset.stat || '';
        if (statLabel) statLabel.textContent = option.dataset.statLabel || '';
        if (position) position.textContent = option.dataset.position || '';
        if (featureLink) featureLink.href = option.href;
        if (option.dataset.visual && feature.classList.contains('service-stage')) {
          feature.dataset.serviceVisual = option.dataset.visual;
        }
        if (option.dataset.visual && feature.classList.contains('work-lab')) {
          feature.dataset.workVisual = option.dataset.visual;
        }

        const links = feature.querySelector('[data-mega-links]');
        let labels = [];
        try {
          labels = JSON.parse(option.dataset.links || '[]');
        } catch {
          labels = [];
        }
        links?.replaceChildren(...labels.map((capability, index) => {
          const listItem = document.createElement('li');
          const capabilityLabel = typeof capability === 'string' ? capability : capability.label;
          if (feature.classList.contains('service-stage')) {
            const number = document.createElement('span');
            const label = document.createElement('span');
            const link = document.createElement('a');
            number.textContent = String(index + 1).padStart(2, '0');
            label.textContent = capabilityLabel || '';
            link.href = capability.url || option.href;
            link.append(number, label);
            listItem.style.setProperty('--capability-index', index);
            listItem.append(link);
          } else {
            listItem.textContent = capabilityLabel || '';
          }
          return listItem;
        }));
      };

      option.addEventListener('pointerenter', updateFeature);
      option.addEventListener('focus', updateFeature);
    });

    const serviceStage = item.querySelector('[data-service-visual]');
    serviceStage?.addEventListener('pointermove', (event) => {
      if (event.pointerType === 'touch' || window.innerWidth <= 980) return;

      const bounds = serviceStage.getBoundingClientRect();
      const pointerX = ((event.clientX - bounds.left) / bounds.width) - 0.5;
      const pointerY = ((event.clientY - bounds.top) / bounds.height) - 0.5;
      serviceStage.style.setProperty('--stage-rotate-x', `${(-pointerY * 2.4).toFixed(2)}deg`);
      serviceStage.style.setProperty('--stage-rotate-y', `${(pointerX * 3.2).toFixed(2)}deg`);
      serviceStage.style.setProperty('--stage-shift-x', `${(pointerX * 18).toFixed(2)}px`);
      serviceStage.style.setProperty('--stage-shift-y', `${(pointerY * 18).toFixed(2)}px`);
    });

    serviceStage?.addEventListener('pointerleave', () => {
      serviceStage.style.setProperty('--stage-rotate-x', '0deg');
      serviceStage.style.setProperty('--stage-rotate-y', '0deg');
      serviceStage.style.setProperty('--stage-shift-x', '0px');
      serviceStage.style.setProperty('--stage-shift-y', '0px');
    });

    panel?.addEventListener('click', (event) => {
      if (!(event.target instanceof Element) || !event.target.closest('a')) return;

      if (window.innerWidth <= 980) {
        navigation.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
        setPageInert(false);
      }
      setPinnedItem();
      closeAll();
    });
  });

  toggle.addEventListener('click', () => {
    const isOpen = navigation.classList.toggle('is-open');
    toggle.setAttribute('aria-expanded', String(isOpen));
    document.body.classList.toggle('is-menu-open', isOpen);
    setPageInert(isOpen);
    if (isOpen) navigation.querySelector('a, button')?.focus();
    else {
      setPinnedItem();
      closeAll();
    }
  });

  overlay?.addEventListener('click', () => {
    setPinnedItem();
    closeAll();
  });

  document.addEventListener('click', (event) => {
    if (!event.target.closest('[data-mega-item]')) {
      setPinnedItem();
      closeAll();
    }
  });

  document.addEventListener('keydown', (event) => {
    if (navigation.classList.contains('is-open') && window.innerWidth <= 980 && header) {
      trapFocus(header, event);
    }

    if (event.key !== 'Escape') return;

    const expanded = menuItems.find((item) => triggerFor(item)?.getAttribute('aria-expanded') === 'true');
    if (expanded) {
      setPinnedItem();
      closeAll(null, false);
      triggerFor(expanded)?.focus();
    } else if (navigation.classList.contains('is-open')) {
      navigation.classList.remove('is-open');
      toggle.setAttribute('aria-expanded', 'false');
      document.body.classList.remove('is-menu-open');
      setPageInert(false);
      toggle.focus();
    }
  });

  document.addEventListener('focusin', (event) => {
    if (window.innerWidth <= 980 || !menuItems.some((item) => panelFor(item)?.classList.contains('is-open'))) return;
    if (event.target instanceof Element && navigation.contains(event.target)) return;
    setPinnedItem();
    closeAll();
  });

  window.addEventListener('resize', () => {
    const nextMobileLayout = window.innerWidth <= 980;
    if (nextMobileLayout === isMobileLayout) return;
    isMobileLayout = nextMobileLayout;

    if (window.innerWidth > 980) {
      navigation.classList.remove('is-open');
      toggle.setAttribute('aria-expanded', 'false');
    }
    setPinnedItem();
    closeAll();
    setPageInert(false);
    syncServiceOptionMode();
  });

  syncServiceOptionMode();
};
