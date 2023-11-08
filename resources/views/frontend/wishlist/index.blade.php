@extends('layouts.app')

@section('title', 'Wishlist'. auth()->user()->name)
@section('content')

@livewire('frontend.wishlist-show', [
    
])

@endsection