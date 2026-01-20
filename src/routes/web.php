<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
return view('dashboard.index');
})->name('dashboard');


Route::get('/profile', function () {
return view('dashboard.profile');
})->name('profile');

Route::view('/login','auth.login')->name('login');
Route::view('/register','auth.register');
Route::view('/forgot-password','auth.forgot-password');
Route::view('/reset-password','auth.reset-password');
