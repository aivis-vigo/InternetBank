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

        $account = DB::table('bankAccounts')->where('account_id', Auth::user()->id)->first();
        $transactionHistory = DB::table('accountHistory')->where('account_id', Auth::user()->id)->get();

        foreach ($transactionHistory as $transaction) {
            $transactions[] = $transaction;
        }

        return view('auth.dashboard', [
            'accounts' => $account,
            'history' => $transactions
        ]);
    }
}
