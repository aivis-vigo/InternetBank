@extends('layouts.layout')

@section('title', 'I-Bank')

@section('navbar')
    @parent
@endsection

@section('content')
    <main>
        <div class="mx-auto w-1/2">
            <div class="flex gap-x-4">
                <div class="w-full border-2 bg-white border-gray-300 rounded-lg p-4 mb-4 dark:bg-gray-900 dark:text-white">
                    <button
                        id="ibanDropdownLink"
                        data-dropdown-toggle="ibanDropdown"
                        class="flex items-center justify-between w-full py-2 pl-3 pr-4  text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent"
                    >
                        {{ $current->iban }}
                        <svg
                            class="w-5 h-5 ml-1"
                            aria-hidden="true"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </button>

                    <!-- Dropdown list for iban numbers --->
                    <div
                        id="ibanDropdown"
                        class="w-auto z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600"
                    >
                        <ul
                            class="py-2 text-sm text-gray-700 dark:text-white"
                            aria-labelledby="dropdownLargeButton"
                        >
                            @foreach($accounts as $account)
                                <li>
                                    <form action="/change-investment-account" method="post">
                                        @csrf
                                        <input type="hidden" name="change_to" value="{{ $account->iban }}">

                                        <div class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            <button type="submit">
                                                {{ $account->iban }}
                                            </button>
                                        </div>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div
                    class="w-full flex justify-between border-2 bg-white border-gray-300 rounded-lg p-4 mb-4 dark:bg-gray-900 dark:text-white">
                    <div>
                        {{ $current->currency_code }} {{ number_format($current->rate * $current->balance / 10000, 2) }}
                    </div>

                    <form action="/payment-to-investment-account" method="get">
                        <button type="submit">
                            <svg
                                class="h-6 w-6 text-black dark:text-gray-300 hover:text-green-500 transition duration-200"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path
                                    stroke="none"
                                    d="M0 0h24v24H0z"
                                />
                                <path
                                    d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12"/>
                                <path d="M20 12v4h-4a2 2 0 0 1 0 -4h4"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <div class="border-2 bg-white border-gray-300 rounded-lg p-4 dark:text-white dark:bg-gray-900">
                @forelse($coins as $coin)
                    <form
                        action="/sell/{{ $coin->symbol }}"
                        method="post"
                        class="flex my-2 p-4 bg-gray-200 hover:bg-gray-300 rounded-lg dark:bg-gray-800 dark:hover:text-black"
                    >
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

                    <form
                        action="/sell/{{ $coin->symbol }}"
                        method="post"
                        class="flex my-2 p-4 bg-gray-200 hover:bg-gray-300 rounded-lg dark:bg-gray-800 dark:hover:text-black"
                    >
                        @csrf

                        <input type="hidden" name="id" value="{{ $coin->id }}">
                        <input type="hidden" name="name" value="{{ $coin->name }}">
                        <input type="hidden" name="price" value="{{ $coin->price }}">
                        <input type="hidden" name="amount" value="{{ $coin->amount }}">

                        <button
                            type="submit"
                            class="text-red-500 dark:hover:text-black">
                            Sell All
                        </button>
                    </form>
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
