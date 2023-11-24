@extends('layouts.app')

@section('title', 'Sub Kategori ' .$subKategori->name)
@section('content')

<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">Produk dengan Sub Kategori {{ $subKategori->name }}</h4>
            </div>
            {{-- @livewire('frontend.produk.index', [
            'produks' => $produks,
            'kategori' => null,
            'subKategoris' => null,
            'uniqueBrands' => $uniqueBrands,
            ]) --}}
            @livewire('frontend.produk.index', [
            'kategori' => $kategori,
            'subKategori' => $subKategori,
            ])
        </div>
    </div>
</div>

@endsection