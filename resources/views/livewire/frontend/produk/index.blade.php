<div>
    <div class="row">
        {{-- <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>Brand</h4>
                </div>
                <div class="card-body">
                    @foreach ($uniqueBrands as $brand)
                        @if ($brand->status != 1)
                            <label for="{{ $brand->name }}" class="d-block">
                                <input type="checkbox" wire:model="selectedBrands" value="{{ $brand->id }}" id="{{ $brand->name }}">
                                {{ $brand->name }}
                            </label>
                        @endif
                    @endforeach
                </div>
            </div>
        </div> --}}
        <div class="col-md-9">
            <div class="row">
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
                                    <a href="{{ url('/collections/'.$produk->slug.'/view') }}">
                                        {{ $produk->name }}
                                    </a>
                                </h5>
                                <div>
                                    <span class="selling-price">{{ number_format($produk->harga_jual, 0, '.', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="card">
                        Belum ada produk 
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    
</div>