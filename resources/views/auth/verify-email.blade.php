@extends('layouts.layout')

@section('title', 'I-Bank')

@section('navbar')
    @parent
@endsection

@section('content')

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            A new email verification link has been emailed to you!
        </div>
    @endif

@endsection

@section('footer')
    @parent
@endsection
