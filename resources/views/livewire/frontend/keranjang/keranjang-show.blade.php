
{{-- <div class="container mt-5">
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
                    <span><input type="radio" id="freeShipping" name="shipping" class="hidden-radio">
                            <label for="freeShipping" class="label-radio"> Free Shipping</label>
                    </span>
                    <span><input type="radio" id="GoPocket" name="shipping" class="hidden-radio">
                            <label for="GoPocket" class="label-radio"> Go Pocket :</label> <span class="shipping-price"> Rp. 10.000</span>
                    </span>
                    <span><input type="radio" id="JNE" name="shipping" class="hidden-radio">
                            <label for="JNE" class="label-radio"> JNE :</label> <span class="shipping-price"> Rp. 25.000</span>
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
</div> --}}

<div class="container">
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
    <div class="cart">
        <div class="shopping-cart">
            <div class="shopping-cart-header">
                <h2>Your Shopping Cart</h2>
            </div>
            <div class="item-info">
                <div class="order-item-info"> 
                    <table>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th class="text-center">Jumlah</th>
                            <th>Total Harga</th>
                        </tr>
                        @forelse ($keranjangs as $keranjang)
                            <tr class="product-row">
                                <td>
                                    <button type="button" wire:loading.attr="disabled" wire:click="removeKeranjangitem({{ $keranjang->id }})">
                                        <span wire:loading.remove wire:target="removeKeranjangitem({{ $keranjang->id }})">
                                            <i class="fa-solid fa-trash"></i>
                                        </span>
                                        <span wire:loading wire:target="removeKeranjangitem({{ $keranjang->id }})" >Menghapus</span>
                                    </button>
                                </td>
                                <td>
                                    <a href="{{ url('/collections/'.$keranjang->produk->slug.'/view') }}">
                                        @if ($keranjang->produk->gambarProduk->count() > 0)
                                            <img src="{{ $keranjang->produk->gambarProduk[0]->image }}" class="product-image" alt="{{ $keranjang->produk->name }}">
                                        @else
                                            <img src="" alt="{{ $keranjang->produk->name }}">
                                        @endif
                                    </a>
                                </td>
                                <td class="cart-product-name">
                                    <a href="{{ url('/collections/'.$keranjang->produk->slug.'/view') }}" style="text-decoration: none;color: #212529 ">
                                        {{ $keranjang->produk->name }}
                                    </a>
                                </td>

                                <td>Rp {{ number_format($keranjang->produk->harga_jual, 0, '.', '.') }}</td>
                                <td class="quantity ps-2 d-flex justtify-content-center">
                                    <button type="button" class="text-center" wire:loading.attr="disabled" wire:click="decrementJumlah({{ $keranjang->id }})">-</button>
                                    <input type="number" value="{{ $keranjang->jumlah }}" />
                                    <button type="button" class="text-center ms-2" wire:loading.attr="disabled" wire:click="incrementJumlah({{ $keranjang->id }})">+</button>
                                </td>
                                <td class="total-price">Rp {{ number_format($keranjang->produk->harga_jual * $keranjang->jumlah, 0, '.', '.') }} </td>
                            </tr>
                        @empty
                            <h4 class="text-center mt-5">Belum ada produk yang di masukkan ke keranjang</h4>
                        @endforelse
                        
                    </table>
                </div>
            </div>
        </div>
        <div class="order-summary">
            <div class="order-summary-header">
                <h2> Cart Totals </h2>
            </div>
            <div class="order-summary-subtotals">
                <h3> Subtotal </h3>
                <p> Rp {{ number_format($totalHarga, 0, '.', '.') }}</p>
            </div>
            <div class="shipping">
                <h3> Shipping </h3>
                <div class="option-shipping">
                    <span>
                        <input type="radio" id="freeShipping" name="shipping" class="hidden-radio">
                        <label for="freeShipping" class="label-radio"> Free Shipping</label>
                    </span>
                    <span>
                        <input type="radio" id="GoPocket" name="shipping" class="hidden-radio">
                        <label for="GoPocket" class="label-radio"> Go Pocket :</label> <span class="shipping-price"> Rp. 10.000</span>
                    </span>
                    <span>
                        <input type="radio" id="JNE" name="shipping" class="hidden-radio">
                        <label for="JNE" class="label-radio"> JNE :</label> <span class="shipping-price"> Rp. 25.000</span>
                    </span>
                </div>
            </div>
            <div class="total-cart">
                <h3>Total</h3>
                <span> Rp {{ number_format($totalHarga, 0, '.', '.') }}</span>
            </div>
            <div class="checkout-cart">
                <a href="{{ url('/checkout') }}" style="text-decoration: none" class="text-center align-item-center flex-grow width-100 pt-2">Checkout</a>
            </div>
        </div>
    </div>
</div>

