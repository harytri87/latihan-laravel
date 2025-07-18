<x-layout>
	<h1 class="font-bold text-center text-4xl mb-8">Buat Akun Baru</h1>

	<x-forms.form action="#">
		<x-forms.input label="Nama" name="name" />
		<x-forms.input label="Username" name="username" />
		<x-forms.input label="Email" name="email" type="email" />
		<x-forms.input label="Kata Sandi" name="password" type="password" />
		<x-forms.input label="Ulangi Kata Sandi" name="password_confirmation" type="password" />
		<x-forms.input label="Foto Profil" name="picture" type="file" />

		<div class="flex flex-wrap justify-between items-center">
			<x-forms.link href="/login">Sudah punya akun?</x-forms.link>

			<x-forms.button>Daftar</x-forms.button>
		</div>
	</x-forms.form>
</x-layout>