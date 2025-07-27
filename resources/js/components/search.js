export function initSearchForm() {
	const form = document.getElementById('search-form');

	document.querySelectorAll(`button[data-search-key]`).forEach(btn => {
		btn.addEventListener('click', () => {
			const key = btn.getAttribute('data-search-key')
			const value = btn.getAttribute('data-search-value');
			let input = form.querySelector(`input[name="${key}"]`);

			console.log("key", key);
			console.log("value", value);

			if (!input) {
				input = document.createElement('input');
				input.type = 'hidden';
				input.name = key;
				form.appendChild(input);
			}

			input.value = value;
			form.submit();
		})
	});
}