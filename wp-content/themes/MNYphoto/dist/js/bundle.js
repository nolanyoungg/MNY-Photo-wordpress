/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/components/accordion.js":
/*!****************************************!*\
  !*** ./src/js/components/accordion.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   initAccordions: () => (/* binding */ initAccordions)
/* harmony export */ });
const initAccordions = () => {
  document.querySelectorAll('[data-accordion]').forEach((accordion) => {
    const triggers = [...accordion.querySelectorAll('button[aria-controls]')];

    triggers.forEach((trigger) => {
      const panel = document.getElementById(trigger.getAttribute('aria-controls'));
      trigger.setAttribute('aria-expanded', 'false');
      if (panel) panel.hidden = true;

    });

    triggers.forEach((trigger) => {
      trigger.addEventListener('click', () => {
        const panel = document.getElementById(trigger.getAttribute('aria-controls'));
        const expanded = trigger.getAttribute('aria-expanded') === 'true';

        triggers.forEach((otherTrigger) => {
          const otherPanel = document.getElementById(otherTrigger.getAttribute('aria-controls'));
          otherTrigger.setAttribute('aria-expanded', 'false');
          if (otherPanel) otherPanel.hidden = true;
        });

        trigger.setAttribute('aria-expanded', String(!expanded));
        if (panel) panel.hidden = expanded;
      });
    });
  });
};


/***/ }),

/***/ "./src/js/components/article-contents.js":
/*!***********************************************!*\
  !*** ./src/js/components/article-contents.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   initArticleContents: () => (/* binding */ initArticleContents),
/* harmony export */   initCopyArticleLink: () => (/* binding */ initCopyArticleLink)
/* harmony export */ });
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

const initArticleContents = () => {
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

const initCopyArticleLink = () => {
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


/***/ }),

/***/ "./src/js/components/home-experience.js":
/*!**********************************************!*\
  !*** ./src/js/components/home-experience.js ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   initHomeExperience: () => (/* binding */ initHomeExperience)
/* harmony export */ });
/* harmony import */ var _utilities_prefers_reduced_motion__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utilities/prefers-reduced-motion */ "./src/js/utilities/prefers-reduced-motion.js");


const initSculptureDepth = (root) => {
  const sculpture = root.querySelector('[data-home-sculpture]');
  if (!sculpture || (0,_utilities_prefers_reduced_motion__WEBPACK_IMPORTED_MODULE_0__.prefersReducedMotion)()) return;

  sculpture.addEventListener('pointermove', (event) => {
    if (event.pointerType === 'touch' || window.innerWidth <= 900) return;
    const bounds = sculpture.getBoundingClientRect();
    const x = ((event.clientX - bounds.left) / bounds.width) - 0.5;
    const y = ((event.clientY - bounds.top) / bounds.height) - 0.5;
    sculpture.style.setProperty('--sculpture-x', `${(x * 10).toFixed(2)}px`);
    sculpture.style.setProperty('--sculpture-y', `${(y * 10).toFixed(2)}px`);
  });

  sculpture.addEventListener('pointerleave', () => {
    sculpture.style.setProperty('--sculpture-x', '0px');
    sculpture.style.setProperty('--sculpture-y', '0px');
  });
};

const initRoadmapProgress = (root) => {
  const steps = [...root.querySelectorAll('[data-home-process-step]')];
  if (!steps.length || (0,_utilities_prefers_reduced_motion__WEBPACK_IMPORTED_MODULE_0__.prefersReducedMotion)() || !('IntersectionObserver' in window)) return;

  const observer = new IntersectionObserver((entries) => {
    const current = entries.find((entry) => entry.isIntersecting);
    if (!current) return;
    steps.forEach((step) => step.classList.toggle('is-current', step === current.target));
  }, { rootMargin: '-34% 0px -46%', threshold: 0.05 });

  steps.forEach((step) => observer.observe(step));
};

const initHomeExperience = () => {
  const root = document.querySelector('[data-home-editorial]');
  if (!root) return;
  initSculptureDepth(root);
  initRoadmapProgress(document);
};


/***/ }),

/***/ "./src/js/components/metrics.js":
/*!**************************************!*\
  !*** ./src/js/components/metrics.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   initMetrics: () => (/* binding */ initMetrics)
/* harmony export */ });
/* harmony import */ var _utilities_prefers_reduced_motion__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utilities/prefers-reduced-motion */ "./src/js/utilities/prefers-reduced-motion.js");


