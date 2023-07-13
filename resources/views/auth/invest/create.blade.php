@extends('layouts.layout')

@section('title', 'I-Bank')

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="mx-auto w-full md:w-1/2 bg-white mb-4 p-4 border-2 rounded-lg border-gray-300 dark:bg-gray-900">
        <h1 class="text-center dark:text-gray-300 text-2xl font-bold">
            Investment Account
        </h1>

        <ul class="space-y-4 mb-2 text-gray-500 list-disc list-inside dark:text-white">
            <li>
                You need to create investment account to buy crypto or you can create another one!
                <ol class="pl-5 mt-2 space-y-1 list-decimal list-inside">
                    <li>Select currency for your account</li>
                    <li>Start buying</li>
                </ol>
            </li>
        </ul>

        <button
            id="dropdownDefaultButton"
            data-dropdown-toggle="dropdown"
            class="justify-center text-center w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button"
        >
            Select
            <svg
                class="w-2.5 h-2.5 ml-2.5"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 10 6"
            >
                <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m1 1 4 4 4-4"
                />
            </svg>
        </button>
        <!-- Dropdown menu -->
        <div
            id="dropdown"
            class="hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul
                class="py-2 text-sm text-gray-700 dark:text-gray-200"
                aria-labelledby="dropdownDefaultButton"
            >
                <form action="/create-investment-account" method="post">
                    @csrf
                    <input type="hidden" name="code" value="EUR">
                    <input type="hidden" name="rate" value="1">

                    <button
                        type="submit"
                        class="w-full block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                    >
                        EUR - 1
                    </button>
                </form>

                @foreach($currencies as $currency)
                    <form action="/create-investment-account" method="post">
                        @csrf
                        <input type="hidden" name="code" value="{{ $currency->ID }}">
                        <input type="hidden" name="rate" value="{{ $currency->Rate }}">

                        <button
                            type="submit"
                            class="w-full block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                        >
                            {{ $currency->ID }} - {{ $currency->Rate }}
                        </button>
                    </form>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection
