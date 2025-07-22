<x-layout>
	<x-article-panel>
		<h1 class="font-bold text-4xl mb-2 tracking-wide">
			{{ $blog->title }}
		</h1>

		<x-blog-info
			name="{{ $blog->user->name }}"
			username="{{ $blog->user->username }}"
			date="{{ $blog->formatted_created_at }}"
		/>

		<x-divider class="mt-3 mb-6" />

		<div class="space-y-3">
			{!! nl2br(e($blog->body)) !!}
			{{-- Cek route contoh-string aja biar ngerti --}}
		</div>

		<x-divider class="mt-6 mb-3" />

		<div class="items-center space-x-1">
			@foreach ($blog->tags as $tag)
				<x-tag :$tag size="small" />
			@endforeach
		</div>
	</x-article-panel>


	<div class="flex justify-end gap-3 pt-4">
		<a
			href="{{ route('home') }}"
			class="bg-laravel hover:bg-laravel/85 py-[0.6rem] px-6 text-antique-white font-bold rounded"
		>
			Kembali
		</a>

		@can('edit-destroy-blog', $blog)
			<a
				href="{{ route('blogs.edit', $blog) }}"
				class="bg-laravel hover:bg-laravel/85 py-[0.6rem] px-6 text-antique-white font-bold rounded"
			>
				Sunting
			</a>

			<x-forms.button
				form="delete-form"
				bg="custom"
				class="bg-red-600 hover:bg-red-600/85 cursor-pointer"
			>
				Hapus
			</x-forms.button>
		@endcan
	</div>
	@can('edit-destroy-blog', $blog)
		<form method="POST" action="{{ route('blogs.destroy', $blog) }}" id="delete-form" class="hidden">
			@csrf
			@method('DELETE')
		</form>
	@endcan
</x-layout>