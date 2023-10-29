@extends('layouts.admin')
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
                Tambah supplier
            </h3>
            <a href="{{ route('supplier.index') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="card-body">
            <form action="{{ route('supplier.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nama supplier</label>
                        <input type="text" class="form-control card-text" value="{{ old('name') }}" name="name">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email supplier</label>
                        <input type="text" class="form-control card-text" value="{{ old('email') }}" name="email">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="no_telp" class="form-label">Nomor Telepon</label><br>
                        <input type="number" name="no_telp" class="form-control" value="{{ old('no_telp') }}" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="alamat" class="form-label">Alamat Supplier</label>
                        <textarea name="alamat" class="form-control" rows="3">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror                    
                    </div>
                    <div class="col-md-12 mb-3">
                        <button class="btn btn-primary mt-2" type="submit">Tambah</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
@endsection