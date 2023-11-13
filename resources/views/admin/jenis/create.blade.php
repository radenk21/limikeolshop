@extends('layouts.admin')
@section('title', 'Tambah Jenis')
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success d-flex justify-content-between">
            {{ session()->get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
        <div class="card-header d-flex justify-content-between align-middle">
            <h3>
                Tambah Jenis
            </h3>
            <a href="{{ route('jenis.index') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="card-body">
            <form action="{{ route('jenis.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nama Jenis</label>
                        <input type="text" class="form-control card-text" value="{{ old('name') }}" name="name">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="code" class="form-label">Code Jenis</label>
                        <input type="text" class="form-control card-text" value="{{ old('code') }}" name="code">
                        @error('code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label><br>
                        <input type="checkbox" name="status" {{ old('status') }}>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button class="btn btn-primary mt-2" type="submit">Tambah</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
@endsection