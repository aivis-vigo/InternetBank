@extends('layouts.layout')

@section('title', 'I-Bank')

@section('navbar')
    @parent
@endsection

@section('content')
    <form
        class="flex flex-wrap gap-3 w-1/2  mx-auto p-5"
        action="/add-card"
        method="post"
    >
        @csrf
        <label class="relative w-full flex flex-col">
            <span class="font-bold mb-3">Card number</span>
            <input
                class="rounded-md peer pl-12 pr-2 py-2 border-2 border-gray-200 placeholder-gray-300"
                type="text"
                name="card_number"
                placeholder="0000 0000 0000 0000"
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

        <label class="relative flex-1 flex flex-col">
            <span class="font-bold mb-3">Expire date</span>
            <input
                class="rounded-md peer pl-12 pr-2 py-2 border-2 border-gray-200 placeholder-gray-300"
                type="text"
                name="expire_date"
                placeholder="MM/YY"
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
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                />
            </svg>
        </label>

        <label class="relative flex-1 flex flex-col">
            <span class="font-bold flex items-center gap-3 mb-3">
              CVC/CVV
              <span class="relative group">
                <span class="hidden group-hover:flex justify-center items-center px-2 py-1 text-xs absolute -right-2 transform translate-x-full -translate-y-1/2 w-max top-1/2 bg-black text-white"
                >
                    Enter last three digits on the signature strip!
                </span>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4" fill="none"
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
                class="rounded-md peer pl-12 pr-2 py-2 border-2 border-gray-200 placeholder-gray-300"
                type="text"
                name="card_cvc" placeholder="&bull;&bull;&bull;"
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
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                />
            </svg>
        </label>

        <div class="w-full flex flex-col">
            @error('card_number')
            <p class="text-red-500 text-xs mt-2">
                {{ $message }}
            </p>
            @enderror

            @error('expire_date')
            <p class="text-red-500 text-xs mt-2">
                {{ $message }}
            </p>
            @enderror

            @error('card_cvc')
            <p class="text-red-500 text-xs mt-2">
                {{ $message }}
            </p>
            @enderror
        </div>

        <div class="w-full">
            <button
                type="submit"
                class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mt-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
            >
                Add
            </button>
        </div>
    </form>
@endsection

@section('footer')
    @parent
@endsection
