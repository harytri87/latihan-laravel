<x-layout>
	<h1 class="font-bold text-center text-4xl mb-8">Sunting Blog</h1>

	<x-forms.form action="#">
		<x-forms.input label="Judul" name="title" />

		<x-forms.field label="Isi Blog" name="body" >
			<textarea name="body" id="body" class="w-full px-3 py-2 border border-gray-400 focus:outline-none focus:border-laravel rounded" rows="10"></textarea>
		</x-forms.field>
		
		@php
			$tags = ['Travel', 'Kuliner', 'Fashion', 'Hobi', 'Film', 'Musik', 'Game', 'Motivasi', 'Tips Belajar', 'Pendidikan', 'Karir', 'Info Menarik']
		@endphp

		<x-forms.field label="Pilih Tag (maksimal 5)" name="tag">
			<x-forms.tags :$tags />
		</x-forms.field>

		<div class="flex flex-wrap justify-end">
			<x-forms.button>Kirim</x-forms.button>
		</div>
	</x-forms.form>
</x-layout>