<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(): View
    {
        return view('auth.payment.payment');
    }

    public function validateTransaction()
    {
        request()->validate([
            'card_number' => ['string', 'min:16', 'max:16', 'required'],
            'expire_date' => ['string', 'min:5', 'max:5', 'required'],
            'card_cvc' => ['string', 'min:3', 'max:3', 'required'],
            'receiver_name' => ['string', 'min:3', 'max:255', 'required'],
            'receiver_card_number' => ['string', 'min:16', 'max:16', 'required']
        ]);

        $card = (object)request()->all();

        $cards = DB::table('bankCards')->select('*')->where('card_number', $card->receiver_card_number)->get();
        // 1234123412341234

        if (!empty($cards[0])) {
            $message = 'Transaction successful!';
        } else {
            $message = 'Invalid transaction!';
        }

        return view('auth.payment.payment', [
            'message' => $message
        ]);
    }
}
