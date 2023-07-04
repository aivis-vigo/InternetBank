<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

/**
 * LogoutController
 *
 * This controller handles user logout functionality.
 *
 * @author Display Name <username@example.com>
 */
class LogoutController extends Controller
{
    /**
     * Perform user logout.
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect('/login')->with('success', 'Goodbye!');
    }
}
