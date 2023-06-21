@extends('layouts.layout')

@section('title', 'I-Bank')

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="mx-auto w-1/2 my-4">
        <hr class="w-full h-1 mx-auto bg-gray-300 border-0 rounded md:my-0 dark:bg-gray-700">
        <div class="flex justify-between m-2">
            <div>#</div>
            <div>Name</div>
            <div>Price</div>
            <div>Circulating Supply</div>
        </div>
        <hr class="w-full h-1 mx-auto bg-gray-300 border-0 rounded md:my-0 dark:bg-gray-700">

        <div class="my-2">
            @foreach ($coins->data as $coin)
                <a href="#">
                    <div class="flex justify-between p-2 my-2 w-full hover:bg-gray-300 hover:rounded-lg hover:transition duration-200">
                        <div>{{$coin->cmc_rank}}</div>
                        <div class="flex gap-x-2">
                            <div>
                                <img src="https://s2.coinmarketcap.com/static/img/coins/16x16/{{$coin->id}}.png">
                            </div>
                            <div>{{$coin->name}}</div>
                            <div class="text-gray-500">{{$coin->symbol}}</div>
                        </div>
                        <div>{{number_format($coin->quote->EUR->volume_24h, 2)}}</div>
                        <div>{{number_format($coin->total_supply, 2)}} {{$coin->symbol}}</div>
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
