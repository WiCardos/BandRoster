@extends('layouts.master')

@section('title', $band->name . ' - Albums - BandRoster')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <a href="{{ route('bands.index') }}" class="text-decoration-none text-muted">&larr; Back to Bands</a>
        <h2 class="mt-1">{{ $band->name }} — Discography</h2>
    </div>
    @if(Auth::check() && Auth::user()->isAdmin())
        <a href="{{ route('bands.albums.create', $band->id) }}" class="btn btn-success">+ Add Album</a>
    @endif
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Cover</th>
                    <th>Album Name</th>
                    <th>Release Date</th>
                    @auth
                        <th class="text-end">Actions</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @forelse($albums as $album)
                    <tr>
                        <td style="width: 90px;">
                            @if($album->image)
                                <img src="{{ asset('storage/' . $album->image) }}" alt="{{ $album->name }}" class="rounded bg-light p-1 border media-thumb">
                            @else
                                <span class="badge bg-secondary">No Cover</span>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $album->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($album->release_date)->format('d/m/Y') }}</td>
                        @auth
                            <td class="text-end">
                                <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                @if(Auth::user()->isAdmin())
                                    <form action="{{ route('albums.destroy', $album->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this album?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                @endif
                            </td>
                        @endauth
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">No albums registered for {{ $band->name }} yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
