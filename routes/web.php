<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

// Home
Route::get('/', [UserController::class, 'index']);

// Login
Route::middleware('guest')->group(
    function () {
        // Login
        Route::get('/login', [LoginController::class, 'login'])->name('login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store']);

        // Register
        Route::get('/register', [RegisterController::class, 'create']);
        Route::post('/register', [RegisterController::class, 'store']);
    }
);

Route::middleware('auth')->group(
    function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index']);

        // Payment
        Route::get('/payment', [PaymentController::class, 'index']);
        Route::post('/payment/validate', [PaymentController::class, 'validateTransaction']);
        Route::middleware('invest')->group(
            function () {
                Route::get('/payment-to-investment-account', [PaymentController::class, 'transferView']);
                Route::post('/transfer-to-investment-account', [PaymentController::class, 'transferToInvestment']);
            }
        );

        // Cards
        Route::get('/cards', [CardController::class, 'index']);
        Route::post('/add-card', [CardController::class, 'save']);

        // Invest
        Route::get('/customize-investment-account', [InvestmentController::class, 'customizeAccount']);
        Route::post('/create-investment-account', [InvestmentController::class, 'create']);
        Route::middleware('invest')->group(
            function () {
                Route::get('/invest', [InvestmentController::class, 'index']);
                Route::get('/coins', [CoinController::class, 'index']);
                Route::get('/coin/{id}', function (string $coinID) {
                    return (new CoinController())->show($coinID);
                });
                Route::post('/change-investment-account', [InvestmentController::class, 'changeAccount']);
            }
        );

        // Buy/Sell coins
        Route::post('/buy', [CoinController::class, 'buy']);
        Route::post('/sell/{symbol}', function (string $coinSymbol) {
            return (new CoinController())->sell($coinSymbol);
        });
        Route::post('/sell-all', function (string $coinSymbol) {
            return (new CoinController())->sell($coinSymbol);
        });

        // Settings
        Route::get('/settings', [UserController::class, 'show']);
        Route::get('/add-card', [CardController::class, 'add']);

        // Profile
        Route::get('/profile/edit', [UserController::class, 'editUserInfo']);
        Route::post('/profile/update', [UserController::class, 'update']);

        // Logout
        Route::get('/logout', [LogoutController::class, 'logout']);
    }
);
