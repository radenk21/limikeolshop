@extends('layouts.admin')
@section('title', 'Edit Kategori')
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
                Edit Kategori
            </h3>
            <a href="{{ route('kategori.index') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="card-body">
            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nama Kategori</label>
                        <input type="text" value="{{ $kategori->name }}" class="form-control card-text" name="name">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" value="{{ $kategori->slug }}" class="form-control card-text"name="slug">
                        @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ $kategori->description }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror                    
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label">Image</label><br>
                        @if ($kategori->image)
                            <img src="{{ asset('uploads/category/'.$kategori->image) }}" width="60px" class="mb-2" height="60px" alt="">
                        @endif
                        <input type="file" class="form-control card-text" name="image">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label><br>
                        <input type="checkbox" {{ $kategori->status == '1' ? 'checked':'' }} name="status">
                    </div>
                    <div class="col-md-12 mb-3">
                        <button class="btn btn-primary mt-2" type="submit">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection