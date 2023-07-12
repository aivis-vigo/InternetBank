<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Coin;
use App\Models\InvestmentAccount;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

/**
 * CoinController
 *
 * This controller handles cryptocurrency-related functionality.
 */
class CoinController extends Controller
{
    /**
     * Display the cryptocurrency index page.
     *
     * @return View
     */
    public function index(): View
    {
        $parameters = [
            'start' => '1',
            'limit' => '25',
            'convert' => 'EUR'
        ];

        $response = (new Client())->get(
            'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest', [
                'headers' => [
                    'Accepts' => 'application/json',
                    'X-CMC_PRO_API_KEY' => $_ENV['CRYPTO_API'],
                ],
                'query' => $parameters
            ]
        );

        $coins = json_decode($response->getBody()->getContents());

        return view(
            'auth.invest.coins', [
                'coins' => $coins
            ]
        );
    }

    /**
     * Show detailed information about a specific cryptocurrency.
     *
     * @param string $coinID
     * @return View
     */
    public function show(string $coinID): View
    {
        $parameters = [
            'id' => $coinID,
            'convert' => 'EUR'
        ];

        $response = (new Client())->get(
            'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest', [
                'headers' => [
                    'Accepts' => 'application/json',
                    'X-CMC_PRO_API_KEY' => $_ENV['CRYPTO_API'],
                ],
                'query' => $parameters
            ]
        );

        $selectedCoin = json_decode($response->getBody()->getContents());

        foreach ($selectedCoin->data as $coin) {
        }

        $account = InvestmentAccount::query()->where('user_id', Auth::user()->getAuthIdentifier())->first();
        $balance = $account->balance * $account->rate;
        $range = number_format($balance / 100 / ($coin->quote->EUR->price * $account->rate), 4);

        return view(
            'auth.invest.coin', [
                'coin' => $coin,
                'rangeMax' => str_replace(",", '', $range),
                'percentChange' => ['1h', '24h', '7d', '30d', '60d', '90d']
            ]
        );
    }

    /**
     * Buy a cryptocurrency.
     *
     * @return RedirectResponse
     */
    public function buy(): RedirectResponse
    {
        // todo: if coin exist add not create new
        $attributes = (object)request()->all();

        $transactionPrice = $attributes->amount * $attributes->price;
        $account = InvestmentAccount::query()->where('user_id', Auth::user()->getAuthIdentifier())->first();
        $balance = $account->balance * $account->rate;

        InvestmentAccount::query()->where('user_id', Auth::user()->getAuthIdentifier())->first()->update([
            'balance' => intval(($balance - intval(($transactionPrice * $account->rate) * 100)) / 100)
        ]);

        Coin::create(
            [
                'account_id' => Auth::user()->getAuthIdentifier(),
                'symbol' => $attributes->symbol,
                'name' => $attributes->name,
                'price' => $attributes->price,
                'amount' => $attributes->amount,
            ]
        );

        return redirect('/invest');
    }

    public function sell(string $symbol): RedirectResponse
    {
        $attributes = (object)request()->all();
        $account = InvestmentAccount::query()->where('user_id', Auth::user()->getAuthIdentifier())->first();

        $parameters = [
            'symbol' => $symbol,
            'convert' => 'EUR'
        ];

        $response = (new Client())->get(
            'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest', [
                'headers' => [
                    'Accepts' => 'application/json',
                    'X-CMC_PRO_API_KEY' => $_ENV['CRYPTO_API'],
                ],
                'query' => $parameters
            ]
        );

        $selectedCoin = json_decode($response->getBody()->getContents());

        foreach ($selectedCoin->data as $coin) {
        }

        // todo: clean up
        // todo: fix price bugs
        $currentPrice = $coin->quote->EUR->price * $account->rate;
        $currentlySelling = Coin::query()->where('id', $attributes->id)->first()->amount;

        Coin::query()->where('id', $attributes->id)->first()->update([
            'amount' => $currentlySelling - $attributes->amount
        ]);

        $converted = intval($currentPrice * $attributes->amount);
        $balance = InvestmentAccount::query()->where('user_id', Auth::user()->getAuthIdentifier())->first()->balance * $account->rate;

        InvestmentAccount::query()->where('user_id', Auth::user()->getAuthIdentifier())->first()->update([
            'balance' => intval($balance + intval($converted * 100)) / $account->rate
        ]);

        $this->deleteEmpty();

        return redirect('/invest');
    }

    private function deleteEmpty(): void
    {
        Coin::query()->where('amount', "<=", 0)->delete();
    }
}
