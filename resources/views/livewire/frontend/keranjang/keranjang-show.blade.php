{{-- <div class="py-3 py-md-5 bg-light">
    <div class="container">
        <h4>Keranjang ku</h4>
        <hr>
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
            <div class="col-md-12">
                <div class="shopping-cart">

                    <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                        <div class="row">
                            <div class="col-md-4">
                                <h4>Produk</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Harga</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Jumlah</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Total Harga</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Remove</h4>
                            </div>
                        </div>
                    </div>

                    @forelse ($keranjangs as $keranjang)
                        <div class="cart-item">
                            <div class="row">
                                <div class="col-md-4 my-auto">
                                    <a href="{{ url('/collections/'.$keranjang->produk->slug.'/view') }}">
                                        <label class="product-name">
                                            @if ($keranjang->produk->gambarProduk->count() > 0)
                                                <img src="{{ $keranjang->produk->gambarProduk[0]->image }}" style="width: 50px; height: 50px" alt="{{ $keranjang->produk->name }}">
                                            @else
                                                <img src="" style="width: 50px; height: 50px" alt="">
                                            @endif
                                            {{ $keranjang->produk->name }}
                                        </label>
                                    </a>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <label class="price">Rp {{ number_format($keranjang->produk->harga_jual, 0, '.', '.') }} </label>
                                </div>
                                <div class="col-md-2 col-7 my-auto">
                                    <div class="quantity">
                                        <div class="input-group">
                                            <button type="button" wire:loading.attr="disabled" wire:click="decrementJumlah({{ $keranjang->id }})" class="btn btn1"><i class="fa fa-minus"></i></button>
                                                <input type="text" value="{{ $keranjang->jumlah }}" class="input-quantity" />
                                            <button type="button" wire:loading.attr="disabled" wire:click="incrementJumlah({{ $keranjang->id }})" class="btn btn1"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <label class="price">Rp {{ number_format($keranjang->produk->harga_jual * $keranjang->jumlah, 0, '.', '.') }} </label>
                                </div>
                                <div class="col-md-2 col-5 my-auto">
                                    <div class="remove">
                                        <button type="button" wire:loading.attr="disabled" wire:click="removeKeranjangitem({{ $keranjang->id }})" href="" class="btn btn-danger btn-sm">
                                            <span wire:loading.remove wire:target="removeKeranjangitem({{ $keranjang->id }})">
                                                <i class="fa fa-trash"></i> Hapus
                                            </span>
                                            <span wire:loading wire:target="removeKeranjangitem({{ $keranjang->id }})" >Menghapus</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h4 class="text-center mt-5">Belum ada produk yang di masukkan ke keranjang</h4>
                    @endforelse
                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 my-md-auto mt-3">
                <h4>
                    Dapatkan harga dan penawaran menarik <a href="{{ url('/collections') }}">belanja sekarang</a>
                </h4>
            </div>
            <div class="col-md-4 mt-3">
                <div class="shadow-sm bg-white p-3">
                    <h4>Total Harga :
                        <span class="float-end">
                            Rp {{ number_format($totalHarga, 0, '.', '.') }}
                        </span>
                    </h4>
                    <hr>
                    <a href="{{ url('/checkout') }}" class="btn btn-warning w-100">Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container mt-5">
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
    <div class="cart">
        <div class="shopping-cart">
            <div class="shopping-cart-header">
                <h2>Your Shopping Cart</h2>
            </div>
            <div class="item-info">
                <div class="order-item-info"> 
                    <div class="order-item-heading">
                        <span></span>
                        <span></span>
                        <p class="product-name"> Product </p>
                        <p class="Price"> Price </p>
                        <p> Quantity </p>
                        <p> Subtotal </p>
                    </div>
                    @forelse ($keranjangs as $keranjang)
                        <div class="order-item">
                            <button type="button" wire:loading.attr="disabled" wire:click="removeKeranjangitem({{ $keranjang->id }})">
                                <span wire:loading.remove wire:target="removeKeranjangitem({{ $keranjang->id }})">
                                    <i class="fa-solid fa-trash"></i>
                                </span>
                                <span wire:loading wire:target="removeKeranjangitem({{ $keranjang->id }})" >Menghapus</span>
                            </button>
                            <a href="{{ url('/collections/'.$keranjang->produk->slug.'/view') }}">
                                @if ($keranjang->produk->gambarProduk->count() > 0)
                                    <img src="{{ $keranjang->produk->gambarProduk[0]->image }}" style="width: 100px; height: 100px" alt="{{ $keranjang->produk->name }}">
                                @else
                                    <img src="" style="width: 100px; height: 100px" alt="">
                                @endif
                            </a>
                            <a href="{{ url('/collections/'.$keranjang->produk->slug.'/view') }}" style="text-decoration: none">
                                <p class="Product-name"> {{ $keranjang->produk->name }} </p>
                            </a>
                            <p class="harga"> Rp {{ number_format($keranjang->produk->harga_jual, 0, '.', '.') }} </p>
                            
                            <span class="qty">
                                <div class="quantity">
                                    <div class="input-group">
                                        <button type="button" wire:loading.attr="disabled" wire:click="decrementJumlah({{ $keranjang->id }})" class="btn btn1"><i class="fa fa-minus"></i></button>
                                            <input type="text" value="{{ $keranjang->jumlah }}" class="input-quantity" />
                                        <button type="button" wire:loading.attr="disabled" wire:click="incrementJumlah({{ $keranjang->id }})" class="btn btn1"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </span>
                            <label class="Subtotal">Rp {{ number_format($keranjang->produk->harga_jual * $keranjang->jumlah, 0, '.', '.') }} </label>
                        </div>
                    @empty
                        <h4 class="text-center mt-5">Belum ada produk yang di masukkan ke keranjang</h4>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="order-summary">
            <div class="order-summary-header">
                <h2> Cart Totals </h2>
            </div>
            <div class="order-summary-subtotals">
                <h3> Subtotal </h3>
                <p> Rp 900. 000</p>
            </div>
            <div class="shipping">
                <h3> Shipping </h3>
                <div class="option-shipping">
                    <span><input type="radio" id="shipping" name="shipping" class="hidden-radio">
                            <label for="shipping" class="label-radio"> Free Shipping</label>
                    </span>
                    <span><input type="radio" id="shipping" name="shipping" class="hidden-radio">
                            <label for="shipping" class="label-radio"> Go Pocket :</label> <span class="shipping-price"> Rp. 10.000</span>
                    </span>
                    <span><input type="radio" id="shipping" name="shipping" class="hidden-radio">
                            <label for="shipping" class="label-radio"> JNE :</label> <span class="shipping-price"> Rp. 25.000</span>
                    </span>
                </div>
            </div>
            <div class="total-cart">
                <h3>Total</h3>
                <span> Rp {{ number_format($totalHarga, 0, '.', '.') }}</span>
            </div>
            
            <div class="checkout-cart">
                <a href="{{ url('/checkout') }}" class="btn btn-warning w-100">Checkout</a>
            </div>
        </div>
    </div>
</div>

