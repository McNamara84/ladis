<?php

use App\Http\Controllers\AdvancedSearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\InputFormController;

// Landing page for guests
Route::get('/', [WelcomeController::class, 'index']);

// Publicly accessible advanced search
Route::get('/advanced_search', [AdvancedSearchController::class, 'index'])->name('advanced_search');

// Login page with route name login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
// Registration page with route name register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Routes for user with authentication
Route::get('/home', [HomeController::class, 'index'])->name('home');

// TODO: Setup authentication
// Route for inputform with authentication

// Route::middleware(['auth'])->group(function () {
//    Route::get('/inputform', [InputFormController::class, 'index']);
//});

// GET route for inputform without authentication
Route::get('/inputform', [InputFormController::class, 'index'])->name('inputform.index');
// POST route for inputform submission
Route::post('/inputform', [InputFormController::class, 'store'])->name('inputform.store');
