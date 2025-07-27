@props(['username', 'name', 'date'])

<div class="text-tulisan">
	<span class="pr-1 mr-1 font-light text-sm border-r">
		<button
			type="button"
			data-search-key="u"
			data-search-value="{{ $username }}"
			class="underline hover:text-laravel cursor-pointer"
		>Oleh {{ $name }}</button>
	</span>

	<time class="font-light text-sm">
		{{ $date }}
	</time>
</div>