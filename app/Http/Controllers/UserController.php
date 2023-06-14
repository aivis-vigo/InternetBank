<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        return view('home');
    }

    public function show(): View
    {
        return view('settings');
    }

    public function dashboard(): View
    {
        return view('auth.dashboard');
    }

    public function editUserInfo(): View
    {
        return view('auth.settings.profile-info');
    }

    public function update(): RedirectResponse
    {
        request()->validate([
            'name' => ['required', 'min:3', 'string', 'max:255'],
            'email' => ['required', 'email', 'string', 'max:255']
        ]);

        $user = Auth::user();
        $request = (object)request()->all();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect('settings');
    }
}
