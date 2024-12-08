@extends('auth.master')

@section('content')
    <div class="container">
        <div class="row mt-lg-10">
            <div class="col-xl-4 mx-auto">
                <div class="card shadow-lg">
                    <div class="card-header text-center">
                        <h5>Atur Ulang Kata Sandi</h5>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group row">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ __('Tautan telah dikirim ke alamat email Anda.') }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row mb-0">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Kirim Tautan') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
