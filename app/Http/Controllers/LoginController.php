<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * LoginController
 *
 * This controller handles user login functionality.
 */
class LoginController extends Controller
{
    /**
     * Display the login page.
     *
     * @return View
     */
    public function login(): View
    {
        return view('auth.login.login');
    }

    /**
     * Process the login request.
     *
     * @return RedirectResponse
     *
     * @throws ValidationException
     */
    public function store(): RedirectResponse
    {
        $attributes = request()->validate(
            [
            'email' => ['required', 'email'],
            'password' => ['required']
            ]
        );

        if (Auth::attempt($attributes)) {
            return redirect('/dashboard')->with('success', 'Welcome back!');
        }

        throw ValidationException::withMessages(
            [
            'password' => 'Invalid credentials!'
            ]
        );
    }
}
