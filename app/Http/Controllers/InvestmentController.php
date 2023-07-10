<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Coin;
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
        // todo: change iban to investment iban

        $account = Account::query()->where('account_id', Auth::user()->id)->get();
        $coins = Coin::query()->select('*')->where('account_id', Auth::user()->id)->get();

        return view(
            'auth.invest.invest', [
                'account' => $account[0],
                'coins' => $coins
            ]
        );
    }

    public function customizeAccount(): View
    {
        // todo: chose currency and create account with unique iban (it can be international)

        return view('auth.invest.create', [
            'currencies' => $this->currencyRate()->Currencies->Currency
        ]);
    }

    public function create(): View
    {
        var_dump(request()->all());die;
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
}
