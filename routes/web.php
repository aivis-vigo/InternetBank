<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $users = new UserController();

    return view('home', [
        'content' => $users->index()
    ]);
});

Route::get('/register', function () {
   return view('authorize', []);
});

Route::resource('articles', UserController::class);