const initMetrics = () => {
  const metrics = [...document.querySelectorAll('[data-metric]')];
  if (!metrics.length) return;

  const animate = (element) => {
    const target = Number(element.dataset.metric || 0);
    const prefix = element.dataset.prefix || '';
    const suffix = element.dataset.suffix || '';
    const duration = 900;
    const start = performance.now();
    const decimals = String(target).includes('.') ? 1 : 0;

    if ((0,_utilities_prefers_reduced_motion__WEBPACK_IMPORTED_MODULE_0__.prefersReducedMotion)()) {
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


/***/ }),

/***/ "./src/js/components/reading-progress.js":
/*!***********************************************!*\
  !*** ./src/js/components/reading-progress.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   initReadingProgress: () => (/* binding */ initReadingProgress)
/* harmony export */ });
const initReadingProgress = () => {
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


/***/ }),

/***/ "./src/js/components/reveal.js":
/*!*************************************!*\
  !*** ./src/js/components/reveal.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   initReveal: () => (/* binding */ initReveal)
/* harmony export */ });
/* harmony import */ var _utilities_prefers_reduced_motion__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utilities/prefers-reduced-motion */ "./src/js/utilities/prefers-reduced-motion.js");


const initReveal = () => {
  const elements = [...document.querySelectorAll('[data-reveal]')];
  if (!elements.length) return;

  if ((0,_utilities_prefers_reduced_motion__WEBPACK_IMPORTED_MODULE_0__.prefersReducedMotion)() || !('IntersectionObserver' in window)) {
    elements.forEach((element) => element.classList.add('is-visible'));
    return;
  }

  document.documentElement.classList.add('reveal-ready');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) return;
      entry.target.classList.add('is-visible');
      observer.unobserve(entry.target);
    });
  }, { threshold: 0.04 });

  elements.forEach((element) => observer.observe(element));
};


/***/ }),

/***/ "./src/js/components/service-directory.js":
/*!************************************************!*\
  !*** ./src/js/components/service-directory.js ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   initServiceDirectory: () => (/* binding */ initServiceDirectory)
/* harmony export */ });
/* harmony import */ var _utilities_prefers_reduced_motion__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utilities/prefers-reduced-motion */ "./src/js/utilities/prefers-reduced-motion.js");


const currentDirectoryTarget = () => {
  const identifier = decodeURIComponent(window.location.hash.slice(1));
  if (!identifier) return null;

  const target = document.getElementById(identifier);
  return target?.closest('.service-directory') ? target : null;
};

const scrollToDirectoryTarget = (behavior = 'auto') => {
  const target = currentDirectoryTarget();
  if (!target) return;

  target.scrollIntoView({
    behavior: (0,_utilities_prefers_reduced_motion__WEBPACK_IMPORTED_MODULE_0__.prefersReducedMotion)() ? 'auto' : behavior,
    block: 'start',
  });
};

const scheduleDirectoryScroll = (behavior) => {
  window.requestAnimationFrame(() => {
    window.requestAnimationFrame(() => scrollToDirectoryTarget(behavior));
  });
};

const initServiceDirectory = () => {
  if (!document.querySelector('.service-directory')) return;

  scheduleDirectoryScroll('auto');
  window.addEventListener('hashchange', () => scheduleDirectoryScroll('smooth'));
};


/***/ }),

/***/ "./src/js/components/site-navigation.js":
/*!**********************************************!*\
  !*** ./src/js/components/site-navigation.js ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   initSiteNavigation: () => (/* binding */ initSiteNavigation)
/* harmony export */ });
/* harmony import */ var _utilities_focus_trap__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utilities/focus-trap */ "./src/js/utilities/focus-trap.js");


const OPEN_DELAY = 120;
const CLOSE_DELAY = 180;

const initSiteNavigation = () => {
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
      (0,_utilities_focus_trap__WEBPACK_IMPORTED_MODULE_0__.trapFocus)(header, event);
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


/***/ }),

/***/ "./src/js/components/tabs.js":
/*!***********************************!*\
  !*** ./src/js/components/tabs.js ***!
  \***********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   initTabs: () => (/* binding */ initTabs)
/* harmony export */ });
const initTabs = () => {
  document.querySelectorAll('[role="tablist"]').forEach((tablist) => {
    const tabs = [...tablist.querySelectorAll('[role="tab"]')];

    tabs.forEach((tab) => {
      const selected = tab.getAttribute('aria-selected') === 'true';
      const panel = document.getElementById(tab.getAttribute('aria-controls'));
      tab.tabIndex = selected ? 0 : -1;
      if (panel) panel.hidden = !selected;
    });

    const activate = (activeTab) => {
      tabs.forEach((tab) => {
        const selected = tab === activeTab;
        const panel = document.getElementById(tab.getAttribute('aria-controls'));
        tab.setAttribute('aria-selected', String(selected));
        tab.tabIndex = selected ? 0 : -1;
        if (panel) panel.hidden = !selected;
      });
    };

    tabs.forEach((tab, index) => {
      tab.addEventListener('click', () => activate(tab));
      tab.addEventListener('keydown', (event) => {
        if (!['ArrowLeft', 'ArrowRight', 'Home', 'End'].includes(event.key)) return;
        event.preventDefault();

        let nextIndex = index;
        if (event.key === 'ArrowRight') nextIndex = (index + 1) % tabs.length;
        if (event.key === 'ArrowLeft') nextIndex = (index + tabs.length - 1) % tabs.length;
        if (event.key === 'Home') nextIndex = 0;
        if (event.key === 'End') nextIndex = tabs.length - 1;

        tabs[nextIndex].focus();
        activate(tabs[nextIndex]);
      });
    });
  });
};


