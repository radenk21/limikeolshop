@extends('layouts.karyawan')
@section('title', 'Kasir')
@section('newOrderActive', 'active')
@section('content')

<div class="mt-2">
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
</div>
@livewire('karyawan.kasir.index', [
    'produks' => $produks
])

@endsection 
