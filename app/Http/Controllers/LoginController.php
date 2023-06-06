<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function login(): View
    {
        return view('auth.login');
    }


    public function store()
    {
       $attributes = request()->validate([
           'email' => ['required', 'email'],
           'password' => ['required']
       ]);

       if (auth()->attempt($attributes)) {
           return redirect('/')->with('success', 'Welcome back!');
       }

       throw ValidationException::withMessages([
           'password' => 'Invalid credentials!'
       ]);
    }
}
