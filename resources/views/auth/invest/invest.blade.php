@extends('layouts.layout')

@section('title', 'I-Bank')

@section('navbar')
    @parent
@endsection

@section('content')
    <main>
        <div class="mx-auto w-1/2">
            <div class="flex gap-x-4">
                <div
                    class="w-full border-2 bg-white border-gray-300 rounded-lg p-4 mb-4 dark:bg-gray-900 dark:text-white">
                    {{ $account->IBAN }}
                </div>
                <div
                    class="w-full border-2 bg-white border-gray-300 rounded-lg p-4 mb-4 dark:bg-gray-900 dark:text-white">
                    &euro; {{ $account->balance / 100 }}
                </div>
            </div>
            <div class="border-2 bg-white border-gray-300 rounded-lg p-4 dark:text-white dark:bg-gray-900">
                @forelse($coins as $coin)
                    <div class="flex my-2 p-4 bg-gray-200 hover:bg-gray-300 rounded-lg dark:bg-gray-800 dark:hover:text-black">
                        <form action="/sell/{{ $coin->symbol }}" method="post">
                            @csrf
                            <div>
                                <div>
                                    {{ $coin->name }}
                                </div>
                                <div>
                                    {{ $coin->price }}
                                </div>
                                <div>
                                    {{ $coin->amount }} {{ $coin->symbol }}
                                </div>

                                <input type="hidden" name="id" value="{{ $coin->id }}">
                                <input type="hidden" name="name" value="{{ $coin->name }}">
                                <input type="hidden" name="price" value="{{ $coin->price }}">

                                <input
                                    class="w-1/3"
                                    type="number"
                                    name="amount"
                                    max="{{ $coin->amount }}"
                                    step="0.0001"
                                    placeholder="0.001 {{ $coin->symbol }}"
                                    required
                                >

                                <button
                                    type="submit"
                                    class="text-red-500 dark:hover:text-black">
                                    Sell
                                </button>
                            </div>
                        </form>

                        <form action="/sell/{{ $coin->symbol }}" method="post">
                            @csrf
                            <input type="hidden" name="amount" value="{{ $coin->amount }}">

                            <input type="hidden" name="id" value="{{ $coin->id }}">
                            <input type="hidden" name="name" value="{{ $coin->name }}">
                            <input type="hidden" name="price" value="{{ $coin->price }}">

                            <button
                                type="submit"
                                class="text-red-500 dark:hover:text-black">
                                Sell All
                            </button>
                        </form>
                    </div>
                @empty
                    Nothing to show
                @endforelse
            </div>
        </div>
    </main>
@endsection

@section('footer')
    @parent
@endsection
