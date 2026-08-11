export const trapFocus = (container, event) => {
	if (event.key !== 'Tab') return;
	const focusable = [...container.querySelectorAll('a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), summary, [tabindex]:not([tabindex="-1"])')]
		.filter((element) => element.getClientRects().length && element.getAttribute('aria-hidden') !== 'true');
	if (!focusable.length) return;
	const first = focusable[0]; const last = focusable[focusable.length - 1];
	if (event.shiftKey && document.activeElement === first) { event.preventDefault(); last.focus(); }
	if (!event.shiftKey && document.activeElement === last) { event.preventDefault(); first.focus(); }
};
