import '../scss/main.scss';
import { initSiteNavigation } from './components/site-navigation';
import { initHomeExperience } from './components/home-experience';
import { initPhotographyGallery } from './components/photography-gallery';
import { initPhotographyDetails } from './components/photography-details';

document.addEventListener('DOMContentLoaded', () => {
  initSiteNavigation();
  initHomeExperience();
  initPhotographyGallery();
  initPhotographyDetails();
  document.querySelector('[data-form-notice]')?.focus();
});
