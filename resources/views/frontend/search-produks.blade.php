@extends('layouts.app')

@section('title', 'Hasil Pencarian Produk')
@section('content')
    @push('css')
        
    @endpush
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <h4>Hasil Search : 
                    <a class="fw-bold me-2 fst-italic link-dark link-underline-dark">{{ Request::get('search_produk') }}</a>
                </h4>
                <div class="mb-4"></div>
            </div>
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
                    Sepertinya, produk yang anda cari belum dapat kami temukan
                </h4>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mood-sad-filled" width="50" height="50" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-5 9.86a4.5 4.5 0 0 0 -3.214 1.35a1 1 0 1 0 1.428 1.4a2.5 2.5 0 0 1 3.572 0a1 1 0 0 0 1.428 -1.4a4.5 4.5 0 0 0 -3.214 -1.35zm-2.99 -4.2l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm6 0l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007z" stroke-width="0" fill="currentColor" /></svg>
            @endforelse
        </div>
    </div>
@endsection