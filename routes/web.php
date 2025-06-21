<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InputFormController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DatenschutzController;
use App\Http\Controllers\PrivacyPolicyController;

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
Route::get('/datenschutz', [PrivacyPolicyController::class, 'index'])->name('datenschutz');

Route::get('/inputform', [InputFormController::class, 'index']);

// TODO: Setup authentication
// Route for inputform with authentication

// Route::middleware(['auth'])->group(function () {
//    Route::get('/inputform', [InputFormController::class, 'index']);
//});

//Route for inputform without authentication
Route::get('/inputform', [InputFormController::class, 'index']);

