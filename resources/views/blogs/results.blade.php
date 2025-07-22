<x-layout>
	<h1 class="font-bold text-center text-4xl mb-8">Hasil Pencarian</h1>
	<div class="space-y-10">
		<section class="space-y-6">
			@forelse ($blogs as $blog)
				<x-blog-card :$blog />
			@empty
				<p class="text-center text-2xl">Tidak ada hasil yang cocok.</p>
			@endforelse
		</section>

		<section>
			{{ $blogs->links() }}
		</section>
	</div>
</x-layout>