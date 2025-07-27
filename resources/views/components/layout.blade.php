<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Blog</title>

	<link type="image/x-icon" href="{{ asset('images/favicon.ico') }}" rel="icon">

	<!-- Fonts -->
	<link href="https://fonts.bunny.net" rel="preconnect">
	<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

	<!-- Styles / Scripts -->
	@vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="min-h-screen bg-utama text-raisin-black tracking-[0.01em]">
	<header>
		<nav class="flex flex-wrap sm:flex-nowrap px-2 lg:px-6 py-2 justify-center sm:justify-between items-center gap-2 border-b border-laravel">
			<a href="/">
				<img class="h-10" src="{{ asset('images/LaravelLogo.svg') }}" alt="logo">
			</a>

			<x-forms.search />

			@auth
				<div class="flex flex-wrap items-center justify-end gap-8 sm:gap-2 lg:gap-4 font-bold">
					<div>
						<a href="{{ route('blogs.create') }}">Tulis Blog</a>
					</div>

					<details class="relative inline-flex items-center">
						<summary class="cursor-pointer inline-flex items-center justify-center gap-1">
							<span>{{ Auth::user()->first_name }}</span>
							<x-profile-picture :picture="Auth::user()->picture" />
						</summary>

						<div class="absolute right-0 top-10 w-34 rounded-md bg-white shadow-lg ring-1 ring-raisin-black ring-opacity-5 z-10">
							<a class="block px-4 py-2 text-sm text-gray-700 rounded-md hover:bg-gray-100"
								href="{{ route('profile.edit') }}">Pengaturan</a>

							<form class="relative block px-4 py-2 text-sm text-gray-700 rounded-md hover:bg-gray-100" method="POST" action="{{ route('logout') }}">
								@csrf
								@method('DELETE')

								<button class="cursor-pointer">
									<span class="absolute inset-0"></span>
									Keluar
								</button>
							</form>
						</div>
					</details>
				</div>
			@endauth

			@guest
				<div class="flex flex-wrap justify-end sm:justify-center lg:justify-end gap-6 sm:gap-3 lg:gap-6 font-bold">
					<a href="{{ route('register') }}">Daftar</a>
					<a href="{{ route('login') }}">Masuk</a>
				</div>
			@endguest
		</nav>
	</header>

	<main class="max-w-[984px] mx-auto py-8">
		{{ $slot }}
	</main>
</body>

</html>
