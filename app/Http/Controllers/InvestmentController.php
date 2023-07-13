<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Coin;
use App\Models\InvestmentAccount;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * InvestmentController
 *
 * This controller handles investment-related functionality.
 */
class InvestmentController extends Controller
{
    /**
     * Display the investment index page.
     *
     * @return View
     */
    public function index(): View
    {
        // todo: sell all
        // todo: in case of many account select one

        $coins = Coin::query()->select('*')->where('account_id', Auth::user()->id)->get();

        return view(
            'auth.invest.invest', [
                'current' => InvestmentAccount::query()->where('user_id', Auth::user()->id)->first(),
                'accounts' => InvestmentAccount::query()->where('user_id', Auth::user()->id)->get(),
                'coins' => $coins
            ]
        );
    }

    public function customizeAccount(): View
    {
        return view('auth.invest.create', [
            'currencies' => $this->currencyRate()->Currencies->Currency
        ]);
    }

    public function create(): RedirectResponse
    {
        $attributes = (object)request()->all();

        InvestmentAccount::create([
            'user_id' => Auth::user()->getAuthIdentifier(),
            'balance' => 0,
            'iban' => $this->generateNonRepeatingRandomNumber($attributes->code),
            'currency_code' => $attributes->code,
            'rate' => intval($attributes->rate * 100)
        ]);

        return redirect('/invest');
    }

    public function changeAccount(): View
    {
        $attributes = (object)request()->all();
        $currentAccount = InvestmentAccount::query()
            ->where('iban', $attributes->change_to)
            ->first();

        $accounts = InvestmentAccount::query()
            ->where('user_id', $currentAccount->user_id)
            ->get();

        $coins = Coin::query()
            ->where('account_id', $currentAccount->account_id)
            ->get();

        return view('auth.invest.changeAccount', [
            'current' => $currentAccount,
            'accounts' => $accounts,
            'coins' => $coins
        ]);
    }

    private function currencyRate(): object
    {
        // todo: add job
        $date = str_replace('-', '', Carbon::now()->toDateString());

        $parameters = [
            'date' => $date
        ];

        $response = (new Client())->get(
            'https://www.bank.lv/vk/ecb.xml?date', [
                'headers' => [
                    'Accepts' => 'application/json'
                ],
                'query' => $parameters
            ]
        );

        $currenciesXml = simplexml_load_string($response->getBody()->getContents());

        return json_decode(json_encode($currenciesXml));
    }

    private function generateNonRepeatingRandomNumber($currencyCode): string
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

        return $currencyCode . "4625579723" . $iban;
    }
}
