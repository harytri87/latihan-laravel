@props(['tag', 'size' => 'base'])

@php
	$classes =
	    'bg-raisin-black hover:bg-antique-white text-antique-white hover:text-raisin-black s rounded-xl font-bold transition-colors duration-300';

	if ($size === 'base') {
	    $classes .= ' px-5 py-1 text-sm';
	}

	if ($size === 'small') {
	    $classes .= ' px-3 py-1 text-2xs';
	}
@endphp

<a class="{{ $classes }}" href="/tags/{{ strtolower($tag) }}">{{ $tag }}</a>
