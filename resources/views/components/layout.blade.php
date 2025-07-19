<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Blog</title>

	<link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.bunny.net">
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

			<form action="" class="w-full max-w-2xl mx-auto space-y-6">
				<input type="text" placeholder="Cari blog..." class="w-full px-4 py-1 border border-gray-400 focus:outline-none focus:border-laravel rounded">
			</form>

			@auth
				<div class="space-x-6 font-bold flex">
					<form method="POST" action="/logout">
						@csrf
						@method('DELETE')

						<button class="cursor-pointer">Log Out</button>
					</form>
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