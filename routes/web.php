<?php

use App\Http\Controllers\AdvancedSearchController;
use App\Http\Controllers\ArtifactInputController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\InputFormController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ProjectInputController;
use App\Http\Controllers\MaterialInputController;

// Landing page for guests
Route::get('/', [WelcomeController::class, 'index']);

// Publicly accessible advanced search
Route::get('/adv-search', [AdvancedSearchController::class, 'index'])->name('advanced_search');
Route::get('/adv-search/result', [SearchController::class, 'search'])->name('search_results');

// Login page with route name login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Routes for user with authentication
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function () {
    Route::get('/user-management', [UserManagementController::class, 'index'])->name('user-management.index');
    Route::get('/user-management/create', [UserManagementController::class, 'create'])->name('user-management.create');
    Route::post('/user-management/create', [UserManagementController::class, 'store'])->name('user-management.store');
    Route::delete('/user-management/{user}', [UserManagementController::class, 'destroy'])->name('user-management.destroy');
});
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Route for the Datenschutz (Data Protection) page
Route::get('/datenschutz', [PrivacyPolicyController::class, 'index'])->name('datenschutz');


// TODO: Setup authentication
// Route for inputform with authentication

// Route::middleware(['auth'])->group(function () {
//    Route::get('/inputform', [InputFormController::class, 'index']);
//});


//Route for inputform without authentication
Route::get('/inputform', [InputFormController::class, 'index']);


// Route for the inputform project without authentication
Route::get('/inputform_project', [ProjectInputController::class, 'index']);

//Route for inputform for the materials
Route::get('/inputform_material', [MaterialInputController::class, 'index'])->name('inputform_material.index');
Route::post('/inputform_material', [MaterialInputController::class, 'store'])->name('inputform_material.store');

// Route for inputform for the artifacts
Route::get('/inputform_artifact', [ArtifactInputController::class, 'index'])->name('inputform_artifact.index');
Route::post('/inputform_artifact', [ArtifactInputController::class, 'store'])->name('inputform_artifact.store');
