@extends('layouts.admin')
@section('title', 'Edit Brand')
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
                Edit Brand
            </h3>
            <a href="{{ route('brand.index') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="card-body">
            <form action="{{ route('brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nama Brand</label>
                        <input type="text" value="{{ $brand->name }}" class="form-control card-text" name="name">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" value="{{ $brand->slug }}" class="form-control card-text"name="slug">
                        @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label><br>
                        <input type="checkbox" {{ $brand->status == '1' ? 'checked':'' }} name="status">
                    </div>
                    <div class="col-md-12 mb-3">
                        <button class="btn btn-primary mt-2" type="submit">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection