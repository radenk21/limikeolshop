@extends('layouts.app')

@section('title', 'Keranjang '. ucfirst(auth()->user()->name))

@section('content')

    @livewire('frontend.keranjang.keranjang-show');

@endsection