@php
	$classes = 'p-4 bg-antique-white rounded-xl';
@endphp

<article {{ $attributes(['class' => $classes]) }}>
	{{ $slot }}
</article>
