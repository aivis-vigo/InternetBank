@extends('layouts.layout')

@section('title', 'I-Bank')

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="flex justify-center items-center">
        <form action="/two-factor-challenge" method="post" class="w-1/2 p-4">
            @csrf
            <div class="bg-white rounded-lg p-4">
                <label for="code" class="block mb-2 text-sm font-medium text-black dark:text-white">Authentication
                    code</label>
                <input type="text" name="code" id="code"
                       class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       required="">
                @error('code')
                <p class="text-red-500 text-xs mt-2">
                    {{ $message }}
                </p>
                @enderror
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mt-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Enter
                </button>
            </div>
        </form>
    </div>
@endsection

@section('footer')
    @parent
@endsection
