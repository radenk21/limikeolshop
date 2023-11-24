@extends('layouts.admin')
@section('title', 'Edit User')
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success d-flex justify-content-between">
            {{ session()->get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session()->has('danger-alert'))
        <div class="alert alert-danger d-flex justify-content-between">
            {{ session()->get('danger-alert') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <form action="{{ route('user.update', $user->id)  }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-middle">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-detail-user-tab" data-bs-toggle="tab" data-bs-target="#nav-detail-user" type="button" role="tab" aria-controls="nav-detail-user" aria-selected="true">Detail User</button>
                    </div>
                </nav>
                <a href="{{ route('user.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="tab-content" id="nav-tabContent">
            <div class="card tab-pane fade show active" id="nav-detail-user" role="tabpanel" aria-labelledby="nav-detail-user-tab" tabindex="0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">Nama User</label>
                            <input type="text" class="form-control card-text" value="{{ $user->name }}" name="name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control card-text" value="{{ $user->email }}" name="email">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="role_as" class="form-label">Role</label>
                            <select name="role_as" class="form-control" id="role_as">
                                <option value="">Role</option>
                                <option value="0" {{ $user->role_as == '0' ? 'selected' : '' }}>User</option>
                                <option value="1" {{ $user->role_as == '1' ? 'selected' : '' }}>Admin</option>
                                <option value="2" {{ $user->role_as == '2' ? 'selected' : '' }}>Karyawan</option>
                            </select>
                            @error('role_as')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <button class="btn btn-primary mt-2" type="submit">Update</button>
        </div>
    </form>
@endsection