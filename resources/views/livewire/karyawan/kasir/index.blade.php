<div class="container kasir">
    
    <div class="product">
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
                <span class="total-harga"> Rp {{ number_format($keranjang->produk->harga_jual * $keranjang->jumlah, 0, '.', '.') }} </span>
            </div>
        @empty
            <div class="checkout-item mt-5 text-center">
                <h2>Belum Ada Produk Di Pesan</h2>
            </div>
        @endforelse
        <div class="total-price my-3">
            <h5>Harga total:</h5>
            <div class="total-checkout ">
                <span> Rp {{ number_format($totalHarga, 0, '.', '.') }} </span>
            </div>
        </div>

        <!-- Tombol untuk membuka modal -->
        @if($keranjangs->isNotEmpty())
            <button type="button" class="total-checkout" data-bs-toggle="modal" data-bs-target="#checkoutModal">
                Checkout Pesanan
            </button>
        @endif

        <!-- Modal -->
        <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Konfirmasi Checkout Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checkup-list" width="50" height="50" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 14h.01" /><path d="M9 17h.01" /><path d="M12 16l1 1l3 -3" /></svg>
                    <p>Checkout Pesanan?</p>
                <!-- Tambahkan elemen HTML lainnya sesuai kebutuhan -->
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn" style="background-color: #2a3547;color:white;" data-bs-dismiss="modal" wire:click="checkoutKeranjang({{ Auth::user()->id }})">Checkout</button>
                </div>
            </div>
            </div>
        </div>

        {{-- <script>
            // Fungsi untuk menangani checkout (gantilah dengan logika sesuai kebutuhan)
            function confirmCheckout() {
            // Lakukan tindakan checkout di sini
            // ...
            // Tutup modal setelah berhasil checkout
            $('#checkoutModal').modal('hide');
            }
        </script> --}}

    </div>
</div>
