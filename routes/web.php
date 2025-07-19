<?php

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('blogs.index');
})->name('home');

Route::get('/blogs', function () {
	return view('blogs.show');
});

Route::get('/blogs/create', function () {
	return view('blogs.create');
});

Route::get('/blogs/edit', function () {
	return view('blogs.edit');
});

Route::middleware('guest')->group(function () {
	Route::get('register', [RegisteredUserController::class, 'create'])
		->name('register');

	Route::post('register', [RegisteredUserController::class, 'store']);

	Route::get('login', [SessionController::class, 'create'])
		->name('login');

	Route::post('login', [SessionController::class, 'store']);
});

Route::delete('/logout', [SessionController::class, 'destroy'])
	->middleware('auth')
	->name('logout');
