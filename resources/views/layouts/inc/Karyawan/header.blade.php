<header>
    <div class="navbar container">
        <div class="nav-item">
                <a href="{{ route('home.karyawan') }}" class="nav-link @yield('homeActive')"> Home </a>
                <a href="{{ route('KasirKaryawan.index') }}" class="nav-link @yield('newOrderActive')"> Cashier </a>
                <a href="{{ route('suplier.index') }}" class="nav-link @yield('supplierActive')"> Suplier </a>
                <a href="{{ route('order.index') }}" class="nav-link @yield('orderActive')"> Orders </a>
        </div>
        <div class="user">
            <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                    <img src="{{ asset('admin/images/profile/' . Auth::user()->photo_profile) }}" alt="poto-profil">
                </a>
            
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a></li>
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
            </div>
            {{-- <a href="" class="username">  </a>
            <a href=""><img src="{{ asset('admin/images/profile/' . Auth::user()->photo_profile) }}" alt="poto-profil"></a> --}}
        </div>
    </div>
</header>