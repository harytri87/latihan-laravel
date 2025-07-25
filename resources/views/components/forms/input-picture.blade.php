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

{{-- Pake javascript resources\js\components\profilePicture.js --}}