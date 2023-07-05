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

    <div class="w-1/2 p-4 mx-auto">
        <div class="flex justify-left items-left p-4 bg-white rounded-lg text-black">
            <div>
                <p>Verify your email</p>
                <form action="/email/verification-notification" method="post">
                    @csrf
                    <button
                        type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mt-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    >
                        Send link
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    @parent
@endsection
