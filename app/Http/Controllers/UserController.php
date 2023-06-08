<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function show()
    {
        return view('settings');
    }
}
