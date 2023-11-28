@extends('layouts.karyawan')
@section('title', 'Kasir')
@section('newOrderActive', 'active')
@section('content')

@if (session('danger-alert'))
    <div class="alert alert-danger">
        {{ session('danger-alert') }}
    </div>
@endif
@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

@livewire('karyawan.kasir.index', [
    'produks' => $produks
])

@endsection
