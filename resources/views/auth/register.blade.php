@extends('auth.master')

@section('content')
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
        style="background-image: url('{{ asset('assets/bg2.jpg') }}'); background-position: top;">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-5">Hallo Techup!</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-lg-n13 mt-md-n11 mt-n10 mb-4">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                <div class="card z-index-0 shadow">
                    <div class="card-header text-center pt-4">
                        <h5>Registrasi</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <input id="name" type="text" class="form-control" value="{{ old('name') }}"
                                    required autocomplete="name" autofocus name="name" placeholder="Name"
                                    aria-label="Name">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" placeholder="Email"
                                    aria-label="Email">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="input-group">
                                    <input id="password" type="password" class="form-control" name="password" required
                                        autocomplete="new-password" placeholder="Password" aria-label="Password">
                                    <span class="input-group-text toggle-password" data-target="password">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="input-group">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="Confirm Password" aria-label="Password">
                                    <span class="input-group-text toggle-password" data-target="password-confirm">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                                @error('password-confirm')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-check form-check-info text-start">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked
                                    required>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Saya setuju dengan <a class="text-dark font-weight-bolder"
                                        href="{{ route('termsConditions') }}">Syarat dan Ketentuan</a>
                                </label>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign
                                    up</button>
                            </div>
                            <p class="text-sm mt-3 mb-0">Sudah mempunyai akun? <a href="{{ route('login') }}"
                                    class="text-dark font-weight-bolder">Sign in</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addJs')
    <script>
        $(document).ready(function() {
            $('.toggle-password').on('click', function() {
                var targetId = $(this).data('target');
                var passwordInput = $('#' + targetId);
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
