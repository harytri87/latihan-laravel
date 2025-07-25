@props(['info' => 'success'])

@php
    $classes = 'relative flex h-10 max-w-xs items-center justify-center mx-auto font-bold rounded';
    switch ($info) {
        case "danger":
            $classes .= ' border border-red-500';
            break;
        case "alert":
            $classes .= ' border border-yellow-500';
            break;
        default:
            $classes .= ' border border-green-500';
    }
@endphp

<div id="notif" {{ $attributes->merge(['class' => $classes]) }}>
    <button
		class="absolute top-0 right-0 flex items-center justify-center m-0 pt-[1px] w-4 h-4 font-light text-2xl hover:text-laravel"
		data-close-modal="notif"
	>
		&times;
	</button>

    <p>{{ $slot }}</p>
</div>

{{-- Nutupnya pake javascript resources\js\components\modal.js --}}