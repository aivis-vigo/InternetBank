@extends('layouts.layout')

@section('title', 'I-Bank')

@section('navbar')
    @parent
@endsection

@section('content')
    <main>
        <div class="mx-auto w-1/2">
            <div class="border-2 border-blue-300">
                Balance
            </div>
            <div class="border-2 border-blue-300">
                Assets
            </div>
        </div>
    </main>
@endsection

@section('footer')
    @parent
@endsection
