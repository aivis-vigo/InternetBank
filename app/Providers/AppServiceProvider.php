<?php

namespace App\Providers;

use App\Models\InvestmentAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('invest', function () {
            $accounts = InvestmentAccount::query()->where('user_id', Auth::user()->getAuthIdentifier())->count();
            if ($accounts > 0) {
                return 'aaaa';
            }
        });

        Cashier::calculateTaxes();
    }
}
