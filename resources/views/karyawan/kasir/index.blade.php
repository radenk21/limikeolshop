@extends('layouts.karyawan')
@section('title', 'Kasir')
@section('newOrderActive', 'active')
@section('content')

@livewire('karyawan.kasir.index', [
    'produks' => $produks
])

@endsection 
