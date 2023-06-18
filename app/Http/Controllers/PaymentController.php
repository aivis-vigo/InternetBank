<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(): View
    {
        return view('auth.payment.payment');
    }

    public function validateTransaction(): View
    {
        request()->validate([
            'card_number' => ['string', 'min:16', 'max:16', 'required'],
            'expire_date' => ['string', 'min:5', 'max:5', 'required'],
            'card_cvc' => ['string', 'min:3', 'max:3', 'required'],
            'amount' => ['string', 'min:1', 'required'],
            'receiver_name' => ['string', 'min:3', 'max:255', 'required'],
            'receiver_card_number' => ['string', 'min:16', 'max:16', 'required']
        ]);

        $customer = DB::table('bankCards');
        $transactionRequest = (object)request()->all();

        // Selects card for transaction
        $customerCard = $customer->select('*')->where('card_number', $transactionRequest->receiver_card_number)->first();

        if (!empty($customerCard)) {
            $amount = (int)($transactionRequest->amount * 100);
            $balanceUpdate = (int)$customerCard->balance - $amount;
            DB::update('update bankCards set balance = ? where card_number = ?', [$balanceUpdate, $transactionRequest->card_number]);

            // Select users card
            $userCards = DB::table('bankCards')->where('user_id', Auth::user()->getAuthIdentifier())->get();
            $cardID = $userCards[0]->id;

            // Register transaction info for card
            DB::table('cardHistory')->insert([
                'card_id' => $cardID,
                'transaction_name' => $transactionRequest->receiver_name,
                'transaction_amount' => (int)($transactionRequest->amount * 100),
                'created_at' => Carbon::now()->toDateTimeString()
            ]);

            $message = 'Transaction successful!';
        } else {
            $message = 'Invalid transaction!';
        }

        return view('auth.payment.payment', [
            'message' => $message
        ]);
    }
}
