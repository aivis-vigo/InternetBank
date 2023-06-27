<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\Coin;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CoinController extends Controller
{
    public function index(): View
    {
        $parameters = [
            'start' => '1',
            'limit' => '25',
            'convert' => 'EUR'
        ];

        $response = (new Client())->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest', [
            'headers' => [
                'Accepts' => 'application/json',
                'X-CMC_PRO_API_KEY' => $_ENV['CRYPTO_API'],
            ],
            'query' => $parameters
        ]);

        $coins = json_decode($response->getBody()->getContents());

        return view('auth.invest.coins', [
            'coins' => $coins
        ]);
    }

    public function show(string $coinID): View
    {
        $parameters = [
            'id' => $coinID,
            'convert' => 'EUR'
        ];

        $response = (new Client())->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest', [
            'headers' => [
                'Accepts' => 'application/json',
                'X-CMC_PRO_API_KEY' => $_ENV['CRYPTO_API'],
            ],
            'query' => $parameters
        ]);

        $selectedCoin = json_decode($response->getBody()->getContents());

        foreach ($selectedCoin->data as $coin) {}

        $balance = Accounts::query()->where('account_id', Auth::user()->getAuthIdentifier())->first()->balance;

        return view('auth.invest.coin', [
            'coin' => $coin,
            'rangeMax' => number_format($balance / 100 / $coin->quote->EUR->price, 4),
            'percentChange' => ['1h', '24h', '7d', '30d', '60d', '90d']
        ]);
    }

    public function buy(): RedirectResponse
    {
        $attributes = (object)request()->all();

        Coin::create([
            'account_id' => Auth::user()->getAuthIdentifier(),
            'symbol' => $attributes->symbol,
            'name' => $attributes->name,
            'price' => $attributes->price,
            'amount' => $attributes->amount,
        ]);

        return redirect('/invest');
    }
}
