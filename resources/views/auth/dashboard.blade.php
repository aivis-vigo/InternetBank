@extends('layouts.layout')

@section('title', 'I-Bank')

@section('navbar')
    @parent
@endsection

@section('content')
    <main class="h-full w-full">
        <div class="w-1/2 mx-auto my-4">
            <div class="flex flex-wrap">
                <div class="w-full flex space-x-4">
                    <div class="w-full md:w-1/2 bg-white mb-4 p-4 border-2 rounded-lg border-gray-300 dark:bg-gray-900">
                        <button
                            id="cardNumberDropdown"
                            data-dropdown-toggle="cardNumber"
                            class="flex items-center justify-between w-full py-2 pl-3 pr-4  text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                            {{$accounts->IBAN}}
                        </button>

                    </div>
                    <div class="w-full md:w-1/2 bg-white mb-4 p-4 border-2 rounded-lg border-gray-300 dark:bg-gray-900 dark:text-white">
                        @if($accounts->balance != null)
                            &euro; {{number_format($accounts->balance / 100, 2)}}
                        @else
                            &euro; 0
                        @endif
                    </div>
                </div>

                <div class="w-full md:w-full md:h-full bg-white p-4 border-2 rounded-lg border-gray-300 dark:bg-gray-900 dark:text-white">
                    @forelse($history as $transaction)
                        <div class="flex-col">
                            <div class="flex justify-between my-2 rounded-lg">
                                <div>
                                    {{ $transaction->transaction_name }}
                                </div>
                                @if(!($transaction->transaction_amount > 0))
                                    <p class="text-red-500">
                                        {{ number_format($transaction->transaction_amount / 100, 2) }} &euro;
                                    </p>
                                @else
                                    <p class="text-green-500">
                                        {{ number_format($transaction->transaction_amount / 100, 2) }} &euro;
                                    </p>
                                @endif
                            </div>
                            <div class="text-center">
                                {{ $transaction->created_at }}
                            </div>

                            <div class="w-full">
                                <hr class="h-px mx-auto bg-gray-300 border-0 rounded md:my-4 dark:bg-gray-700">
                            </div>
                        </div>
                    @empty
                        Nothing to show
                    @endforelse
                </div>
            </div>
        </div>
    </main>
@endsection

@section('footer')
    @parent
@endsection
