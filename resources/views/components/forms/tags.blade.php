@props(['tags', 'selectedTags' => []])

<div class="flex flex-row flex-wrap gap-x-4 gap-y-2">
	@foreach ($tags as $tag)
		<div>
			<input
				class="tag-checkbox"
				id="tag-{{ $tag->id }}"
				name="tags[]"
				type="checkbox"
				value="{{ $tag->slug }}"
				{{ in_array($tag->slug, old('tags', $selectedTags)) ? 'checked' : '' }}
			/>
			<label for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
		</div>
	@endforeach
</div>

<span id="error" class="text-sm text-red-500 mt-1 hidden">Pilih minimal satu tag.</span>

<script>
	// Maksimal 5 checkbox
	const maxAllowed = 5;
	const checkboxes = document.querySelectorAll('.tag-checkbox');

	checkboxes.forEach(checkbox => {
		checkbox.addEventListener('change', function() {
			const checkedCount = document.querySelectorAll('.tag-checkbox:checked').length;

			if (checkedCount > maxAllowed) {
				this.checked = false;
			}
		});
	});
</script>
