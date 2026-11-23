@extends('layouts.master')

@section('title', 'Edit Album - ' . $album->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">Edit Album: {{ $album->name }}</div>
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

                <form action="{{ route('albums.update', $album->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Album Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $album->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="release_date" class="form-label">Release Date</label>
                        <input type="date" name="release_date" id="release_date" class="form-control" value="{{ old('release_date', $album->release_date) }}" required>
                    </div>

                    @if($album->image)
                        <div class="mb-3">
                            <label class="form-label d-block">Current Cover</label>
                            <img src="{{ asset('storage/' . $album->image) }}" alt="{{ $album->name }}" class="rounded bg-light p-1 border media-thumb-lg">
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="image" class="form-label">Replace Cover (Optional)</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('bands.albums.index', $album->band_id) }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-warning">Update Album</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
