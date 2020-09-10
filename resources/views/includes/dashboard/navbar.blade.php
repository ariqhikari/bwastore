<nav
class="navbar navbar-expand-lg navbar-light navbar-store shadow-none"
data-aos="fade-down"
style="position: relative;z-index: 99"
>
    <div class="container-fluid">
        <button
        class="btn d-md-none mr-auto mr-2"
        id="menu-toggle"
        >
            <img src="/images/dashboard-icon.svg" alt="Dashboard Icon" width="50px">
        </button>
        <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul
                class="navbar-nav ml-auto align-items-lg-center mt-2 mt-lg-0"
            >
                <li class="nav-item dropdown">
                    <a
                        href="#"
                        class="nav-link"
                        id="navbarDropdown"
                        role="button"
                        data-toggle="dropdown"
                    >
                        <img
                        src="{{ Storage::url(Auth::user()->avatar) }}"
                        class="rounded-circle mr-2 profile-picture"
                        />
                        Hi, {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu">
                        <a href="{{ route('home') }}" class="dropdown-item"
                        >Home</a
                        >
                        <a href="{{ route('dashboard.settings.account') }}" class="dropdown-item"
                        >Settings</a
                        >
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a
                        href="{{ route('cart') }}"
                        class="nav-link d-lg-inline-block d-flex align-items-center"
                    >
                        @php
                            $carts = \App\Cart::where('user_id', Auth::user()->id)->count();
                        @endphp
                        @if ($carts > 0)
                            <img
                                src="/images/icon-cart-filled.svg"
                                alt="Cart empty"
                                class="ml-2 ml-lg-0"
                            />
                            <div class="card-badge">{{ $carts }}</div>
                        @else
                            <img
                                src="/images/icon-cart-empty.svg"
                                alt="Cart empty"
                                class="ml-2 ml-lg-0"
                            />
                        @endif
                        <span class="d-lg-none ml-4">My Cart</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>