@extends('layouts.app')

@section('title', 'Home Page')
@section('content')
@push('css')
    
@endpush
<x-sliders></x-sliders>
<div class="container">

    @livewire('frontend.home-index')          
    <!-- products section ends -->
</div>
@endsection