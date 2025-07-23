<x-layout>
	<div class="space-y-10">

		@if (session('status') !== null)
			<x-status-notif class="mb-6" info="{{ session('info') }}">{{ session('msg') }}</x-status-notif>
		@endif

		<section class="space-y-6">
			<div class="flex flex-wrap gap-2 justify-start">
				@foreach ($tags as $tag)
					<x-tag :$tag />
				@endforeach
			</div>
		</section>

		<section class="space-y-6">
			@foreach ($blogs as $blog)
				<x-blog-card :$blog />
			@endforeach
		</section>

		<section>
			{{ $blogs->links() }}
		</section>
	</div>
</x-layout>