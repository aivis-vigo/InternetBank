<?php

namespace App\Http\Controllers;

use App\Models\Account;
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

        // todo: generate unique or handle case
        Account::create(
            [
                'account_id' => Auth::user()->getAuthIdentifier(),
                'balance' => 0,
                'IBAN' => $this->generateNonRepeatingRandomNumber(),
                'currency_code' => "EUR"
            ]
        );

        return redirect('/dashboard')->with('success', 'Successfully created');
    }

    /**
     * Generate a non-repeating random number.
     *
     * @return string
     */
    private function generateNonRepeatingRandomNumber(): string
    {
        $min = 10000000;
        $max = 99999999;
        $count = 1;

        $numbers = range($min, $max);
        $iban = 0;

        for ($i = 0; $i < $count; $i++) {
            $randomIndex = mt_rand(0, count($numbers) - 1);
            $randomNumber = $numbers[$randomIndex];
            array_splice($numbers, $randomIndex, 1);
            $iban = $randomNumber;
        }

        return "LV09HABA05510" . $iban;
    }
}
