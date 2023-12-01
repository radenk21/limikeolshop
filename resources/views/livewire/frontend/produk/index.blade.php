<div>
    <div class="mt-2">
        @if (session('danger-alert'))
            <div class="alert alert-danger">
                {{ session('danger-alert') }}
            </div>
        @endif
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <form action="" method="get">
                    <div class="card-header">
                        <h4>Brand</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($uniqueBrands as $brand)
                            @if ($brand->status != 1)
                                <label for="{{ $brand->name }}" class="d-block">
                                    <input type="checkbox" name="selectedBrands[]" value="{{ $brand->id }}" id="{{ $brand->name }}">
                                    {{ $brand->name }}
                                </label>
                            @endif
                        @endforeach
                    </div>
                    <div class="card-header">
                        <h4>Harga</h4>
                    </div>
                    <div class="card-body">
                        <h6>Urutkan</h6>
                        <label for="high-to-low" class="d-block">
                            <input type="radio" name="priceSort" id="high-to-low" value="high-to-low" > Tinggi ke Rendah
                        </label>
                        <label for="low-to-high" class="d-block">
                            <input type="radio" name="priceSort" id="low-to-high" value="low-to-high"> Rendah ke Tinggi
                        </label>
                        <h6 class="mt-2">Rentang harga</h6>
                        <div class="row px-2 mt-1">
                            <input type="number" name="harga_minimum" placeholder="Masukkan harga minimum..." id="harga_minimum" class="form-control">
                        </div>
                        <div class="row px-2 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-switch-horizontal" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16 3l4 4l-4 4" /><path d="M10 7l10 0" /><path d="M8 13l-4 4l4 4" /><path d="M4 17l9 0" /></svg>
                        </div>
                        <div class="row px-2 mt-1">
                            <input type="number" name="harga_maksimum" placeholder="Masukkan harga maksimum..." id="harga_maksimum" class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary m-3">Filter</button>
                </form>
            </div>
        </div>
        <div class="col-md-9">
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
    
</div>