@extends('layouts.layout')

@section('title', 'I-Bank')

@section('navbar')
    @parent
@endsection

@section('content')
    <main>
        <div class="mx-auto w-1/2">
            <div class="flex gap-x-4">
                <div class="w-full border-2 bg-white border-gray-300 p-4 mb-4">
                    IBAN
                </div>
                <div class="w-full border-2 bg-white border-gray-300 p-4 mb-4">
                    Balance
                </div>
            </div>
            <div class="border-2 bg-white border-gray-300 p-4">
                Assets
            </div>
        </div>
    </main>
@endsection

@section('footer')
    @parent
@endsection
