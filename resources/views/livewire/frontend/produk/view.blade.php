<div class="py-3 py-md-5 bg-light">
    <div class="container">
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
        <div class="row">
            <div class="col-md-5 mt-3">
                <div class="bg-white border">
                    @if ($produk->gambarProduk->count() > 0)
                        <img src="{{ asset($produk->gambarProduk[0]->image) }}" class="w-100" alt="{{ $produk->name }}">
                    @endif
                </div>
            </div>
            <div class="col-md-7 mt-3">
                <div class="product-view">
                    <h4 class="product-name">
                        {{ $produk->name }}
                        @if ($produk->jumlah > 0)
                            <label class="label-stock bg-success">In Stock</label>
                        @else
                            <label class="label-stock bg-danger">Out of Stock</label>
                        @endif
                    </h4>
                    <hr>
                    <p class="product-path">
                        Home / {{ $produk->kategori->name }} / Product / {{ $produk->name }}
                    </p>
                    <div>
                        <span class="selling-price">Rp {{ number_format($produk->harga_jual, 0, '.', '.') }}</span>
                    </div>
                    @if ($produk->produkJenis->count() > 0)
                        @if ($produk->produkJenis)
                            @foreach ($produk->produkJenis as $produkJenis)
                                <input type="radio" name="pilihJenisProduk" id="" value="{{ $produkJenis->id }}">{{ $produkJenis->jenis->name }}
                            @endforeach
                        @endif
                    @endif
                    <div class="mt-2">
                        
                    </div>
                    <div class="mt-2">
                        <div class="input-group">
                            <span class="btn btn1" wire:click="decerementJumlah"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model="jumlahCount" value="{{ $this->jumlahCount }}" class="input-quantity" />
                            <span class="btn btn1" wire:click="incrementJumlah"><i class="fa fa-plus"></i></span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="button" wire:click="addToCart({{ $produk->id }})" class="btn btn1"> 
                            <i class="fa fa-shopping-cart"></i> Tambahkan Ke Keranjang
                        </button>
                        <button type="button" wire:click="addToWishlist({{ $produk->id }})" class="btn btn1"> 
                            <span wire:loading.remove>
                                <i class="fa fa-heart"></i> Tambahkan Ke Wishlist 
                            </span>
                            <span wire:loading wire:target="addToWishlist">
                                menambahkan 
                            </span>
                        </button>
                    </div>
                    <div class="mt-4">
                        <h5 class="mb-0">Deskripsi Singkat</h5>
                        <p>
                            {{ $produk->deskripsi }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>