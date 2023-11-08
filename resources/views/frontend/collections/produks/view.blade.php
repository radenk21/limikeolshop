@extends('layouts.app')

@section('title', 'Produk')
@section('content')

{{-- <div> --}}
    @livewire('frontend.produk.view', [
        'produk' => $produk,
    ])      
{{-- </div> --}}

@endsection