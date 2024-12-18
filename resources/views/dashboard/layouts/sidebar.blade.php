<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0">
            <img src="{{ asset('assets/logo.png') }}" class="navbar-brand-img h-100" alt="Logo TechUp" />
            <span class="ms-1 font-weight-bold">Dashboard</span>
        </a>

        <hr class="horizontal dark mt-0" />

        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-tv text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
            </ul>

            @if (auth()->check() && auth()->user()->hasRole('admin'))
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('user*') ? 'active' : '' }}"
                            href="{{ route('user_index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fa fa-user text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">User</span>
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('role*') ? 'active' : '' }}"
                            href="{{ route('role_index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fab fa-keycdn text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Role</span>
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('category*') ? 'active' : '' }}"
                            href="{{ route('category_index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fa fa-list text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Category</span>
                        </a>
                    </li>
                </ul>
            @endif

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('article*') ? 'active' : '' }}"
                        href="{{ route('article_index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-newspaper text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Article</span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</aside>
