<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(): View
    {
        return view('auth.payment.payment');
    }

    public function validateTransaction()
    {
        $attributes = request()->validate([
            'card_number' => ['string', 'min:16', 'max:16', 'required'],
            'expire_date' => ['string', 'min:5', 'max:5', 'required'],
            'card_cvc' => ['string', 'min:3', 'max:3', 'required'],
            'receiver_name' => ['string', 'min:3', 'max:255', 'required'],
            'receiver_card_number' => ['string', 'min:16', 'max:16', 'required'],
        ]);

        var_dump('validation');die;
    }

}
