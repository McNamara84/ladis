<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdvancedSearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\InputFormDeviceController;
use App\Http\Controllers\InputFormInstitutionController;
use App\Http\Controllers\LegalNoticeController;
use App\Http\Controllers\MaterialInputController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\ProjectInputController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\InstitutionController;

// TODO/Conventions:
// - Prefix all routes for authenticated users with /app
// - Maintain a clear separation between public and private routes
// - Consistently use controller classes for routes (no anonymous functions)
// - Name all routes for consistency
// - Scope routes by logic (e.g. login, logout, password, etc.)
//   - Example: /app -> Index page for authenticated users
//   - Example: /app/user-management -> User management page
// - Decide on the naming convention for routes
//   - Example: /user-management
//   - Example: /inputform_material
// - Decide whether to use /app prefix for account related routes
//   - Current: /password
//   - Example: /app/account/password
// - Apply consistent auth middleware for all routes either in the controller OR in the route definition
//   - Example: User management authentication is handled here
//   - Example: Login authentication is handled at the controller level
//   - Recommendation: Apply auth middleware in routes definition
//     - Centralized in one place
//     - Easy to maintain

// ----------------------------
// Public routes for reguluar pages
// ----------------------------

// Landing page
Route::get('/', [WelcomeController::class, 'index'])->name('frontpage');

// Advanced search
Route::get('/adv-search', [AdvancedSearchController::class, 'index'])->name('advanced_search');
Route::get('/adv-search/result', [SearchController::class, 'search'])->name('search_results');

// Routes for lists
Route::get('/devices/all', [DeviceController::class, 'index'])->name('devices.all');

// TODO: Routes for details pages
// Route::get('/devices/{id}', [InputFormController::class, 'show']);

// Privacy policy
Route::get('/datenschutz', [PrivacyPolicyController::class, 'index'])->name('datenschutz');

// Legal notice
Route::get('/impressum', [LegalNoticeController::class, 'index'])->name('impressum');

// ----------------------------
// Login and logout routes
// ----------------------------

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ----------------------------
// Password reset routes
// ----------------------------

Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// ----------------------------
// Routes for authenticated users
// ----------------------------
// NOTE: These routes redirect to the login page if the user is not authenticated

// Dashboard
// TODO: This is the index page for authenticated users and should be renamed to /app
// NOTE: Authentication is handled in the controller
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    // User management
    Route::get('/user-management', [UserManagementController::class, 'index'])->name('user-management.index');
    Route::get('/user-management/create', [UserManagementController::class, 'create'])->name('user-management.create');
    Route::post('/user-management/create', [UserManagementController::class, 'store'])->name('user-management.store');
    Route::delete('/user-management/{user}', [UserManagementController::class, 'destroy'])->name('user-management.destroy');
    // Routes for devices
    Route::get('/devices/create', [InputFormDeviceController::class, 'index'])->name('inputform.index');
    Route::post('/devices/create', [InputFormDeviceController::class, 'store'])->name('inputform.store');
    Route::delete('/devices/{device}', [DeviceController::class, 'destroy'])->name('devices.destroy');
    // Routes for institutions
    Route::get('/institutions/create', [InputFormInstitutionController::class, 'index'])->name('inputform_institution.index');
    Route::post('/institutions/create', [InputFormInstitutionController::class, 'store'])->name('inputform_institution.store');
    Route::delete('/institutions/{institution}', [InstitutionController::class, 'destroy'])->name('institutions.destroy');
});

// Material management
Route::get('/inputform_material', [MaterialInputController::class, 'index'])->name('inputform_material.index');
Route::post('/inputform_material', [MaterialInputController::class, 'store'])->name('inputform_material.store');

// Project management
Route::get('/inputform_project', [ProjectInputController::class, 'index'])->name('projects.index');

// Institution overview lists
Route::get('/institutions/manufacturers/all', [InstitutionController::class, 'index'])->defaults('category', 'manufacturers')->name('institutions.manufacturers');
Route::get('/institutions/clients/all', [InstitutionController::class, 'index'])->defaults('category', 'clients')->name('institutions.clients');
Route::get('/institutions/contractors/all', [InstitutionController::class, 'index'])->defaults('category', 'contractors')->name('institutions.contractors');
