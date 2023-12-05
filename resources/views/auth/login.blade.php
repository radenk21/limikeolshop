@extends('layouts.auth')
@section('title', 'Login')

@section('content')

<a href="/" class="text-nowrap logo-img text-center d-block py-3 w-100">
    <img src="{{ asset('admin/images/backgrounds/rocket.png') }}"
    {{-- width="180" --}}
    alt="">
</a>
<p class="text-center ">Limike Olshop</p>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
    </div>
    <div class="mb-4">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" id="exampleInputPassword1" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
    </div>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="form-check">
            <input class="form-check-input primary" type="checkbox" value="" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label text-dark" for="remember">
                Ingat perangkat ini?
            </label>
        </div>
        @if (Route::has('password.request'))
            <a class="text-primary fw-bold" href="{{ route('password.request') }}">
                Lupa password?
            </a>
        @endif
        {{-- <a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a> --}}
    </div>
    {{-- <a href="./index.html" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</a> --}}
    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">
        Masuk
    </button>
    <div class="d-flex align-items-center justify-content-center">
        <p class="fs-4 mb-0 fw-bold">Belum punya akun?</p>
        <a class="text-primary fw-bold ms-2" href="{{ route('register') }}">Buat akun Limike Olshop</a>
    </div>
</form>

@endsection
