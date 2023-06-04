@extends('layout')

@section('title', 'Home')

@section('navbar')
    @parent
@endsection

@section('content')
    @foreach($content as $user)
        <p>{{ $user->name }}</p>
        <p>{{ $user->email }}</p>
        <p>-------------------</p>
    @endforeach
@endsection
