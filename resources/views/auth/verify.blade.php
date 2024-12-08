@extends('auth.master')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center vh-100">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verifikasi Alamat Email Anda') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                            </div>
                        @endif

                        {{ __('Sebelum melanjutkan, silakan periksa email Anda untuk tautan verifikasi.') }}
                        {{ __('Jika Anda belum menerima email verifikasi') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-link p-0 m-0 align-baseline">{{ __('klik di sini untuk mengirim ulang tautan ke email Anda.') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
