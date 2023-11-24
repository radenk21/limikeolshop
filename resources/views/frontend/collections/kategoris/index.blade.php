@extends('layouts.app')

@section('title', 'Semua Kategori')
@section('content')
<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">Semua Kategori</h4>
            </div>
            @forelse ($kategoris as $kategori)
                <div class="col-6 col-md-3">
                    <div class="category-card p-3">
                        <a href="{{ url('/collections/kategori/'.$kategori->slug) }}">
                            <div class="category-card-body">
                                <h5>{{ $kategori->name }}</h5>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-6 col-md-3">
                    Belum ada kategori
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection