<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\Coin;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * InvestmentController
 *
 * This controller handles investment-related functionality.
 */
class InvestmentController extends Controller
{
    /**
     * Display the investment index page.
     *
     * @return View
     */
    public function index(): View
    {
        $account = Accounts::query()->where('account_id', Auth::user()->id)->get();
        $coins = Coin::query()->select('*')->where('account_id', Auth::user()->id)->get();

        return view(
            'auth.invest.invest', [
                'account' => $account[0],
                'coins' => $coins
            ]
        );
    }
}
