@extends('layouts.layout')

@section('title', 'I-Bank')

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="mx-auto w-1/2 my-4">
        <div class="flex text-center justify-between m-2 dark:text-white">
            <div class="flex-1">
                #
            </div>
            <div class="flex-1">
                Name
            </div>
            <div class="flex-1">
                Price
            </div>
            <div class="flex-1">
                Circulating Supply
            </div>
        </div>

        <hr class="w-full h-1 mx-auto bg-gray-300 border-0 rounded md:my-0 dark:bg-gray-700">

        <div class="my-2 dark:text-white">
            @foreach ($coins->data as $coin)
                <a href="/coin/{{ $coin->id }}">
                    <div class="flex justify-between text-center p-2 my-2 w-full hover:bg-gray-300 hover:rounded-lg hover:transition duration-200 dark:hover:text-black">
                        <div class="flex-1">
                            {{ $coin->cmc_rank }}
                        </div>
                        <div class="flex flex-1 gap-x-2">
                            <div class="flex">
                                <img
                                    src="https://s2.coinmarketcap.com/static/img/coins/16x16/{{ $coin->id }}.png"
                                    class="object-contain"
                                >
                            </div>
                            <div>{{$coin->name}}</div>
                            <div class="text-gray-500">{{ $coin->symbol }}</div>
                        </div>
                        <div class="flex-1">
                            {{ number_format($coin->quote->EUR->price, 2) }}
                        </div>
                        <div class="flex-1">
                            {{ number_format($coin->total_supply, 2) }} {{ $coin->symbol }}
                        </div>
                    </div>
                </a>
                <hr class="h-px bg-gray-300 border-0 dark:bg-gray-700">
            @endforeach
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection
