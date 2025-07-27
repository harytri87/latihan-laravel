<form class="w-full max-w-xl mx-auto" action="{{ route('blogs.search') }}" id="search-form">
	<div class="relative w-full">
		<input
			class="w-full px-4 py-1 border border-gray-400 focus:outline-none focus:border-laravel rounded" name="q"
			type="text" placeholder="Cari blog..."
			value="{{ request('q') ?? '' }}"
		>

		<a class="absolute right-2 top-1/2 -translate-y-1/2 text-2xl hover:text-laravel" href="{{ route('home') }}">&times;</a>
	</div>

	@if (request('t'))
		<input name="t" type="hidden" value="{{ request('t') }}">
	@endif

	@if (request('u'))
		<input name="u" type="hidden" value="{{ request('u') }}">
	@endif
</form>