<x-layout>
	<h1 class="font-bold text-center text-4xl mb-8">Buat Akun Baru</h1>

	<x-forms.form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
		@csrf
		<x-forms.input label="Nama" name="name" required />
		<x-forms.input label="Username" name="username" required />
		<x-forms.input label="Email" name="email" type="email" required />
		<x-forms.input label="Kata Sandi" name="password" type="password" required />
		<x-forms.input label="Ulangi Kata Sandi" name="password_confirmation" type="password" required />
		<x-forms.input-picture :picture="null" />

		<div class="flex flex-wrap justify-between items-center">
			<x-forms.link href="{{ route('login') }}">Sudah punya akun?</x-forms.link>

			<x-forms.button type="submit">Daftar</x-forms.button>
		</div>
	</x-forms.form>
</x-layout>