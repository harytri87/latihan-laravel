<x-layout>
	<h1 class="font-bold text-center text-4xl mb-8">Hasil Pencarian: {{ request('q') ?? '' }}</h1>

	<div class="space-y-10">
		@if ($blogs->count())
			<section class="flex gap-12 divide-gray-300">
				@if (request('u'))
					<div class="flex items-center gap-3">
						<x-profile-picture size="medium" :picture="session()->get('profilePic')" />

						<div class="flex flex-col">
							<span class="font-bold text-xl">Blog Oleh:</span>
							<span class="text-tulisan text-lg">{{ session()->get('authorName') }}</span>
						</div>
					</div>
				@endif

				@if (request('t'))
					<div class="flex items-center gap-3">
						<div class="flex flex-col">
							<span class="font-bold text-xl">Tag:</span>
							<span class="text-tulisan text-lg">{{ session()->get('tagName') }}</span>
						</div>
					</div>
				@endif
			</section>

			<section class="space-y-6">
				@foreach ($blogs as $blog)
					<x-blog-card :$blog />
				@endforeach
			</section>

			<section>
				{{ $blogs->links() }}
			</section>
		@else
			<p class="text-center text-2xl">Tidak ada hasil yang cocok.</p>
		@endif
	</div>
</x-layout>