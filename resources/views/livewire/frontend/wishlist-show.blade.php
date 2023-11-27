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

         <div class="wishlist">
        <div class="wishlist-contents">
            <div class="shopping-cart-header">
                <h2>YourWishlist</h2>
            </div>
            <div class="item-info">
                <div class="order-item-info">
                    <table>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th></th>
                            <th>Action</th>
                        </tr>
                        @forelse ($wishlists as $wishlist)
                            <tr class="product-row">
                                <td>
                                    <a href="{{ url('/collections/'.$wishlist->produk->slug.'/view') }}" style="text-decoration: none;color: #212529 ">
                                        {{ $wishlist->produk->name }}
                                    </a>
                                </td>

                                <td>Rp {{ number_format($wishlist->produk->harga_jual, 0, '.', '.') }}</td>
                                <td>
                                    <a href="{{ url('/collections/'.$wishlist->produk->slug.'/view') }}">
                                            @if ($wishlist->produk->gambarProduk->count() > 0)
                                                <img src="{{ asset($wishlist->produk->gambarProduk[0]->image) }}" class="td-imagess" alt="{{ $wishlist->produk->name }}">
                                            @endif
                                    </a>
                                </td>
                                <td>
                                    <button type="button" wire:click="removeWishlistitem({{ $wishlist->id }})" href="" class="btn btn-danger btn-sm">
                                        <span wire:loading.remove>
                                            <i class="fa fa-trash"></i> Hapus
                                        </span>
                                        <span wire:loading wire:target="removeWishlistitem({{ $wishlist->id }})" >Menghapus</span>
                                    </button>
                                </td>
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
    </div>
        {{-- <div class="row">
            <div class="col-md-12">
                <div class="shopping-cart">

                    <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Produk</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Harga</h4>
                            </div>
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-2">
                                <h4>Action</h4>
                            </div>
                        </div>
                    </div>

                    @forelse ($wishlists as $wishlist)
                        <div class="cart-item">
                            <div class="row">
                                <div class="col-md-6 my-auto">
                                    <a href="{{ url('/collections/'.$wishlist->produk->slug.'/view') }}">
                                        <label class="product-name">
                                            @if ($wishlist->produk->gambarProduk->count() > 0)
                                                <img src="{{ asset($wishlist->produk->gambarProduk[0]->image) }}" class="w-25" alt="{{ $wishlist->produk->name }}">
                                            @endif
                                            {{ $wishlist->produk->name }}
                                        </label>
                                    </a>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <label class="price">Rp {{ number_format($wishlist->produk->harga_jual, 0, '.', '.') }} </label>
                                </div>
                                <div class="col-md-2 col-7 my-auto">

                                </div>
                                <div class="col-md-2 col-5 my-auto">
                                    <div class="remove">
                                        <button type="button" wire:click="removeWishlistitem({{ $wishlist->id }})" href="" class="btn btn-danger btn-sm">
                                            <span wire:loading.remove>
                                                <i class="fa fa-trash"></i> Hapus
                                            </span>
                                            <span wire:loading wire:target="removeWishlistitem({{ $wishlist->id }})" >Menghapus</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h4 class="text-center mt-5">Belum ada produk yang dimasukkan ke wishlist</h4>
                    @endforelse --}}

                </div>
            </div>
        </div>

    </div>
</div>
