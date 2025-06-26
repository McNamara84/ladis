<?php

use App\Http\Controllers\AdvancedSearchController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\InputFormController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PrivacyPolicyController;

// Landing page for guests
Route::get('/', [WelcomeController::class, 'index']);

// Publicly accessible advanced search
Route::get('/advanced_search', [AdvancedSearchController::class, 'index'])->name('advanced_search');

// Login page with route name login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Routes for user with authentication
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/user-management', [UserManagementController::class, 'index'])->name('user-management');
Route::get('/user-management/create', [UserManagementController::class, 'create'])->name('user-management.create');

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
