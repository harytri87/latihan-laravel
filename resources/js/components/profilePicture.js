export function initProfilePicture(inputId, divId) {
	const input = document.getElementById(inputId);
	const div = document.getElementById(divId);
	
	if (!input || !div) return;

	input.addEventListener('change', (e) => {
		const file = e.target.files[0];

		if (!file) {
			div.classList.add('hidden');
			return
		}

		div.classList.remove('hidden');

		// Gatau kenapa kalo pake getElementById ga bisa. Balapan sama fitur Laravel di belakang layarnya?
		// Dikirain gara2 <img> yg di header punya id yg sama persis. Tapi pas udh coba dibedain idnya masih ga bisa.
		const img = e.target.closest('form').querySelector('img');

		if (img) {
			img.src = URL.createObjectURL(file);
			img.onload = () => URL.revokeObjectURL(img.src);
		}
		// Pas gambarnya udh tampil, hapus data blobnya dari memori browser.
	});
}