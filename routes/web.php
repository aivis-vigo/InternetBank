<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home
Route::get('/', [UserController::class, 'index']);

// Login
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    // Register
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Payment
    Route::get('/payment', [PaymentController::class, 'index']);
    Route::post('/payment/validate', [PaymentController::class, 'validateTransaction']);

    //Cards
    Route::get('/cards', [CardController::class, 'index']);

    // Settings
    Route::get('/settings', [UserController::class, 'show']);
    Route::get('/add-card', [CardController::class, 'add']);
    Route::post('/add-card', [CardController::class, 'save']);

    // Profile
    Route::get('/profile/edit', [UserController::class, 'editUserInfo']);
    Route::post('/profile/update', [UserController::class, 'update']);

    // Logout
    Route::get('/logout', [LogoutController::class, 'logout']);
});
