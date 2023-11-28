<div class="container kasir">
    <div class="product">
        <div class="product-header">
            <div class="filter">
                <i class="fa-solid fa-bars"></i>
                <span>Filter</span>
                <div class="product-dropdown">
                    <a href="#" class="a-link">Item 1</a>
                    <a href="#" class="a-link">Item 2</a>
                    <a href="#" class="a-link">Item 3</a>
                </div>
            </div>
            <div class="search-kasir">
                <form action="">
                    <input type="search" id="search" name="search" placeholder="Search . . ." autocomplete="off">
                    <label for="search"></label>
                    <button class="search" type="submit"> <i class="fa-solid fa-magnifying-glass"></i> </button>
                </form>
            </div>
        </div>
            <div class="product-item">
                @forelse ($produks as $produk)
                    <div class="card" wire:click="addToCart({{ $produk->id }})">
                        @if ($produk->gambarProduk->count() > 0)
                            <img src="{{ asset($produk->gambarProduk[0]->image) }}" alt="{{ $produk->name }}">
                        @else
                            <img src="{{ asset('assets/basic/no-image.jpg') }}" alt="{{ $produk->name }}">
                        @endif
                        <h3>{{ $produk->name }}</h3>
                        <p>Harga: Rp {{ number_format($produk->harga_jual, 0, '.', '.') }}</p>
                    </div>
                @empty
                    <div>Belum Produk Yang Tersedia</div>
                @endforelse
            </div>
    </div>

    <div class="checkout">
        <h1>Checkout</h1>
        @forelse ($keranjangs as $keranjang)
            <div class="checkout-item">
                <span wire:loading.attr="disabled" wire:click="removeKeranjangitem({{ $keranjang->id }})">
                    <span wire:loading.remove wire:target="removeKeranjangitem({{ $keranjang->id }})">
                        <i class="fa-solid fa-trash"></i>
                    </span>
                    <span wire:loading wire:target="removeKeranjangitem({{ $keranjang->id }})" >Menghapus</span>
                </span>
                
                <span> {{ $keranjang->produk->name }} </span>
                <div class="div-qty">
                    <button wire:loading.attr="disabled" wire:click="decrementJumlah({{ $keranjang->id }})" type="button"><i class="fa-solid fa-circle-minus"></i></button>
                    <input type="number" name="qty-input" id="qty-input" value="{{ $keranjang->jumlah }}">
                    <label for="qty-input"></label>
                    <button wire:loading.attr="disabled" wire:click="incrementJumlah({{ $keranjang->id }})" type="button"><i class="fa-solid fa-circle-plus"></i> </button>
                </div>
                <span class="total-harga"> Rp {{ number_format($keranjang->produk->harga_jual, 0, '.', '.') }} </span>
            </div>
        @empty
            <div class="checkout-item mt-5 text-center">
                <h2>Belum Produk Yang Masuk</h2>
            </div>
        @endforelse
        <div class="total-checkout">
            <span> Rp {{ number_format($totalHarga, 0, '.', '.') }} </span>
        </div>
    
    </div>
</div>