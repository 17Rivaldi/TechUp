@extends('auth.master')

@section('content')
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-start">
                                <h4 class="font-weight-bolder">Sign In</h4>
                                <p class="mb-0">Masukan email dan kata sandi Anda</p>
                            </div>
                            <div class="card-body">
                                <form method="POST" role="form" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <input id="email" type="email" class="form-control form-control-lg"
                                            name="email" value="{{ old('email') }}" required autocomplete="email"
                                            autofocus placeholder="Email" aria-label="Email">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3 input-group">
                                        <input id="password" type="password" class="form-control form-control-lg"
                                            name="password" required autocomplete="current-password" placeholder="Password"
                                            aria-label="Password">
                                        <span class="input-group-text" id="toggle-password">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="text-sm">
                                        <a href="{{ route('password.request') }}"
                                            class="text-primary text-gradient font-weight-bold">Lupa Kata Sandi ?</a>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign
                                            in</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <p class="mb-4 text-sm mx-auto">
                                    Belum punya akun?
                                    <a href="{{ route('register') }}"
                                        class="text-primary text-gradient font-weight-bold">Sign
                                        up</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                        <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                            style="background-image: url('{{ asset('assets/bg1.jpg') }}'); background-size: cover;">
                            <span class="mask bg-gradient-primary opacity-6"></span>
                            <h4 class="mt-5 text-white font-weight-bolder position-relative">Hallo Techup</h4>
                            <p class="text-white position-relative">Mari bergabung dengan kami, login / registrasi
                                terlebih dahulu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('addJs')
    <script>
        $(document).ready(function() {
            $('#toggle-password').on('click', function() {
                var passwordInput = $('#password');
                var toggleIcon = $(this).find('i');

                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    toggleIcon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordInput.attr('type', 'password');
                    toggleIcon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });
    </script>
@endsection
