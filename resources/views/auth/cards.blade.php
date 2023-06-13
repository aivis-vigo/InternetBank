@extends('layouts.layout')

@section('title', 'I-Bank')

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="w-1/2 mx-auto">
        <div class="flex justify-left items-left p-4 bg-white rounded-lg border-2 border-gray-300 text-black">
            <div>
                <p>Add new debit card</p>
                <form action="/add-card" method="get">
                    @csrf
                    <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mt-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Add
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection
