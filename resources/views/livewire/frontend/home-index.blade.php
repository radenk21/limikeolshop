<section class="products-index-limikeshop" id="products-index-limikeshop">
    <h1 class="heading-index-limikeshop">our <span>products</span></h1>
    <div class="box-container">
        @forelse ($produks as $produk)    
            <div class="box-content">
                @if($produk->jumlah > 0)
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
            <div class="box-content">
                Belum Ada Produk
            </div>
        @endforelse
    </div>
</section>