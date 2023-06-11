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
                    <div class="w-full md:w-1/2 bg-white mb-4 p-4 border-2 rounded-lg border-gray-300">
                        Account number
                    </div>
                    <div class="w-full md:w-1/2 bg-white mb-4 p-4 border-2 rounded-lg border-gray-300">
                        Amount in account
                    </div>
                </div>
                <div class="w-full md:w-full md:h-full bg-white p-4 border-2 rounded-lg border-gray-300">
                    Transaction history
                </div>
            </div>
        </div>
    </main>
@endsection

@section('footer')
    @parent
@endsection
