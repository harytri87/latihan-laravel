<x-layout>
	@if (session('status') !== null)
		<x-status-notif class="mb-6" info="{{ session('info') }}">{{ session('msg') }}</x-status-notif>
	@endif

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

			<x-forms.delete-confirmation route="blogs.destroy" :data="$blog">
				Hapus
			</x-forms.delete-confirmation>
		@endcan
	</div>
</x-layout>