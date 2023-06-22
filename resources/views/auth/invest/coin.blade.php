@extends('layouts.layout')

@section('title', 'I-Bank')

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="mx-auto flex-col w-1/2 p-4 border-2 border-gray-300 rounded-lg bg-white">
        <div class="flex">
            <div>
                <img src="https://s2.coinmarketcap.com/static/img/coins/128x128/{{$coin->id}}.png">
            </div>
            <div class="flex-col ml-4">
                <div class="my-2">
                    ID: {{$coin->id}}
                </div>
                <div class="my-2">
                    Symbol: {{$coin->symbol}}
                </div class="my-2">
                <div>
                    Name: {{$coin->name}}
                </div>
                <div class="my-2">
                    Price: {{number_format($coin->quote->EUR->price, 2)}}
                </div>
            </div>
        </div>

        <hr class="h-px bg-gray-300 border-0 dark:bg-gray-700">

        <div class="my-2">
            Market capital: {{number_format($coin->quote->EUR->market_cap, 2)}}
        </div>
        <div class="my-2">
            Market capital dominance: {{number_format($coin->quote->EUR->market_cap_dominance, 2)}}
        </div>
        <div class="my-2">
            Market pairs: {{$coin->num_market_pairs}}
        </div>
        <div class="my-2">
            Circulating supply: {{number_format($coin->circulating_supply, 2)}}
        </div>

        <hr class="h-px bg-gray-300 border-0 dark:bg-gray-700">

        <div class="flex gap-x-4 my-2">
            <div>
                Volume 24H: {{number_format($coin->quote->EUR->volume_24h, 2)}}
            </div>
            <div>
                Volume change 24H: {{number_format($coin->quote->EUR->volume_change_24h, 2)}}
            </div>
        </div>

        <hr class="h-px bg-gray-300 border-0 dark:bg-gray-700">

        <div class="flex my-2">
            <div>
                Change (%) 1h: {{number_format($coin->quote->EUR->percent_change_1h, 2)}}
            </div>
            <div>
                Change (%) 24h: {{number_format($coin->quote->EUR->percent_change_24h, 2)}}
            </div>
            <div>
                Change (%) 7d: {{number_format($coin->quote->EUR->percent_change_7d, 2)}}
            </div>
            <div>
                Change (%) 30d: {{number_format($coin->quote->EUR->percent_change_30d, 2)}}
            </div>
            <div>
                Change (%) 60d: {{number_format($coin->quote->EUR->percent_change_60d, 2)}}
            </div>
            <div>
                Change (%) 90d: {{number_format($coin->quote->EUR->percent_change_90d, 2)}}
            </div>
        </div>

        <hr class="h-px bg-gray-300 border-0 dark:bg-gray-700">

        <div class="flex justify-between my-2">
            <div>
                Last updated: {{date('d-m-Y-H:i:s', strtotime($coin->quote->EUR->last_updated))}}
            </div>
            <div>
                Date added: {{date('d-m-Y', strtotime($coin->date_added))}}
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection
