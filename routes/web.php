<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('blogs.index');
});

Route::get('/blogs', function () {
    return view('blogs.show');
});

Route::get('/blogs/create', function () {
    return view('blogs.create');
});

Route::get('/blogs/edit', function () {
    return view('blogs.edit');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/login', function () {
    return view('auth.login');
});
