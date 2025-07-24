@props(['route', 'data' => null])

<x-forms.button class="bg-red-600 hover:bg-red-600/85 cursor-pointer" bg="custom" onclick="openModal()">
	{{ $slot }}
</x-forms.button>

<div class="fixed inset-0 z-50 items-center justify-center bg-black/25 hidden" id="modal">
	<div class="bg-white rounded-2xl shadow-lg max-w-sm w-full p-6">
		<h2 class="text-xl font-semibold text-gray-800 mb-4">Konfirmasi Hapus</h2>
		<p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapusnya?.</p>

		<form
			method="POST"
			@if ($data !== null)
				action="{{ route($route, $data) }}"
			@else
				action="{{ route($route) }}"
			@endif
			class="flex justify-end space-x-3"
		>
			@csrf
			@method('DELETE')

			<button
				class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition"
				onclick="closeModal()"
			>Tidak</button>

			<button
				type="submit"
				class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition cursor-pointer"
			>Ya, Hapus</button>
		</form>
	</div>
</div>

<script>
	function openModal() {
		const modal = document.getElementById('modal');
		modal.classList.add('flex');
		modal.classList.remove('hidden');
	}

	function closeModal() {
		const modal = document.getElementById('modal');
		modal.classList.remove('flex');
		modal.classList.add('hidden');
	}
</script>
