@extends('layouts.layout')

@section('title', 'I-Bank')

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="mx-auto mt-6">
        @forelse($cards as $card)
            <div class="mb-6 w-1/2">
                <div
                    class="w-96 h-56 m-auto bg-blue-500 rounded-xl relative text-white transition-transform transform hover:scale-110">
                    <div class="w-full px-8 absolute top-8">
                        <div class="flex justify-between">
                            <div class="">
                                <p class="font-light">
                                    Name
                                <p class="font-medium tracking-widest">
                                    {{$name}}
                                </p>
                            </div>
                            <img class="w-14 h-14" src="../mastercard.png"/>
                        </div>
                        <div class="pt-1">
                            <p class="font-light">
                                Card Number
                            <p class="font-medium tracking-more-wider">
                                {{ chunk_split($card->card_number, 4, ' ') }}
                            </p>
                        </div>
                        <div class="pt-6 pr-6">
                            <div class="flex justify-between">
                                <div class="">
                                    <p class="font-light text-xs text-xs">
                                        Expiry
                                    <p class="font-medium tracking-wider text-sm">
                                        {{$card->expires_at}}
                                    </p>
                                </div>

                                <div class="">
                                    <p class="font-light text-xs">
                                        CVV
                                    <p class="font-bold tracking-more-wider text-sm">
                                        {{$card->cvc}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>You don't have any cards!</p>
        @endforelse
    </div>
@endsection

@section('footer')
    @parent
@endsection
