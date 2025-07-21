<x-layout>
	<h1 class="font-bold text-center text-4xl mb-8">Ayo Tulis Blogmu!</h1>

	<x-forms.form method="POST" action="{{ route('blogs.store') }}" id="blogForm">
		@csrf

		<x-forms.input label="Judul" name="title" required />

		<x-forms.field label="Isi Blog" name="body">
			<textarea name="body" id="body" class="w-full px-3 py-2 border border-gray-400 focus:outline-none focus:border-laravel rounded" rows="10" required>{{ old('body') }}</textarea>
		</x-forms.field>

		<x-forms.field label="Pilih Tag (maksimal 5)" name="tags">
			<x-forms.tags :$tags />
		</x-forms.field>

		<div class="flex flex-wrap justify-end">
			<x-forms.button>Kirim</x-forms.button>
		</div>
	</x-forms.form>
</x-layout>