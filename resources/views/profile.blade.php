@extends('layouts.layout')

@section('title', 'I-Bank')

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="h-full w-full text-white">
        @if (session('status') === 'two-factor-authentication-enabled')
            <div class="mb-4 font-medium text-green-500">
                Two factor authentication has been enabled for your account
            </div>

            <div class="mb-8">
                <h3 class="font-semibold text-lg mb-4">
                    Scan this QR code into your authenticator app
                </h3>
                {!! request()->user()->twoFactorQrCodeSvg() !!}
            </div>

            <div class="mb-8">
                <h3 class="font-semibold text-lg mb-4">
                    Record these recovery codes in a safe place in case you can't access your authenticator app
                </h3>
                @foreach(request()->user()->recoveryCodes() as $code)
                    {{ $code }}<br>
                @endforeach
            </div>
        @endif

        @if (request()->user()->two_factor_secret)
            <p>You have two-factor authentication enabled</p>
            <form action="/user/two-factor-authentication" method="post">
                @csrf
                @method('DELETE')
                <button class="p-4 bg-blue-500 rounded-xl">
                    Disable 2FA
                </button>
            </form>
        @else
            <p>You don't have two-factor authentication enabled</p>
            <form action="/user/two-factor-authentication" method="post">
                @csrf
                <button class="p-4 bg-blue-500 rounded-xl">
                    Enable 2FA
                </button>
            </form>
        @endif
    </div>
@endsection

@section('footer')
    @parent
@endsection
