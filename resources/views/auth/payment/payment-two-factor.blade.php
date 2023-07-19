@extends('layouts.layout')

@section('title', 'I-Bank')

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="flex justify-center items-center">
        <form
            action="/redirect"
            method="post"
            class="w-1/2 p-4"
        >
            @csrf
            <div class="bg-white rounded-lg p-4 dark:bg-gray-900 border-2">
                <label
                    for="one_time_password"
                    class="block mb-2 text-2xl font-semibold text-black dark:text-white"
                >
                    Authentication code
                </label>

                <div class="space-y-4 mb-4 dark:text-white">
                    <h3>
                        Scan this QR code into your authenticator app
                    </h3>

                    <div class="flex justify-center">
                        {!! $qrUrl !!}
                    </div>

                    <div>
                        Or enter manually: <span class="font-semibold">{{ $securityCode }}</span>
                    </div>
                </div>

                <div class="dark:text-white mb-2">
                    Enter code:
                </div>

                <input type="hidden" name="name" value="{{ $transfer->name }}">
                <input type="hidden" name="amount" value="{{ $transfer->amount }}">
                <input type="hidden" name="iban_number" value="{{ $transfer->iban_number }}">
                <input type="hidden" name="receiver_name" value="{{ $transfer->receiver_name }}">
                <input type="hidden" name="receiver_iban_number" value="{{ $transfer->receiver_iban_number }}">

                <input
                    type="text"
                    name="one_time_password"
                    id="one_time_password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 mb-2 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required
                >
                @error('code')
                <p class="text-red-500 text-xs mt-2">
                    {{ $message }}
                </p>
                @enderror
                <button
                    type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mt-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                >
                    Enter
                </button>
            </div>
        </form>
    </div>
@endsection

@section('footer')
    @parent
@endsection
