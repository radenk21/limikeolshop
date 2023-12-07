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
        <div class="detail-produk">
            <div class="image-detail-produk">
                @if ($produk->jumlah > 0)
                    <div class="label-image-detail-produk">
                        <h2 class="total-item-left">{{ $produk->jumlah }}</h2>
                        <span> Item Left </span>
                    </div>
                    @else
                    <div class="label-image-detail-produk bg-danger">
                        <span class="">Out of Stock</span>
                    </div>
                    @endif

                @if ($produk->gambarProduk->count() > 0)
                    <img src="{{ asset($produk->gambarProduk[0]->image) }}" alt="">
                @else
                    <img src="{{ asset('assets/basic/no-image.jpg') }}" alt="">
                @endif
            </div>

            <div class="spek-produk">
                    <a href="javascript:history.back()" style="text-decoration: none">
                        < Back
                    </a>
                    <h1>{{ $produk->name }}</h1>
                    <span class="price">Rp {{ number_format($produk->harga_jual, 0, '.', '.') }}</span>
                    <div class="brand-produk-detail">
                        <span>Brand</span>
                        <p class="brand-name text-align-center mt-3">{{ $produk->brand->name }}</p>
                    </div>
                    {{-- <div class="color-produk-detail">
                        <span> Color </span>
                        @if ($produk->produkJenis->count() > 0)
                            @if ($produk->produkJenis)
                                @foreach ($produk->produkJenis as $produkJenis)
                                <p>
                                    <input type="radio" name="pilihJenisProduk" id="" value="{{ $produkJenis->id }}">
                                    <label for="{{ $produkJenis->id }}">{{ $produkJenis->jenis->name }}</label>
                                </p>
                                @endforeach
                            @endif
                        @endif
                        <p>Red</p>
                        <p>Blue</p>
                    </div> --}}
                    <div class="quantity">
                        <p class="mt-3"> Quantity </p>
                        <span wire:click="decerementJumlah">-</span>
                        <input type="number" wire:model="jumlahCount" value="{{ $this->jumlahCount }}" class="" id="qty"/>
                        <label for="qty"></label>
                        <span wire:click="incrementJumlah">+</span>
                    </div>
                    <div class="row d-flex add-to-cart-div">
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <button type="button" wire:click="addToCart({{ $produk->id }})" class="add-to-cart"> Add To Cart</button>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <button type="button" wire:click="addToWishlist({{ $produk->id }})"  class="add-to-cart">
                                <span wire:loading.remove>
                                    Add To Wishlist
                                </span>
                                <span wire:loading wire:target="addToWishlist">
                                    Adding
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="description-product mt-5">
                        <span>Description</span>
                        <p class="desc">
                            {{ $produk->deskripsi }}
                        </p>
                    </div>
            </div>
        </div>
    </div>
</div>
