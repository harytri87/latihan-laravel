export function initModal() {
	// buka modal
	document.querySelectorAll('[data-modal-id]').forEach(btn => {
		btn.addEventListener('click', () => {
			const id = btn.getAttribute('data-modal-id');
			const modal = document.getElementById(id);

			if (modal) {
				modal.classList.remove('hidden');
			}
		})
	});

	// tutup modal
	document.querySelectorAll('[data-close-modal]').forEach(btn => {
		btn.addEventListener('click', () => {
			const id = btn.getAttribute('data-close-modal');
			const modal = document.getElementById(id);

			if (modal) {
				modal.classList.add('hidden');
			}
		})
	});
}