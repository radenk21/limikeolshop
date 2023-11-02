@extends('layouts.auth')
@section('title', 'Register')

@section('content')

<a href="/" class="text-nowrap logo-img text-center d-block py-3 w-100">
    <img src="{{ asset('admin/images/backgrounds/rocket.png') }}" 
    {{-- width="180"  --}}
    alt="">
</a>
<p class="text-center">Limike Olshop</p>
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="mb-3">
        <label for="exampleInputtext1" class="form-label">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus id="exampleInputtext1" aria-describedby="textHelp">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email Address</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" id="exampleInputEmail1" aria-describedby="emailHelp">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="mb-4">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" id="exampleInputPassword1">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="mb-4">
        <label for="password-confirm" class="form-label">Konfirmasi Password</label>
        <input type="password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <button type="submit" href="./index.html" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Daftar Akun</button>
    <div class="d-flex align-items-center justify-content-center">
        <p class="fs-4 mb-0 fw-bold">Sudah punya akun?</p>
        <a class="text-primary fw-bold ms-2" href="{{ route('login') }}">Masuk</a>
    </div>
</form>

@endsection
