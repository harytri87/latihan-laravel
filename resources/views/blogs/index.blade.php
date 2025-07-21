<x-layout>
	<div class="space-y-10">
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