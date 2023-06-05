<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class LoginController extends Controller
{
    public function login(): View
    {
        return view('login', []);
    }
}
