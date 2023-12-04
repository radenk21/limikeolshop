<div class="main-navbar shadow-sm sticky-top">
    <div class="top-navbar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 my-auto d-none d-sm-none d-md-block d-lg-block">
                    <h5 class="brand-name"><a href="/" style="text-decoration: none; color: white">
                        <img style="width: 50px" height="50px" src="{{ asset('admin/images/backgrounds/rocket.png') }}"
                        {{-- width="180" --}}
                        alt="">
                        Limike Shop</a></h5>
                </div>
                <div class="col-md-5 my-auto">
                    <form role="search" action="{{ route('searchProduks') }}" method="GET">
                        @csrf
                        @method('POST')
                        <div class="input-group">
                            <input type="search" placeholder="Search your product" name="search_produk" value="{{ Request::get('search_produk') }}" class="form-control" />
                            <button class="btn bg-white" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-5 my-auto">
                    <ul class="nav justify-content-end">
                        @guest
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('keranjang.index') }}">
                                    <i class="fa fa-shopping-cart"></i> Cart (@livewire('frontend.keranjang.keranjang-count'))
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('wishlist.index') }}">
                                    <i class="fa fa-heart"></i> Wishlist (@livewire('frontend.wishlist-count'))
                                </a>
                            </li>
                        @endguest
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user"></i> {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @if (Auth::check() && Auth::user()->role_as == '1')
                                        <li><a class="dropdown-item" href="{{ url('admin/dashboard') }}"><i class="fa fa-user"></i> Admin Page</a></li>
                                        <li><a class="dropdown-item" href="{{ url('karyawan/home') }}"><i class="fa fa-user"></i> Karyawan Page</a></li>
                                    @endif
                                    @if (Auth::check() && Auth::user()->role_as == '2')
                                        <li><a class="dropdown-item" href="{{ url('karyawan/home') }}"><i class="fa fa-user"></i> Karyawan Page</a></li>
                                    @endif
                                    <li><a class="dropdown-item" href="{{ route('order.index') }}"><i class="fa fa-list"></i> My Orders</a></li>
                                    <li><a class="dropdown-item" href="{{ route('wishlist.index') }}"><i class="fa fa-heart"></i> My Wishlist</a></li>
                                    <li><a class="dropdown-item" href="{{ route('keranjang.index') }}"><i class="fa fa-shopping-cart"></i> My Cart</a></li>
                                    {{-- <li><a class="dropdown-item" href="#"><i class="fa fa-sign-out"></i> Logout</a></li> --}}
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out"></i>
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid navbarrrrrrrr">
            <a class="navbar-brand d-block d-sm-block d-md-none d-lg-none" href="/">
                <h1>
                    Limike Shop
                </h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse navbar-subnavbar" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.all-products.show') }}">All Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.kategoris') }}">All Categories</a>
                    </li>
                    @foreach ($kategoris as $kategori)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('kategori', $kategori->slug) }}">{{ $kategori->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</div>
