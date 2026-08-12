import '../scss/main.scss';

import { initAccordions } from './components/accordion';
import { initArticleContents, initCopyArticleLink } from './components/article-contents';
import { initMetrics } from './components/metrics';
import { initHomeExperience } from './components/home-experience';
import { initReadingProgress } from './components/reading-progress';
import { initReveal } from './components/reveal';
import { initServiceDirectory } from './components/service-directory';
import { initSiteNavigation } from './components/site-navigation';
import { initTabs } from './components/tabs';
import { initWorkFilter } from './components/work-filter';

document.addEventListener('DOMContentLoaded', () => {
  document.querySelector('[data-form-notice]')?.focus();
  initSiteNavigation();
  initAccordions();
  initArticleContents();
  initCopyArticleLink();
  initTabs();
  initHomeExperience();
  initReveal();
  initMetrics();
  initWorkFilter();
  initReadingProgress();
  initServiceDirectory();
});
