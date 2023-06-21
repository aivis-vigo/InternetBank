<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class InvestmentController extends Controller
{
    public function index(): View
    {
        return view('auth.invest.invest');
    }
}
