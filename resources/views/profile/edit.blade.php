
<x-layout>
	<h1 class="font-bold text-center text-4xl mb-8">Ubah Data Profil</h1>

	@if (session('status') === 'profile-updated')
		<x-status-notif>Data berhasil diubah</x-status-notif>
	@endif

	<x-forms.form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
		@csrf
		@method('PATCH')

		<x-forms.input label="Nama" name="name" value="{{ $user->name }}" required />
		<x-forms.input label="Username" name="username" value="{{ $user->username }}" required />
		
		<x-divider class="w-1/2 mx-auto" />

		<p class="font-bold">Biarkan kosong bila tidak ingin mengubahnya.</p>

		<x-forms.input label="Kata Sandi" name="password" type="password" />
		<x-forms.input label="Ulangi Kata Sandi" name="password_confirmation" type="password" />
		<x-forms.input-picture :picture="$user->picture" />

		<x-forms.button type="submit">Ubah</x-forms.button>
	</x-forms.form>

	<div class="max-w-2xl mx-6 sm:mx-auto mt-10">
		
		<x-divider class="mb-4" />

		<x-forms.label label="Hapus Akun" name="hapus-akun" />
		<p class="mb-3">
			Peringatan! Akun yang dihapus tidak dapat dipulihkan dan Semua data yang bersangkutan dengan akun Anda akan ikut terhapus.
		</p>

		<x-forms.delete-confirmation route="profile.destroy">
			Hapus Akun
		</x-forms.delete-confirmation>
	</div>
</x-layout>