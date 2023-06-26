<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use IbanApi\Api;
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
            'name' => ['string', 'min:3', 'max:50', 'required'],
            'amount' => ['string', 'min:1', 'required'],
            'iban_number' => ['string', 'min:16', 'max:30', 'required'],
            'receiver_name' => ['string', 'min:3', 'max:50', 'required'],
            'receiver_iban_number' => ['string', 'min:16', 'max:30', 'required']
        ]);

        $transactionRequest = (object)request()->all();

        // Selects customers for transaction
        $customer = DB::table('bankAccounts')->select('*')->whereIn('IBAN', [
            $transactionRequest->iban_number, $transactionRequest->receiver_iban_number
        ])->get();

        if (!(count($customer) == 2)) {
            $message = 'Invalid transaction!';
        } else {
            $amount = (int)($transactionRequest->amount * 100);

            // Todo: convert with current exchange rate if different currencies
            echo "<pre>";
            var_dump($this->validateIban('ST74227883929725917485135')->data->currency_code);
            echo "</pre>";

            DB::update('update bankAccounts set balance = balance - ? where IBAN = ?', [
                $amount,
                $transactionRequest->iban_number
            ]);
            DB::update('update bankAccounts set balance = balance + ? where IBAN = ?', [
                $amount,
                $transactionRequest->receiver_iban_number
            ]);

            // Select users account
            $userCards = DB::table('bankAccounts')->where('account_id', Auth::user()->getAuthIdentifier())->first('account_id');
            // Receiver account
            $receiver = DB::table('bankAccounts')->where('IBAN', $transactionRequest->receiver_iban_number)->first('account_id');

            // Register transaction info for card
            DB::table('accountHistory')->insert([
                // Initiator
                [
                    'account_id' => $userCards->account_id,
                    'transaction_name' => $transactionRequest->receiver_name,
                    'transaction_amount' => -(int)($transactionRequest->amount * 100),
                    'created_at' => Carbon::now()->toDateTimeString()
                ],
                // Receiver
                [
                    'account_id' => $receiver->account_id,
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

    private function validateIban(string $iban)
    {
        $result = (new Api($_ENV['VALIDATE_IBAN']))->validateIBANBasic($iban);
        $response = json_decode($result);

        return $response;//$response->message;
    }
}
