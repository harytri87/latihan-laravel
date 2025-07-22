@props(['username', 'name', 'date'])

<div class="text-tulisan">
	<span class="pr-1 mr-1 font-light text-sm border-r">
		<a href="{{ route('blogs.search', ['u' => $username]) }}" class="underline hover:text-laravel">
			Oleh {{ $name }}
		</a>
	</span>

	<time class="font-light text-sm">
		{{ $date }}
	</time>
</div>