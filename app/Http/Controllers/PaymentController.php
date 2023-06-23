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

        // Selects customers for transaction
        $customer = $customer->select('*')->whereIn('card_number', [
            $transactionRequest->card_number, $transactionRequest->receiver_card_number
        ])->get();

        if (!(count($customer) == 2)) {
            $message = 'Invalid transaction!';
        } else {
            $amount = (int)($transactionRequest->amount * 100);

            // Subtract
            DB::update('update bankCards set balance = balance - ? where card_number = ?', [
                $amount,
                $transactionRequest->card_number
            ]);
            // Add
            DB::update('update bankCards set balance = balance + ? where card_number = ?', [
                $amount,
                $transactionRequest->receiver_card_number
            ]);

            // Select users card
            $userCards = DB::table('bankCards')->where('user_id', Auth::user()->getAuthIdentifier())->first('user_id');
            // Receiver card
            $receiver = DB::table('bankCards')->where('card_number', $transactionRequest->receiver_card_number)->first('user_id');

            // Register transaction info for card
            DB::table('cardHistory')->insert([
                // Initiator
                [
                    'card_id' => $userCards->user_id,
                    'transaction_name' => $transactionRequest->receiver_name,
                    'transaction_amount' => -(int)($transactionRequest->amount * 100),
                    'created_at' => Carbon::now()->toDateTimeString()
                ],
                // Receiver
                [
                    'card_id' => $receiver->user_id,
                    'transaction_name' => Auth::user()->name,
                    'transaction_amount' => +(int)($transactionRequest->amount * 100),
                    'created_at' => Carbon::now()->toDateTimeString()
                ]
            ]);

            $message = 'Transaction successful!';
        }

        return view('auth.payment.payment', [
            'message' => $message
        ]);
    }
}
