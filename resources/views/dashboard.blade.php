@extends('layouts.master')

@section('title', 'Dashboard - BandRoster')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h3 class="card-title">Olá, {{ Auth::user()->name }}!</h3>
        <p class="text-muted mb-3">
            Role:
            @if(Auth::user()->isAdmin())
                <span class="badge bg-warning text-dark">Administrator</span>
            @else
                <span class="badge bg-secondary">Authenticated User</span>
            @endif
        </p>

        <div class="d-flex gap-2">
            <a href="{{ url('/') }}" class="btn btn-dark">Manage Bands</a>
            @if(Auth::user()->isAdmin())
                <a href="{{ route('bands.create') }}" class="btn btn-success">+ Add New Band</a>
            @endif
        </div>
    </div>
</div>
@endsection
