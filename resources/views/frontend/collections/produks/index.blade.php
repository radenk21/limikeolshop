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
        @livewire('frontend.produk.index', [
            'kategori' => $kategori,
            'subKategori' => null,
        ])        
    </div>
</div>

@endsection