export const debounce = (callback, wait = 160) => {
	let timeout;
	return (...args) => { window.clearTimeout(timeout); timeout = window.setTimeout(() => callback(...args), wait); };
};
