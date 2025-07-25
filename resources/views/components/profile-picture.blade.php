@props(['size' => 'small', 'picture' => null])

@php
    $classes = 'rounded-full';

    switch ($size) {
        case "big":
            $classes .= ' h-25 w-25';
            break;
        case "medium":
            $classes .= ' h-15 w-15';
            break;
        default:
            $classes .= ' h-8 w-8';
    }

    $displayPicture = $picture 
        ? asset('storage/' . $picture) 
        : asset('images/blank-profile-picture.png');
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    <img
        src="{{ $displayPicture }}"
        class="block h-full w-full object-cover rounded-full"
    >
</div>