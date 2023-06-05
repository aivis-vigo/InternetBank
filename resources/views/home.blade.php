@extends('layout')

@section('title', 'Home')

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="bg-gradient-to-r from-yellow-500 to-pink-500">
        @foreach($content as $user)
            <p>{{ $user->name }}</p>
            <p>{{ $user->email }}</p>
            <p>-------------------</p>
        @endforeach
    </div>
@endsection

@section('footer')
    @parent
@endsection
