<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function login(): View
    {
        return view('auth.login.login');
    }


    public function store(): RedirectResponse
    {
       $attributes = request()->validate([
           'email' => ['required', 'email'],
           'password' => ['required']
       ]);

       if (Auth::attempt($attributes)) {
           return redirect('/dashboard')->with('success', 'Welcome back!');
       }

       throw ValidationException::withMessages([
           'password' => 'Invalid credentials!'
       ]);
    }
}
