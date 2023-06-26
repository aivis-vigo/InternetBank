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
        $account = DB::table('bankAccounts')->where('account_id', Auth::user()->getAuthIdentifier())->first();
        $accountCards = DB::table('bankAccounts')->where('account_id', Auth::user()->getAuthIdentifier())->get();
        $transactionHistory = DB::table('accountHistory')->where('account_id', $customerId)->get();

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
