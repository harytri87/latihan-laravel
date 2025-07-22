@props(['blog'])

<x-article-panel class="relative space-y-3">
	<div class="flex flex-row flex-wrap items-center justify-between">
		<div>
			<h3 class="font-bold text-xl tracking-wide">
				<a href="{{ route('blogs.show', $blog->slug) }}">
					{{-- <span class="absolute inset-0"></span> --}}
					{{ $blog->title }}
				</a>
			</h3>

			<x-blog-info
				name="{{ $blog->user->name }}"
				username="{{ $blog->user->username }}"
				date="{{ $blog->formatted_created_at }}"
			/>
		</div>

		<div class="items-center space-x-1">
			@foreach ($blog->tags as $tag)
				<x-tag :$tag size="small" />
			@endforeach
		</div>
	</div>

	<x-divider />

	<p>
		{{ $blog->excerpt }}
		<span class="font-light text-raisin-black/70">
			<a href="{{ route('blogs.show', $blog->slug) }}">
				[baca selengkapnya]
			</a>
		</span>
	</p>
</x-article-panel>
