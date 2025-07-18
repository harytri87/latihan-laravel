@props(['label', 'name'])

@php
	$defaults = [
		'type' => 'text',
		'id' => $name,
		'name' => $name,
		'class' => 'w-full px-3 py-2 border border-gray-400 focus:outline-none focus:border-laravel rounded',
		'value' => ''
	];
@endphp

<x-forms.field :$label :$name>
	<input {{ $attributes($defaults) }} />
</x-forms.field>