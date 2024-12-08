<nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background-color: #dadada">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('assets/logoname.png') }}" alt="" style="width: 2em">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse hvr" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 ms-auto fw-bold">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/*') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('terkini*') ? 'active' : '' }}"
                        href="{{ route('terkini') }}">Terkini</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('show', ['category' => 'review']) }}">Review</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page"
                        href="{{ route('show', ['category' => 'tutorial']) }}">Tutorial</a>
                </li>
            </ul>
            <form action="{{ route('search') }}" method="GET" class="d-flex ms-auto">
                <div class="input-group">
                    <input type="search" class="form-control rounded-start-pill border-end-0 shadow shadow-end-none"
                        name="search" id="search" placeholder="Cari" aria-label="Cari">
                    <button type="submit" class="btn input-group-text rounded-end-pill shadow shadow-start-none"
                        id="toggle-cari">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
            <div class="ms-3">
                @if (auth()->check())
                    <!-- Dropdown Menu -->
                    <div class="dropdown">
                        <a class="dropdown-toggle rounded-circle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            @if ($users->profile_image)
                                <img src="{{ asset('storage/image-profile/' . $users->profile_image) }}"
                                    alt="Foto Profil" class="rounded-circle"
                                    style="width: 40px; height: 40px; object-fit: cover;">
                            @else
                                <img src="https://t4.ftcdn.net/jpg/03/31/69/91/360_F_331699188_lRpvqxO5QRtwOM05gR50ImaaJgBx68vi.jpg"
                                    alt="Foto Profil" class="rounded-circle"
                                    style="width: 40px; height: 40px; object-fit: cover;" data-bs-toogle="tooltip"
                                    data-bs-placement="top" title="{{ $users->email }}">
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-4" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item text-primary" href="{{ route('profile') }}"><i
                                        class="far fa-user-circle me-2"></i>Profil</a>
                            </li>
                            @if (auth()->user()->hasrole('admin|writer|editor'))
                                <li>
                                    <a class="dropdown-item text-secondary" href="{{ route('dashboard') }}">
                                        <i class="fa-solid fa-gauge-high me-2"></i>Dashboard</a>
                                </li>
                            @endif
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i>Keluar
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary rounded-circle shadow"
                        data-bs-toogle="tooltip" data-bs-placement="top" title="Login">
                        <i class="far fa-user-circle"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>
<div class="" style="background-color: #387ADF; padding-top: 3px; position: sticky; top: 75px; z-index: 1020;">
</div>

<header class="bg-light border-bottom mb-4">
    <div class="container">
        <div class="py-2">
            @foreach ($tags as $tag)
                <a href="{{ route('showTag', ['tagslug' => $tag->slug]) }}" class="text-decoration-none">
                    <h1 class="badge bg-primary fw-bolder">{{ $tag->name }}</h1>
                </a>
            @endforeach
        </div>
    </div>
</header>
