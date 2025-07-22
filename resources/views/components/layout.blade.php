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
		<nav class="flex px-6 py-2 justify-between items-center border-b border-laravel">
			<a href="/">
				<img class="h-10" src="{{ asset('images/LaravelLogo.svg') }}" alt="logo">
			</a>

			<form class="w-full max-w-2xl mx-auto space-y-6" action="{{ route('blogs.search') }}">
				<input class="w-full px-4 py-1 border border-gray-400 focus:outline-none focus:border-laravel rounded"
					type="text" name="q" placeholder="Cari blog...">
					
				@if (request('t'))
					<input type="hidden" name="t" value="{{ request('t') }}">
				@endif

				@if (request('u'))
					<input type="hidden" name="u" value="{{ request('u') }}">
				@endif
			</form>

			@auth
				<div class="space-x-6 font-bold flex">
					<a href="{{ route('blogs.create') }}">Tulis Blog</a>

					<details class="relative inline-block">
						<summary class="cursor-pointer inline-flex items-center justify-center">
							Profil
							<svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
								stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
							</svg>
						</summary>

						<div class="absolute right-0 mt-2 w-40 rounded-md bg-white shadow-lg ring-1 ring-raisin-black ring-opacity-5 z-10">
							<a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#">Pengaturan</a>

							<form class="relative block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" method="POST" action="{{ route('logout') }}">
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
				<div class="space-x-6 font-bold">
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
