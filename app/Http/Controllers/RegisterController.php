<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use function redirect;
use function request;

/**
 * RegisterController
 *
 * This controller handles user registration functionality.
 */
class RegisterController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return View
     */
    public function create(): view
    {
        return view('auth.register.register');
    }

    /**
     * Store a newly created user.
     *
     * @return RedirectResponse
     */
    public function store(): RedirectResponse
    {
        $attributes = request()->validate(
            [
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'min:7', 'max:255'],
            'confirm-password' => ['required', 'min:7', 'max:255', 'required_with:password', 'same:password']
            ]
        );

        $user = User::create($attributes);

        Auth::login($user);

        return redirect('/')->with('success', 'Successfully created');
    }
}
