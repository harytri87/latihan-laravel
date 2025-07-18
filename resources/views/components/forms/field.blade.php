@props(['label', 'name'])

<div>
	<x-forms.label :$label :$name />

	<div>
		{{ $slot }}

		<x-forms.error />
	</div>
</div>