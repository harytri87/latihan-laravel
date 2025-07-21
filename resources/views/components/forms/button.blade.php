@props(['bg' => 'default'])

@php
	if ($bg === 'default') {
		$classes = 'bg-laravel hover:bg-laravel/85 py-2 px-6 text-antique-white font-bold rounded';
	} else {
		$classes = "py-2 px-6 text-antique-white font-bold rounded";
	}
@endphp

<button {{ $attributes(['class' => $classes]) }}>{{ $slot }}</button>
