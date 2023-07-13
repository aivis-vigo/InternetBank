@extends('layouts.layout')

@section('title', 'I-Bank')

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="h-full w-full text-white">
        <div class="w-1/2 mt-6 mx-auto">
            <div
                class="flex justify-left items-left p-4 bg-white rounded-lg border-2 border-gray-300 text-black dark:bg-gray-900 dark:text-white">
                <div>
                    <p>Edit profile info</p>
                    <form action="/profile/edit" method="get">
                        @csrf
                        <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mt-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Edit
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="w-1/2 my-6 mx-auto">
            <div
                class="flex justify-left items-left p-4 bg-white rounded-lg border-2 border-gray-300 text-black dark:bg-gray-900 dark:text-white">
                <div>
                    <p>Verify your email</p>
                    <form action="/email/verification-notification" method="post">
                        @csrf
                        <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mt-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Send link
                        </button>

                        @if (session('status') == 'verification-link-sent')
                            <div class="mt-2 font-medium text-sm text-green-600">
                                A new email verification link has been emailed to you!
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        @if (session('status') === 'two-factor-authentication-enabled')
            <div
                class="w-1/2 mx-auto text-black bg-white my-6 p-4 rounded-lg border-2 border-gray-300 dark:bg-gray-900 dark:text-white">
                <div class="mb-4 font-medium text-green-500">
                    Two factor authentication has been enabled for your account
                </div>
                <div class="flex justify-center">
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
                </div>

                @if (request()->user()->two_factor_secret)
                    <div class="w-full mx-auto">
                        <div class="flex justify-left items-left my-6 bg-white rounded-lg text-black dark:bg-gray-900 dark:text-white">
                            <div>
                                <p>You have two-factor authentication enabled</p>
                                <form
                                    action="/user/two-factor-authentication"
                                    method="post"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mt-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                    >
                                        Disable 2FA
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @else
            @if (request()->user()->two_factor_secret)
                <div class="w-1/2 mx-auto">
                    <div
                        class="flex justify-left items-left p-4 bg-white rounded-lg border-2 border-gray-300 text-black dark:bg-gray-900 dark:text-white">
                        <div>
                            <p>You have two-factor authentication enabled</p>
                            <form action="/user/two-factor-authentication" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mt-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    Disable 2FA
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="w-1/2 mx-auto">
                    <div
                        class="flex justify-left items-left p-4 bg-white rounded-lg border-2 border-gray-300 text-black dark:bg-gray-900 dark:text-white">
                        <div>
                            <p>You don't have two-factor authentication enabled</p>
                            <form action="/user/two-factor-authentication" method="post">
                                @csrf
                                <button type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mt-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    Enable 2FA
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
@endsection

@section('footer')
    @parent
@endsection
