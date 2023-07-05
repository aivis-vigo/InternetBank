<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Carbon\Carbon;
use IbanApi\Api;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

/**
 * Validate and process a transaction.
 *
 * @return View
 */
class PaymentController extends Controller
{
    public function index(): View
    {
        // todo: optimize iban line
        return view('auth.payment.payment', [
            'name' => Auth::user()->name,
            'iban' => Account::query()->where('account_id', Auth::user()->id)->first('iban')->iban
        ]);
    }

    public function validateTransaction(): RedirectResponse
    {
        request()->validate(
            [
                'name' => ['string', 'min:3', 'max:50', 'required'],
                'amount' => ['string', 'min:1', 'required'],
                'iban_number' => ['string', 'min:16', 'max:30', 'required'],
                'receiver_name' => ['string', 'min:3', 'max:50', 'required'],
                'receiver_iban_number' => ['string', 'min:16', 'max:30', 'required']
            ]
        );

        $transactionRequest = (object)request()->all();

        // Selects customers for transaction
        $customer = DB::table('bankAccounts')->select('*')->whereIn(
            'IBAN', [
                $transactionRequest->iban_number, $transactionRequest->receiver_iban_number
            ]
        )->get();

        if (!(count($customer) == 2)) {
            $message = 'Invalid transaction!';
        } else {
            $amount = (int)($transactionRequest->amount * 100);

            // todo: convert with current exchange rate if different currencies

            DB::update(
                'update bankAccounts set balance = balance - ? where IBAN = ?', [
                    $amount,
                    $transactionRequest->iban_number
                ]
            );
            DB::update(
                'update bankAccounts set balance = balance + ? where IBAN = ?', [
                    $amount,
                    $transactionRequest->receiver_iban_number
                ]
            );

            // Select users account
            $userCards = Auth::user()->id;
            // Receiver account
            $receiver = DB::table('bankAccounts')->where('IBAN', $transactionRequest->receiver_iban_number)->first('account_id');

            // todo: DB replace with correct relationship
            // Register transaction info for account
            DB::table('accountHistory')->insert(
                [
                    // Initiator
                    [
                        'account_id' => $userCards,
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
                ]
            );

            // todo: display animated status message
            $message = 'Transaction successful!';
        }

        return redirect('/dashboard');
    }
}
