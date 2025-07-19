<x-layout>
	<h1 class="font-bold text-center text-4xl mb-8">Masuk</h1>

	<x-forms.form method="POST" action="{{ route('login') }}">
		@csrf
		<x-forms.input label="Email" name="email" type="email" />
		<x-forms.input label="Kata Sandi" name="password" type="password" />

		<div class="flex flex-wrap justify-between items-center">
			<x-forms.link href="/register">Belum punya akun?</x-forms.link>

			<x-forms.button>Masuk</x-forms.button>
		</div>
	</x-forms.form>
</x-layout>