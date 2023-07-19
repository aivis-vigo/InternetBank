@extends('layouts.layout')

@section('title', 'I-Bank')

@section('navbar')
    @parent
@endsection

@section('content')
    <main class="dark:text-white">
        <div class="text-center">
            <h1 class="text-2xl font-bold dark:text-white0">
                Fund Investment Account
            </h1>
        </div>

        <form
            class="flex flex-wrap gap-3 w-1/2  mx-auto p-5"
            action="/transfer-to-investment-account"
            method="post"
        >
            @csrf
            <div class="w-full dark:text-white">
                <label
                    for="account"
                    class="sr-only">
                    Account
                </label>
                <select
                    id="account"
                    class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-black appearance-none dark:text-white dark:border-white focus:outline-none focus:ring-0 focus:border-gray-200 peer"
                    name="iban"
                    required
                >
                    <option disabled selected>
                        Select Account
                    </option>
                    @foreach($accounts as $account)
                        <option value="{{ $account->iban }}" class="text-black">
                            {{ $account->iban }}
                        </option>
                    @endforeach
                </select>

                <label class="relative flex-1 flex flex-col" for="amount">
            <span class="font-bold flex items-center gap-3 my-3">
              Amount
              <span class="relative group">
                <span
                    class="hidden group-hover:flex justify-center items-center px-2 py-1 text-xs absolute -right-2 transform translate-x-full -translate-y-1/2 w-max top-1/2 bg-black text-white">
                    Available: {{ number_format($balance / 100, 2) }} &euro;
                </span>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                  <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                  />
                </svg>
              </span>
            </span>

                    <input
                        class="rounded-md peer pl-12 pr-2 py-2 border-2 border-gray-200 placeholder-gray-300 dark:bg-gray-900"
                        type="number"
                        step="0.01"
                        name="amount"
                        placeholder="4.99"
                        required
                    />
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="absolute bottom-0 left-0 -mb-0.5 transform translate-x-1/2 -translate-y-1/2 text-black peer-placeholder-shown:text-gray-300 h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"
                        />
                    </svg>
                </label>
            </div>

            @if(session('error'))
                <div class="w-full flex flex-col">
                    <p class="text-red-500 text-xs mt-2">
                        {{ session('error') }}
                    </p>
                </div>
            @endif

            <div class="w-full">
                <button
                    type="submit"
                    class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mt-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                >
                    Transfer
                </button>
            </div>
        </form>
    </main>
@endsection

@section('footer')
    @parent
@endsection