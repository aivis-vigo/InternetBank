<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
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

        $coin = json_decode($response->getBody()->getContents());

        foreach ($coin->data as $coin) {
            $response = $coin;
        }

        return view('auth.invest.coin', [
            'coin' => $response,
            'percentChange' => ['1h', '24h', '7d', '30d', '60d', '90d']
        ]);
    }
}
