<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use function request;

class RegisterController extends Controller
{
    public function create(): view
    {
        return view('authorize');
    }

    public function store(): void
    {
        request()->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:7', 'max:255']
        ]);

        User::create();
    }
}
