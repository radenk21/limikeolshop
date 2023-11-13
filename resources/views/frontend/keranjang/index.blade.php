@extends('layouts.app')

@section('title', 'Keranjang'. auth()->user()->name)

@section('content')

    @livewire('frontend.keranjang.keranjang-show');

@endsection