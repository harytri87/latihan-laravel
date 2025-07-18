@props(['tags'])

<div class="flex flex-row flex-wrap gap-x-4 gap-y-2">
	@foreach ($tags as $index => $tag)
		<div>
			<input
				class="tag-checkbox"
				id="tag-{{ $index }}"
				name="tags[]"
				type="checkbox"
				value="{{ $tag }}"
			/>
			<label for="tag-{{ $index }}">{{ $tag }}</label>
		</div>
	@endforeach
</div>

<script>
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
