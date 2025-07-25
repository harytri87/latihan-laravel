@props(['picture'])

<x-forms.input label="Foto Profil" name="picture" type="file"
    id="input-profile-pic"
    accept="image/*"
/>

<x-profile-picture
	:picture="$picture"
	size="big"
	id="div-profile-pic"
	class="hidden"
/>

<script>
document.addEventListener('DOMContentLoaded', () => {
	const inputProfilePic = document.getElementById('input-profile-pic');
	if (inputProfilePic) {
		inputProfilePic.addEventListener('change', handleProfilePicChange);
	}
});

function handleProfilePicChange(e) {
    const file = e.target.files[0];
	const divProfilePic = document.getElementById('div-profile-pic');

    if (!file) {
		divProfilePic.classList.add('hidden');
		return;
	} else {
		divProfilePic.classList.remove('hidden');
	}

	// Gatau kenapa kalo pake getElementById ga bisa. Balapan sama fitur Laravel di belakang layarnya?
	// Dikirain gara2 <img> yg di header punya id yg sama persis. Tapi pas udh coba dibedain idnya jg masih ga bisa.
    const imgProfilePic = e.target.closest('form').querySelector('img');
    
	imgProfilePic.src = URL.createObjectURL(file);
	imgProfilePic.onload = () => URL.revokeObjectURL(imgProfilePic.src);
	// Pas gambarnya udh tampil, hapus data blobnya dari memori browser.
};
</script>