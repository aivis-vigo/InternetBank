@extends('layouts.layout')

@section('title', 'I-Bank')

@section('navbar')
    @parent
@endsection

@section('content')
    <main>
        <div class="mx-auto w-1/2">
            <div class="flex gap-x-4">
                <div class="w-full border-2 bg-white border-gray-300 rounded-lg p-4 mb-4">
                    {{ $account->IBAN }}
                </div>
                <div class="w-full border-2 bg-white border-gray-300 rounded-lg p-4 mb-4">
                    &euro; {{ $account->balance / 100 }}
                </div>
            </div>
            <div class="border-2 bg-white border-gray-300 rounded-lg p-4">
                @forelse($coins as $coin)
                    <div class="flex justify-between my-2 p-4 bg-gray-200 hover:bg-gray-300 rounded-lg">
                        <div>
                            {{ $coin->name }}
                        </div>
                        <div>
                            {{ $coin->price }}
                        </div>
                        <div>
                            {{ $coin->amount }} {{ $coin->symbol }}
                        </div>
                    </div>
                @empty
                    Nothing to show
                @endforelse
            </div>
        </div>
    </main>
@endsection

@section('footer')
    @parent
@endsection
