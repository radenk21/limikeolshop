@extends('layouts.app')

@section('title', 'Kategori '. $kategori->name)
@section('content')

<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            @if ($subKategoris)
                <div class="col-md-12">
                    <h4 class="mb-4">Sub Kategori</h4>
                </div>
                @forelse ($subKategoris as $subKategori)    
                    <div class="col-6 col-md-3">
                        <div class="category-card">
                            
                            <a href="{{ url('/collections/kategori/'.$kategori->slug.'/'.$subKategori->slug) }}">
                                <div class="category-card-body">
                                    <h5>{{ $subKategori->name }}</h5>
                                </div>
                            </a>
                        </div>
                        {{-- <label class="d-block">
                            <input type="radio" wire:model="subKategoriInput" name="subKategoriInput" value="{{ $subKategori->id }}"> {{ $subKategori->name }}
                        </label> --}}
                    </div>
                    @empty
                    
                @endforelse
            @endif
        </div>
        <div class="row">
                @forelse ($produks as $produk)    
                    <div class="box-content me-2">
                        @if($produk->jumlah > 0)
                            {{-- <label class="stock bg-success">Stok tersedia</label> --}}
                            <span class="discount bg-success">Stok tersedia</span>

                        @else
                            <span class="discount bg-danger">Stok tidak tersedia</span>
                        @endif
                        <div class="image">
                            @if ($produk->gambarProduk->count() > 0)
                                <img src="{{ asset($produk->gambarProduk[0]->image) }}" alt="{{ $produk->name }}">
                            @else
                                <img src="{{ asset('assets/basic/no-image.jpg') }}" alt="{{ $produk->name }}">
                            @endif
                            <div class="icons">
                                <button type="button" wire:click="addToWishlist({{ $produk->id }})"  class="fas fa-heart"></button>
                                <a href="{{ url('/collections/'.$produk->slug.'/view') }}" class="cart-btn">Lihat Produk</a>
                            </div>
                        </div>
                        <div class="content">
                            <h3>{{ $produk->name }}</h3>
                            <div class="harga-index">Rp {{ number_format($produk->harga_jual, 0, '.', '.') }}</div>
                        </div>
                    </div>
                @empty
                    <h4 class="text-center text-mute mt-5">
                        Belum ada produk
                    </h4>
                @endforelse
            </div>        
    </div>
</div>

@endsection