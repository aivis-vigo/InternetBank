<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        /**
        if (Session::exists('name')) {
            //var_dump(Session::all());
        }
        */

        return view('home', [
            'content' => DB::table('users')->get()
        ]);
    }
}
