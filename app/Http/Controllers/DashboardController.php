<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $userId = Auth::user()->getAuthIdentifier();
        $cards = DB::table('bankCards')->where('user_id', $userId)->get();
        $history = $cards[0]->history;

        if (!empty($history)) {
            $transactions = explode('.', $history);
        } else {
            $transactions = [];
        }

        return view('auth.dashboard', [
            'cards' => $cards,
            'history' => $transactions
        ]);
    }
}