/***/ }),

/***/ "./src/js/components/work-filter.js":
/*!******************************************!*\
  !*** ./src/js/components/work-filter.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   initWorkFilter: () => (/* binding */ initWorkFilter)
/* harmony export */ });
const initWorkFilter = () => {
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


/***/ }),

/***/ "./src/js/utilities/focus-trap.js":
/*!****************************************!*\
  !*** ./src/js/utilities/focus-trap.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   trapFocus: () => (/* binding */ trapFocus)
/* harmony export */ });
const trapFocus = (container, event) => {
	if (event.key !== 'Tab') return;
	const focusable = [...container.querySelectorAll('a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), summary, [tabindex]:not([tabindex="-1"])')]
		.filter((element) => element.getClientRects().length && element.getAttribute('aria-hidden') !== 'true');
	if (!focusable.length) return;
	const first = focusable[0]; const last = focusable[focusable.length - 1];
	if (event.shiftKey && document.activeElement === first) { event.preventDefault(); last.focus(); }
	if (!event.shiftKey && document.activeElement === last) { event.preventDefault(); first.focus(); }
};


/***/ }),

/***/ "./src/js/utilities/prefers-reduced-motion.js":
/*!****************************************************!*\
  !*** ./src/js/utilities/prefers-reduced-motion.js ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   prefersReducedMotion: () => (/* binding */ prefersReducedMotion)
/* harmony export */ });
const prefersReducedMotion = () => window.matchMedia('(prefers-reduced-motion: reduce)').matches;


/***/ }),

/***/ "./src/scss/main.scss":
/*!****************************!*\
  !*** ./src/scss/main.scss ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!************************!*\
  !*** ./src/js/main.js ***!
  \************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _scss_main_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../scss/main.scss */ "./src/scss/main.scss");
/* harmony import */ var _components_accordion__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./components/accordion */ "./src/js/components/accordion.js");
/* harmony import */ var _components_article_contents__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./components/article-contents */ "./src/js/components/article-contents.js");
/* harmony import */ var _components_metrics__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./components/metrics */ "./src/js/components/metrics.js");
/* harmony import */ var _components_home_experience__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./components/home-experience */ "./src/js/components/home-experience.js");
/* harmony import */ var _components_reading_progress__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./components/reading-progress */ "./src/js/components/reading-progress.js");
/* harmony import */ var _components_reveal__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./components/reveal */ "./src/js/components/reveal.js");
/* harmony import */ var _components_service_directory__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./components/service-directory */ "./src/js/components/service-directory.js");
/* harmony import */ var _components_site_navigation__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./components/site-navigation */ "./src/js/components/site-navigation.js");
/* harmony import */ var _components_tabs__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./components/tabs */ "./src/js/components/tabs.js");
/* harmony import */ var _components_work_filter__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./components/work-filter */ "./src/js/components/work-filter.js");













document.addEventListener('DOMContentLoaded', () => {
  document.querySelector('[data-form-notice]')?.focus();
  (0,_components_site_navigation__WEBPACK_IMPORTED_MODULE_8__.initSiteNavigation)();
  (0,_components_accordion__WEBPACK_IMPORTED_MODULE_1__.initAccordions)();
  (0,_components_article_contents__WEBPACK_IMPORTED_MODULE_2__.initArticleContents)();
  (0,_components_article_contents__WEBPACK_IMPORTED_MODULE_2__.initCopyArticleLink)();
  (0,_components_tabs__WEBPACK_IMPORTED_MODULE_9__.initTabs)();
  (0,_components_home_experience__WEBPACK_IMPORTED_MODULE_4__.initHomeExperience)();
  (0,_components_reveal__WEBPACK_IMPORTED_MODULE_6__.initReveal)();
  (0,_components_metrics__WEBPACK_IMPORTED_MODULE_3__.initMetrics)();
  (0,_components_work_filter__WEBPACK_IMPORTED_MODULE_10__.initWorkFilter)();
  (0,_components_reading_progress__WEBPACK_IMPORTED_MODULE_5__.initReadingProgress)();
  (0,_components_service_directory__WEBPACK_IMPORTED_MODULE_7__.initServiceDirectory)();
});

})();

/******/ })()
;
//# sourceMappingURL=bundle.js.map