@extends('layouts.admin')
@section('title', 'Edit Jenis')
@section('content')
    @if(session('message'))
        <div class="alert alert-success d-flex justify-content-between">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
        <div class="card-header d-flex justify-content-between align-middle">
            <h3>
                Edit Jenis
            </h3>
            <a href="{{ route('jenis.index') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="card-body">
            <form action="{{ route('jenis.update', $jenis->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nama Brand</label>
                        <input type="text" value="{{ $jenis->name }}" class="form-control card-text" name="name">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="code" class="form-label">Code Jenis</label>
                        <input type="text" value="{{ $jenis->code }}" class="form-control card-text"name="code">
                        @error('code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label><br>
                        <input type="checkbox" {{ $jenis->status == '1' ? 'checked':'' }} name="status">
                    </div>
                    <div class="col-md-12 mb-3">
                        <button class="btn btn-primary mt-2" type="submit">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection