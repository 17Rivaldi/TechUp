<nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background-color: #dadada">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('assets/logoname.png') }}" alt="" style="width: 2em">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 ms-auto fw-bold">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/*') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('terkini*') ? 'active' : '' }}"
                        href="{{ route('terkini') }}">Terkini</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#!">Terpopuler</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Blog</a>
                </li>
            </ul>
            <form action="" method="GET" class="d-flex ms-auto">
                <div class="input-group">
                    <input type="search" class="form-control rounded-start-pill border-end-0 shadow shadow-end-none"
                        name="search" id="search-input" placeholder="Cari" aria-label="Cari">
                    <span class="input-group-text rounded-end-pill shadow shadow-start-none" id="toggle-cari">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </form>
            <a href="" class="btn btn-primary rounded-circle ms-2"><i class="far fa-user-circle"></i></a>
        </div>
    </div>
</nav>
<div class="" style="background-color: #387ADF; padding-top: 3px; position: sticky; top: 75px; z-index: 1020;">
</div>

<header class="bg-light border-bottom mb-4">
    <div class="container">
        <div class="py-2">
            <h1 class="badge bg-primary fw-bolder">tag 1</h1>
            <h1 class="badge bg-primary fw-bolder">tag 2</h1>
        </div>
    </div>
</header>
