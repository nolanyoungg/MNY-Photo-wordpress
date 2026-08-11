export const initTabs = () => {
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
