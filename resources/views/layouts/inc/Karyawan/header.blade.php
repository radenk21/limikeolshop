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
                        @if (Auth::check() && Auth::user()->role_as == '1')
                          <li><a class="dropdown-item" href="{{ url('admin/dashboard') }}"><i class="fa fa-user"></i> Admin Page</a></li>
                        @endif
                        <li>
                            <a class="dropdown-item" href="{{ url('logout') }}"
                                {{-- onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();" --}}
                                            >
                                <i class="fa fa-sign-out"></i>
                                {{ __('Logout') }}
                            </a>

                            {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                                <input type="hidden" name="_token" value="{{ Auth::user()->id }}">
                                <button type="submit"></button>
                            </form> --}}
                        </li>
                    </ul>
                  </li>
        </form>
      </div>
    </div>
  </nav>
