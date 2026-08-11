export const initAccordions = () => {
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
