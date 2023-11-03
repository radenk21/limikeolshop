@extends('layouts.app')

@section('title', 'Kategori '. $kategori->name)
@section('content')

<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            @forelse ($subKategoris as $subKategori)    
                <div class="col-6 col-md-3">
                    <div class="category-card">
                        <a href="{{ url('/collections/kategori/'.$kategori->slug.'/'.$subKategori->slug) }}">
                            <div class="category-card-body">
                                <h5>{{ $subKategori->name }}</h5>
                            </div>
                        </a>
                    </div>
                </div>
                @empty
                
            @endforelse
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">Produk kami</h4>
            </div>
            @forelse ($produks as $key => $produk)
                <div class="col-md-3">
                    <div class="product-card">
                        <div class="product-card-img">
                            @if($produk->jumlah > 0)
                                <label class="stock bg-success">Stok tersedia</label>
                            @else
                                <label class="stock bg-danger">Stok tidak tersedia</label>
                            @endif
                            @if ($produk->gambarProduk->count() > 0)
                                <img src="{{ asset($produk->gambarProduk[0]->image) }}" alt="{{ $produk->name }}">
                            @endif
                        </div>
                        <div class="product-card-body">
                            <p class="product-brand">{{ $produk->brand->name }}</p>
                            <h5 class="product-name">
                                <a href="{{ url('/collections/'.$kategori->slug.'/'.$produk->slug) }}">
                                    {{ $produk->name }}
                                </a>
                            </h5>
                            <div>
                                <span class="selling-price">{{ number_format($produk->harga_jual, 0, '.', '.') }}</span>
                            </div>
                            {{-- <div class="mt-2">
                                <a href="" class="btn btn1">Add To Cart</a>
                                <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                                <a href="" class="btn btn1"> View </a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            @empty
                <div class="card">
                    Belum ada produk dengan kategori {{ $kategori->name }}
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection