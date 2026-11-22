@extends('layouts.master')

@section('title', 'Edit Band - BandRoster')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">Edit Band: {{ $band->name }}</div>
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

                <form action="{{ route('bands.update', $band->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Band Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $band->name) }}" required>
                    </div>

                    @if($band->photo)
                        <div class="mb-3">
                            <label class="form-label d-block">Current Photo</label>
                            <img src="{{ asset('storage/' . $band->photo) }}" alt="{{ $band->name }}" class="rounded bg-light p-1 border media-thumb-lg">
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="photo" class="form-label">Replace Photo (Optional)</label>
                        <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('bands.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-warning">Update Band</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection