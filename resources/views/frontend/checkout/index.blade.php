@extends('layouts.app')

@section('title', 'Checkout keranjang'. auth()->user()->name)

@section('content')

    @livewire('frontend.checkout.checkout-show');

@endsection