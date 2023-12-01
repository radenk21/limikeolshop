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
                                <td class="quantity">
                                    <button type="button" class="text-center" wire:loading.attr="disabled" wire:click="decrementJumlah({{ $keranjang->id }})">-</button>
                                    <input type="number" value="{{ $keranjang->jumlah }}" />
                                    <button type="button" class="text-center" wire:loading.attr="disabled" wire:click="incrementJumlah({{ $keranjang->id }})">+</button>
                                </td>
                                <td class="total-price">Rp {{ number_format($keranjang->produk->harga_jual * $keranjang->jumlah, 0, '.', '.') }} </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <h4 class="text-center mt-5">Belum ada produk yang di masukkan ke keranjang</h4>
                                </td>
                            </tr>
                        @endforelse

                    </table>
                </div>
            </div>
        </div>
        <div class="order-summary">
            <div class="order-summary-header">
                <h2> Cart Totals </h2>
            </div>
            <div class="total-cart">
                <h3>Total</h3>
                <span> Rp {{ number_format($totalHarga, 0, '.', '.') }}</span>
            </div>
            <div class="checkout-cart">
                @if($keranjangs->isNotEmpty())
                    <a href="{{ url('/checkout') }}" style="text-decoration: none" class="text-center align-item-center flex-grow width-100 pt-2">Checkout</a>
                @else
                    <span class="text-muted">Keranjang Anda kosong. Tambahkan produk terlebih dahulu.</span>
                @endif
            </div>
        </div>
    </div>
</div>

