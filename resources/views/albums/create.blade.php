@extends('layouts.master')

@section('title', 'Add Album - ' . $band->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">Add Album for {{ $band->name }}</div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('bands.albums.store', $band->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Album Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="release_date" class="form-label">Release Date</label>
                        <input type="date" name="release_date" id="release_date" class="form-control" value="{{ old('release_date') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Cover Image (Optional)</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('bands.albums.index', $band->id) }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">Save Album</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
