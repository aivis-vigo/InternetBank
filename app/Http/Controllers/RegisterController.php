<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use PragmaRX\Google2FA\Google2FA;
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
        $attributes = (object)request()->validate(
            [
                'name' => ['required', 'min:3', 'max:255'],
                'email' => ['required', 'max:255', Rule::unique('users', 'email')],
                'password' => ['required', 'min:7', 'max:255'],
                'confirm-password' => ['required', 'min:7', 'max:255', 'required_with:password', 'same:password']
            ]
        );

        $google2fa = app('pragmarx.google2fa');

        $user = User::create([
            'name' => $attributes->name,
            'email' => $attributes->email,
            'password' => Hash::make($attributes->password),
            'google2fa_secret' => $google2fa->generateSecretKey()
        ]);

        Auth::login($user);

        $this->createBankAccount();

        return redirect('/dashboard')->with('success', 'Successfully created');
    }

    private function createBankAccount(): void
    {
        Account::create(
            [
                'account_id' => Auth::user()->getAuthIdentifier(),
                'balance' => 10000,
                'IBAN' => $this->generateNonRepeatingRandomNumber(),
                'currency_code' => "EUR"
            ]
        );
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
