<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * UserController
 *
 * This controller handles user-related functionality, such as profile settings and dashboard.
 */
class UserController extends Controller
{
    /**
     * Display the home view.
     *
     * @return View
     */
    public function index(): View
    {
        return view('home');
    }

    /**
     * Display the settings view.
     *
     * @return View
     */
    public function show(): View
    {
        return view('settings');
    }

    /**
     * Display the dashboard view.
     *
     * @return View
     */
    public function dashboard(): View
    {
        return view('auth.dashboard');
    }

    /**
     * Display the user profile information edit view.
     *
     * @return View
     */
    public function editUserInfo(): View
    {
        return view('auth.settings.profile-info');
    }

    /**
     * Update the user information.
     *
     * @return RedirectResponse
     */
    public function update(): RedirectResponse
    {
        request()->validate(
            [
            'name' => ['required', 'min:3', 'string', 'max:255'],
            'email' => ['required', 'email', 'string', 'max:255']
            ]
        );

        $user = Auth::user();
        $request = (object)request()->all();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect('settings');
    }
}
