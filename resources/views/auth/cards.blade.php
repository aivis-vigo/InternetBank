@extends('layouts.layout')

@section('title', 'I-Bank')

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="w-1/2 mx-auto">
        <div class="flex justify-left items-left p-4 bg-white rounded-lg border-2 border-gray-300 text-black">
            <div>
                <p>Add new debit card</p>
                <form action="/add-card" method="get">
                    @csrf
                    <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mt-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Add
                    </button>
                </form>
            </div>
        </div>
    </div>

    @foreach($cards as $card)
        <div class="space-y-16">
            <div class="w-96 h-56 m-auto bg-blue-500 rounded-xl relative text-white transition-transform transform hover:scale-110">
                <div class="w-full px-8 absolute top-8">
                    <div class="flex justify-between">
                        <div class="">
                            <p class="font-light">
                                Name
                                </h1>
                            <p class="font-medium tracking-widest">
                            {{$name}}
                            </p>
                        </div>
                        <img class="w-14 h-14" src="../mastercard.png"/>
                    </div>
                    <div class="pt-1">
                        <p class="font-light">
                            Card Number
                            </h1>
                        <p class="font-medium tracking-more-wider">
                            {{ chunk_split($card->card_number, 4, ' ') }}
                        </p>
                    </div>
                    <div class="pt-6 pr-6">
                        <div class="flex justify-between">
                            <div class="">
                                <p class="font-light text-xs">
                                    Valid
                                    </h1>
                                <p class="font-medium tracking-wider text-sm">
                                    11/15
                                </p>
                            </div>
                            <div class="">
                                <p class="font-light text-xs text-xs">
                                    Expiry
                                    </h1>
                                <p class="font-medium tracking-wider text-sm">
                                {{$card->expires_at}}
                                </p>
                            </div>

                            <div class="">
                                <p class="font-light text-xs">
                                    CVV
                                    </h1>
                                <p class="font-bold tracking-more-wider text-sm">
                                    {{$card->cvc}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach

@endsection

@section('footer')
    @parent
@endsection
