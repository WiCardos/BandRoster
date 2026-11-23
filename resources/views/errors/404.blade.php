@extends('layouts.master')

@section('title', '404 Not Found - BandRoster')

@section('content')
    <div class="py-12 text-center">
        <h1 class="text-4xl font-bold mb-4">404</h1>
        <p class="text-gray-600 mb-6">The page you are looking for does not exist.</p>
        <a href="{{ route('bands.index') }}" class="underline">Return to Band Roster</a>
    </div>
@endsection
