@extends('layouts.layout')

@section('title', 'I-Bank')

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="mx-auto flex-col w-1/2 p-4 border-2 border-gray-300 rounded-lg bg-white dark:text-white dark:bg-gray-900">
        <div class="flex w-full justify-between">
            <div class="flex">
                <div>
                    <img src="https://s2.coinmarketcap.com/static/img/coins/128x128/{{ $coin->id }}.png">
                </div>
                <div class="flex-col ml-4">
                    <div class="my-2">
                        ID: {{ $coin->id }}
                    </div>
                    <div class="my-2">
                        Symbol: {{ $coin->symbol }}
                    </div>
                    <div class="my-2">
                        Name: {{ $coin->name }}
                    </div>
                    <div class="my-2">
                        Price: {{ $coin->quote->EUR->price }}
                    </div>
                </div>
            </div>
        </div>

        <hr class="h-px bg-gray-300 border-0 dark:bg-gray-700">

        <div class="flex justify-between">
            <div>
                <div class="w-full my-2">
                    Market capital: {{ $coin->quote->EUR->market_cap }}
                </div>
                <div class="w-full my-2">
                    Market capital dominance: {{ $coin->quote->EUR->market_cap_dominance }}
                </div>
            </div>
            <div>
                <div class="my-2">
                    Market pairs: {{ $coin->num_market_pairs }}
                </div>
                <div class="my-2">
                    Circulating supply: {{ $coin->circulating_supply }}
                </div>
            </div>
        </div>

        <hr class="h-px bg-gray-300 border-0 dark:bg-gray-700">

        <div class="flex gap-x-4 my-2">
            <div>
                <div class="flex-col">
                    Volume 24H:
                </div>
                <div>
                    {{ $coin->quote->EUR->volume_24h }}
                </div>
            </div>
            <div class="flex-col">
                <div>
                    Volume change 24H:
                </div>
                @switch( $volumeChange = $coin->quote->EUR->volume_change_24h)
                    @case($volumeChange < 0)
                        <div class="flex gap-x-1">
                            <svg
                                class="h-5 w-5 text-red-500"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"/>
                                <circle cx="12" cy="12" r="9"/>
                                <line x1="8" y1="12" x2="12" y2="16"/>
                                <line x1="12" y1="8" x2="12" y2="16"/>
                                <line x1="16" y1="12" x2="12" y2="16"/>
                            </svg>
                            <div class="text-red-500">
                                {{ $coin->quote->EUR->volume_change_24h }}
                            </div>
                        </div>
                        @break
                    @case($volumeChange > 0)
                        <div class="flex gap-x-1">
                            <svg
                                class="h-5 w-5 text-green-500"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"/>
                                <circle cx="12" cy="12" r="9"/>
                                <line x1="8" y1="12" x2="12" y2="16"/>
                                <line x1="12" y1="8" x2="12" y2="16"/>
                                <line x1="16" y1="12" x2="12" y2="16"/>
                            </svg>
                            <div class="text-green-500">
                                {{ $coin->quote->EUR->volume_change_24h }}
                            </div>
                        </div>
                        @break
                    @default
                        <div>
                            {{ $coin->quote->EUR->volume_change_24h }}
                        </div>
                @endswitch
            </div>
        </div>

        <hr class="h-px bg-gray-300 border-0 dark:bg-gray-700">

        <div class="flex my-2 justify-between">
            @foreach($percentChange as $timeInterval)
                <div class="flex-col">
                    <div>
                        {{$timeInterval}}:
                    </div>
                    @switch($interval = $coin->quote->EUR->{'percent_change_' . $timeInterval})
                        @case($interval < 0)
                            <div class="flex gap-x-1">
                                <svg
                                    class="h-5 w-5 text-red-500"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    fill="none"
                                    stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"/>
                                    <circle cx="12" cy="12" r="9"/>
                                    <line x1="8" y1="12" x2="12" y2="16"/>
                                    <line x1="12" y1="8" x2="12" y2="16"/>
                                    <line x1="16" y1="12" x2="12" y2="16"/>
                                </svg>
                                <div class="text-red-500">
                                    {{ number_format($coin->quote->EUR->{'percent_change_' . $timeInterval}, 4) }}
                                </div>
                            </div>
                            @break
                        @case($interval > 0)
                            <div class="flex gap-x-1">
                                <svg
                                    class="h-5 w-5 text-green-500"
                                    width="24" height="24"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    fill="none"
                                    stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"/>
                                    <circle cx="12" cy="12" r="9"/>
                                    <line x1="12" y1="8" x2="8" y2="12"/>
                                    <line x1="12" y1="8" x2="12" y2="16"/>
                                    <line x1="16" y1="12" x2="12" y2="8"/>
                                </svg>
                                <div class="text-green-500">
                                    </svg>{{ number_format($coin->quote->EUR->{'percent_change_' . $timeInterval}, 4) }}
                                </div>
                            </div>
                            @break
                        @default
                            <div>
                                {{ $coin->quote->EUR->{'percent_change_' . $timeInterval} }}
                            </div>
                    @endswitch
                </div>
            @endforeach
        </div>

        <hr class="h-px bg-gray-300 border-0 dark:bg-gray-700">

        <div class="my-3">
            <form action="/buy" method="post">
                @csrf
                <div class="mx-auto text-center my-2">
                    <label
                        for="amount"
                        class="block text-sm font-medium text-gray-900 dark:text-white">
                        Amount:
                    </label>
                    <div class="flex flex-col">
                        <input
                            name="amount"
                            type="range"
                            value="24"
                            min="0.0001"
                            max="{{ $rangeMax }}"
                            step="0.0001"
                            oninput="this.nextElementSibling.value = this.value"
                            class="mx-auto w-1/2"
                        >
                        <output>
                            {{ $rangeMax / 2 }}
                        </output>
                    </div>
                </div>

                <input type="hidden" name="symbol" value="{{ $coin->symbol }}">
                <input type="hidden" name="name" value="{{ $coin->name }}">
                <input type="hidden" name="price" value="{{ $coin->quote->EUR->price }}">

                <div class="mx-auto text-center">
                    <button
                        type="submit"
                        class="w-1/2 text-white bg-green-500 hover:bg-green-400 focus:ring-4 focus:outline-none focus:ring-green-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Buy
                    </button>
                </div>
            </form>
        </div>

        <hr class="h-px bg-gray-300 border-0 dark:bg-gray-700">


        <div class="flex justify-between my-2">
            <div>
                Last updated: {{ date('d-m-Y-H:i:s', strtotime($coin->quote->EUR->last_updated)) }}
            </div>
            <div>
                Date added: {{ date('d-m-Y', strtotime($coin->date_added)) }}
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection
