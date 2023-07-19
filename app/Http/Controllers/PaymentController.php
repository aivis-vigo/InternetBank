<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Carbon\Carbon;
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
        return view('auth.payment.payment', [
            'name' => Auth::user()->name,
            'iban' => Account::query()
                ->where('account_id', Auth::user()->getAuthIdentifier())
                ->first('iban')
                ->iban
        ]);
    }

    public function validateTransaction(): RedirectResponse
    {
        $attributes = request()->validate(
            [
                'name' => ['string', 'min:3', 'max:50', 'required'],
                'amount' => ['string', 'min:1', 'required'],
                'iban_number' => ['string', 'min:16', 'max:30', 'required'],
                'receiver_name' => ['string', 'min:3', 'max:50', 'required'],
                'receiver_iban_number' => ['string', 'min:16', 'max:30', 'required']
            ]
        );

        return redirect('/confirm-payment')->with('transferInfo', $attributes);
    }

    public function getQrCode(): View
    {
        $transfer = (object)session('transferInfo');
        $google2fa =  app('pragmarx.google2fa');

        $codeUrl = $google2fa->getQRCodeInline(
            'Test',
            'test@example.com',
            Auth::user()->google2fa_secret
        );

        return view('auth.payment.payment-two-factor', [
            'qrUrl' => $codeUrl,
            'securityCode' => Auth::user()->google2fa_secret,
            'checks' => request()->all(),
            'transfer' => $transfer
        ]);
    }

    public function finishTransfer(): RedirectResponse
    {
        $attributes = request()->validate([
            'name' => ['required'],
            'amount' => ['required'],
            'iban_number' => ['required'],
            'receiver_name' => ['required'],
            'receiver_iban_number' => ['required'],
            'one_time_password' => ['required']
        ]);

        $google2fa =  app('pragmarx.google2fa');

        $secretKey = Auth::user()->google2fa_secret;

        $validate = $google2fa->verifyKey($secretKey, $attributes['one_time_password']);

        if (!$validate) {
            return redirect()->back()->with('transferInfo', $attributes);
        }

        $this->pay($attributes);

        return redirect('/dashboard');
    }

    public function pay(array $data): void
    {
        $transactionRequest = (object)$data;

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
            $receiver = DB::table('bankAccounts')
                ->where('IBAN', $transactionRequest->receiver_iban_number)
                ->first('account_id');

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
    }

    public
    function transferView(): View
    {
        $accounts = \App\Models\InvestmentAccount::query()
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->get();

        $funds = Account::query()
            ->where('account_id', Auth::user()->getAuthIdentifier())
            ->first();

        return view('auth.payment.transferToInvestment', [
            'accounts' => $accounts,
            'balance' => $funds->balance
        ]);
    }

    public
    function transferToInvestment(): RedirectResponse
    {
        // todo: status message
        $attributes = (object)request()->validate([
            'iban' => ['required', 'min:21', 'max:21'],
            'amount' => ['required', 'min:0']
        ]);

        if ($attributes->amount < 0) {
            return back()->with('error', 'Amount should be positive!');
        }

        $transferAmount = $attributes->amount * 100;

        \App\Models\InvestmentAccount::query()
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->where('iban', $attributes->iban)
            ->increment('balance', $transferAmount);

        Account::query()
            ->where('account_id', Auth::user()->getAuthIdentifier())
            ->decrement('balance', $transferAmount);

        return redirect('/invest');
    }
}
