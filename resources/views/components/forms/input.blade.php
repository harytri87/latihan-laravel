@props([
	'label',
	'name',
	'value' => null,
])

@php
	$defaults = [
		'id' => $name,
		'name' => $name,
		'class' => 'w-full px-3 py-2 border border-gray-400 focus:outline-none focus:border-laravel rounded',
        'value' => old($name, $value)
	];
@endphp

<x-forms.field :$label :$name>
	<input {{ $attributes->merge($defaults) }} />
</x-forms.field>