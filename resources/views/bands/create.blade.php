@extends('layouts.master')

@section('title', 'Add Band - BandRoster')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">Add New Band</div>
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

                <form action="{{ route('bands.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Band Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="photo" class="form-label">Band Photo (Optional)</label>
                        <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('bands.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">Save Band</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection