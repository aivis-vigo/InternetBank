<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $transactions = [];
        $customerId = Auth::user()->getAuthIdentifier();
        $account = DB::table('bankCards')->where('user_id', Auth::user()->getAuthIdentifier())->first();
        $accountCards = DB::table('bankCards')->where('user_id', Auth::user()->getAuthIdentifier())->get();
        $transactionHistory = DB::table('cardHistory')->where('card_id', $customerId)->get();

        foreach ($transactionHistory as $transaction) {
            $transactions[] = $transaction;
        }

        return view('auth.dashboard', [
            'account' => $account,
            'cards' => $accountCards,
            'history' => $transactions
        ]);
    }
}
