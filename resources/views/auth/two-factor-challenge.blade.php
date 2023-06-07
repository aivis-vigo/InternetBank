@extends('layouts.layout')

@section('title', 'I-Bank')

@section('navbar')
    @parent
@endsection

@section('content')
    <form action="/two-factor-challenge" method="post">
        @csrf
        <div>
            <label for="code" class="block mb-2 text-sm font-medium text-white dark:text-white">Authentication
                code</label>
            <input type="text" name="code" id="code"
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   required="">

            @error('code')
            <p class="text-red-500 text-xs mt-6">
                {{ $message }}
            </p>
            @enderror
        </div>
    </form>
@endsection

@section('footer')
    @parent
@endsection
