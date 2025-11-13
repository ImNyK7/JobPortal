@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center mt-24">
    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">
            Welcome, {{ Auth::user()->name }}!
        </h2>
        <p class="text-gray-600">You are now logged in.</p>
    </div>
</div>
@endsection
