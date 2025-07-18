@props(['title', 'author', 'date'])

<x-article-panel class="relative space-y-3">
	<div class="flex flex-row flex-wrap items-center justify-between">
		<div>
			<h3 class="font-bold text-xl tracking-wide">
				<a href="/blogs">
					<span class="absolute inset-0"></span>
					{{ $title }}
				</a>
			</h3>

			<span class="pr-1 mr-1 font-light text-tulisan text-sm border-r">
				Oleh {{ $author }}
			</span>

			<time class="font-light text-tulisan text-sm">
				{{ $date }}
			</time>
		</div>

		<div class="items-center space-x-1">
			<x-tag tag="Info Menarik" size="small" />
			<x-tag tag="Travel" size="small" />
			<x-tag tag="Hobi" size="small" />
		</div>
	</div>

	<x-divider />

	<p>
		Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem magnam accusamus inventore nam quod dolorem labore earum,
		ducimus impedit facere ut error ad. Dignissimos nisi praesentium ad eius distinctio? Sit!
	</p>
</x-article-panel>
