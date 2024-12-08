<footer>
    <div class="py-1" style="background-color: #387ADF"></div>
    <div class="pt-5 pb-3" style="background-color: #D1D1D1">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 text-center">
                    <img src="{{ asset('assets/logoname.png') }}" alt="" width="20%" height="auto">
                </div>
                <div class="col-lg-8">
                    <div class="row fw-bold hvr">
                        <div class="col-4 foot-item">
                            <div class="mb-1">
                                <a href="{{ route('terkini') }}" class="text-decoration-none text-dark">
                                    Terkini
                                </a>
                            </div>
                            <div class="mb-1">
                                <a href="{{ route('popular') }}" class="text-decoration-none text-dark">
                                    Terpopuler
                                </a>
                            </div>
                        </div>
                        <div class="col-4 foot-item">
                            <div class="mb-1">
                                <a href="{{ route('recommended') }}" class="text-decoration-none text-dark">
                                    Rekomendasi Editor
                                </a>
                            </div>
                            <div class="mb-1">
                                <a href="{{ route('show', ['category' => 'tutorial']) }}"
                                    class="text-decoration-none text-dark">
                                    Tutorial
                                </a>
                            </div>
                            <div class="mb-1">
                                <a href="{{ route('show', ['category' => 'gadget']) }}"
                                    class="text-decoration-none text-dark">
                                    {{ ucfirst('Gadget') }}
                                </a>
                            </div>
                        </div>
                        <div class="col-4 foot-item">
                            <div class="mb-1">
                                <a href="{{ auth()->check() ? route('profile') : route('login') }}"
                                    class="text-decoration-none text-dark">
                                    {{ auth()->check() ? 'Profile' : 'Masuk' }}
                                </a>
                            </div>
                            @if (auth()->check())
                                <div class="mb-1">
                                    <a href="{{ route('logout') }}" class="text-decoration-none text-dark"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            @endif
                            <div class="mb-1">
                                <a href="{{ route('termsConditions') }}" class="text-decoration-none text-dark">
                                    Ketentuan Pengguna
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <hr style="color: #387ADF">
            <h6 class="m-0 text-center text-dark">Copyright &copy; TechUp 2024</h6>
        </div>
    </div>
</footer>
