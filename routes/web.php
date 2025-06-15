<?php

use App\Http\Controllers\AdvancedSearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Landing page for guests
Route::get('/', function () {
    return view('welcome');
});

// Login page with route name login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
// Registration page with route name register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Routes for user with authentication
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/advanced_search', [AdvancedSearchController::class, 'index'])->name('advanced_search');

