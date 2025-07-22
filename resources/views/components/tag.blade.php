@props(['tag', 'size' => 'base'])

@php
	$classes = 'bg-raisin-black hover:bg-antique-white text-antique-white hover:text-raisin-black s rounded-xl font-bold transition-colors duration-300';

	if ($size === 'base') {
		$classes .= ' px-5 py-1 text-sm';
	}

	if ($size === 'small') {
		$classes .= ' px-3 py-1 text-2xs';
	}
@endphp

<a href="{{ route('blogs.search', ['t' => $tag->slug]) }}" class="{{ $classes }}">{{ $tag->name }}</a>