@extends('layouts.master')

@section('title', 'Bands - BandRoster')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Band Roster</h2>
    @if(Auth::check() && Auth::user()->isAdmin())
        <a href="{{ route('bands.create') }}" class="btn btn-success">+ Add Band</a>
    @endif
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Photo</th>
                    <th>Band Name</th>
                    <th>Albums</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bands as $band)
                    <tr>
                        <td style="width: 90px;">
                            @if($band->photo)
                                <img src="{{ asset('storage/' . $band->photo) }}" alt="{{ $band->name }}" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <span class="badge bg-secondary">No Photo</span>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $band->name }}</td>
                        <td>
                            <span class="badge bg-primary rounded-pill">{{ $band->albums_count }}</span>
                        </td>
                        <td class="text-end">
                            {{-- View Albums button (visible to everyone, including guests) --}}
                            <a href="#" class="btn btn-sm btn-outline-dark">View Albums</a>

                            {{-- Edit button (authenticated users + admins) --}}
                            @auth
                                <a href="{{ route('bands.edit', $band->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            @endauth

                            {{-- Delete button (admins only) --}}
                            @if(Auth::check() && Auth::user()->isAdmin())
                                <form action="{{ route('bands.destroy', $band->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this band?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">No bands registered yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection