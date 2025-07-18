@props(['label', 'name'])

<div class="inline-flex mb-2 items-center gap-x-2">
	<span class="w-2 h-2 bg-laravel inline-block"></span>
	<label class="font-bold" for="{{ $name }}">{{ $label }}</label>
</div>