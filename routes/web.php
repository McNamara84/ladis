<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InputFormController;
use Illuminate\Support\Facades\Auth;

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

// Route for the Datenschutz (Data Protection) page
Route::get('/datenschutz', [App\Http\Controllers\DatenschutzController::class, 'index'])->name('datenschutz');

Route::get('/inputform', [InputFormController::class, 'index']);
