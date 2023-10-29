@extends('layouts.admin')
@section('title', 'Edit Slider')
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
                Edit Sub Kategori
            </h3>
            <a href="{{ route('sub-kategori.index') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="card-body">
            <form action="{{ route('sub-kategori.update', $subKategori->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nama Kategori</label>
                        <input type="text" value="{{ $subKategori->name }}" class="form-control card-text" name="name">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="id_kategori" class="form-label">Kategori Utama</label>
                        <select name="id_kategori" class="form-control" id="">
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" value="{{ $subKategori->slug }}" class="form-control card-text"name="slug">
                        @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ $subKategori->description }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror                    
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label><br>
                        <input type="checkbox" {{ $subKategori->status == '1' ? 'checked':'' }} name="status">
                    </div>
                    <div class="col-md-12 mb-3">
                        <button class="btn btn-primary mt-2" type="submit">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection