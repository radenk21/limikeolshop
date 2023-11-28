<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-lg">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-white" aria-current="page"href="{{ route('home.karyawan') }}" class="nav-link @yield('homeActive')"> Home </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('KasirKaryawan.index') }}" class="nav-link @yield('newOrderActive')"> Cashier </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('suplier.index') }}" class="nav-link @yield('supplierActive')"> Suplier </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('order.index') }}" class="nav-link @yield('orderActive')"> Orders </a>
          </li>
        </ul>
        <form class="d-flex">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="user-image" src="{{ asset('admin/images/profile/' . Auth::user()->photo_profile) }}" alt="poto-profil"></img>
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
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
                  </li>
        </form>
      </div>
    </div>
  </nav>
