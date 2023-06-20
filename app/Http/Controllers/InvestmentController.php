<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\View\View;

class InvestmentController extends Controller
{
    public function index(): View
    {
        $client = new Client();
        $key = 'f882b284-925c-42cd-8644-7f1c9d152d2c';

        $parameters = [
            'start' => '1',
            'limit' => '5',
            'convert' => 'EUR'
        ];

        $response = $client->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest', [
            'headers' => [
                'Accepts' => 'application/json',
                'X-CMC_PRO_API_KEY' => $key,
            ],
            'query' => $parameters
        ]);

        $coins = json_decode($response->getBody()->getContents());

        return view('auth.invest.invest');
    }
}
