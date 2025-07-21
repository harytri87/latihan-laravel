<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::controller(BlogController::class)->group(function () {
	// Bisa diakses semua orang
	Route::get('/', 'index')->name('home');
	Route::get('blogs', 'index')->name('home');

	// Biar penamaan lebih simple. Tapi kalo sekiranya terlalu banyak nested, bisa dihapus aja, manual kasih nama yg lengkap
	Route::name('blogs.')->group(function () {
		// Urutannya harus gini, jadi middleware authnya masing-masing
		Route::get('blogs/create', 'create')->middleware('auth')->name('create');
		Route::get('blogs/{blog:slug}', 'show')->name('show');
		Route::post('blogs', 'store')->name('store')->middleware('auth');

		// Harus login & bener yg punya blognya aja
		Route::middleware('auth', 'can:edit-destroy-blog,blog')->group(function () {
			Route::get('blogs/{blog:slug}/edit', 'edit')->name('edit');
			Route::patch('blogs/{blog}', 'update')->name('update');
			Route::delete('blogs/{blog}', 'destroy')->name('destroy');
		});
	});
});

Route::middleware('guest')->group(function () {
	Route::get('register', [RegisteredUserController::class, 'create'])
		->name('register');

	Route::post('register', [RegisteredUserController::class, 'store']);

	Route::get('login', [SessionController::class, 'create'])
		->name('login');

	Route::post('login', [SessionController::class, 'store']);
});

Route::delete('logout', [SessionController::class, 'destroy'])
	->middleware('auth')
	->name('logout');


Route::get('contoh-string', function () {
	return view('contoh');
});
