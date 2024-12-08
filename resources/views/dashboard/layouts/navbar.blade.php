<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item">
                    <a class="text-white fw-bold" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                @yield('breadcrumb-item')
            </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <ul class="navbar-nav justify-content-end ms-md-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link text-white font-weight-bold px-2"
                                href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white font-weight-bold px-2"
                                href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white font-weight-bold px-0"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if (auth()->user()->profile_image)
                                <img src="{{ asset('storage/image-profile/' . auth()->user()->profile_image) }}"
                                    alt="Foto Profil" class="rounded-circle"
                                    style="width: 35px; height: 35px; object-fit: cover;">
                            @else
                                <img src="https://t4.ftcdn.net/jpg/03/31/69/91/360_F_331699188_lRpvqxO5QRtwOM05gR50ImaaJgBx68vi.jpg"
                                    alt="Foto Profil" class="rounded-circle"
                                    style="width: 35px; height: 35px; object-fit: cover;" data-bs-toogle="tooltip"
                                    data-bs-placement="top" title="{{ auth()->user()->email }}">
                            @endif
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a href="{{ route('profile') }}" class="dropdown-item text-primary">
                                <i class="fas fa-user me-2"></i>
                                Profile
                            </a>

                            <a href="{{ route('home') }}" class="dropdown-item">
                                <i class="fa-solid fa-pager me-2"></i>
                                Web Page
                            </a>

                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest

                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
