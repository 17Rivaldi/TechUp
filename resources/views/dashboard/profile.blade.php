@extends('web.layouts.master')

@php
    $showNavbar = false;
    $showFooter = false;
@endphp

@section('content')
    <section class="vh-100 gradient-custom-2">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center">
                <div class="col col-lg-9 col-xl-8">
                    <div class="card">
                        <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
                            <div class="ms-4 mt-4 d-flex flex-column" style="width: 150px;">
                                <a href="{{ auth()->user()->hasRole('admin|writer|editor') ? route('dashboard') : route('home') }}"
                                    class="text-decoration-none text-light fw-bold mb-4">
                                    <i class="fas fa-chevron-left me-1"></i>Kembali
                                </a>
                                @if ($users->profile_image)
                                    <img src="{{ asset('storage/image-profile/' . $users->profile_image) }}"
                                        alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                                        style="width: 150px; z-index: 1">
                                @else
                                    <img src="https://t4.ftcdn.net/jpg/03/31/69/91/360_F_331699188_lRpvqxO5QRtwOM05gR50ImaaJgBx68vi.jpg"
                                        alt="Default Image Profile" class="img-fluid img-thumbnail mt-4 mb-2"
                                        style="width: 150px; z-index: 1">
                                @endif

                                <!-- Dropdown -->
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"
                                    style="z-index: 1;">
                                    <i class="fas fa-cog me-2"></i>Setting
                                </button>
                                <div class="dropdown dropend">
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#profileModal">
                                                <i class="fa-solid fa-user me-2"></i>Edit Profile
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#passwordModal">
                                                <i class="fa-solid fa-key me-2"></i>Ubah Password
                                            </button>
                                        </li>
                                        <li>
                                            @if (!auth()->user()->hasRole('admin|editor|writer'))
                                                <form action="{{ route('request_writer') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fa-solid fa-pen me-2"></i>Ajukan Menjadi Writer
                                                    </button>
                                                </form>
                                            @endif
                                        </li>
                                        <li>
                                            @if (!auth()->user()->hasVerifiedEmail())
                                                <form action="{{ route('verification.resend') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fa-solid fa-envelope me-2"></i>
                                                        Kirim Ulang Verifikasi Email
                                                    </button>
                                                </form>
                                            @endif
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <div class="ms-3" style="margin-top: 130px;">
                                <h5>{{ $users->name }}</h5>
                                <p>{{ $users->email }}</p>
                            </div>
                            <div class="ms-auto d-flex align-items-center me-3" style="margin-top: 150px;">
                                @if (!auth()->user()->hasVerifiedEmail())
                                    <i class="fa-solid fa-circle-xmark text-warning me-2"></i>
                                    Belum Terverifikasi
                                @else
                                    <i class="fa-solid fa-circle-check text-primary me-2"></i>
                                    Terverifikasi
                                @endif
                            </div>
                        </div>
                        <div class="p-4 text-black bg-body-tertiary">
                            <div class="d-flex justify-content-end text-center py-1 text-body">
                                <div>
                                    <p class="mb-1 h5">{{ $totalArticle }}</p>
                                    <p class="small text-muted mb-0">Artikel</p>
                                </div>
                                <div class="px-3">
                                    <p class="mb-1 h5">{{ $totalViews }}x</p>
                                    <p class="small text-muted mb-0">Artikel Dilihat</p>
                                </div>
                                <div>
                                    <p class="mb-1 h5">{{ $totalPublish }}</p>
                                    <p class="small text-muted mb-0">Artikel Dipublikasi</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-black">
                            <div class="text-body">
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        <i class="fa-solid fa-envelope-circle-check"></i>
                                        {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                                    </div>
                                @endif
                                <p class="lead fw-normal mb-4">Tentang</p>
                                <div class="p-4 bg-body-tertiary">
                                    <p class="font-italic mb-1">Nomor Telephone : {{ $users->phone_number }}</p>
                                    <p class="font-italic mb-1">Tanggal Lahir :
                                        {{ \Carbon\Carbon::parse($users->birthdate)->locale('id')->isoFormat('D MMMM YYYY') }}
                                    </p>
                                    <p class="font-italic mb-0">Jenis Kelamin :
                                        {{ $users->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Edit Profile -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('profile_update', $users->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-body">
                        <h4 class="mb-3 text-center fw-semibold">Edit Profil</h4>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control shadow" id="name" name="name"
                                value="{{ $users->name }}">
                            @error('name')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control shadow" id="email" name="email"
                                value="{{ $users->email }}">
                            @error('email')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Nomor Telepon</label>
                            <input type="number" class="form-control shadow" id="phone_number" name="phone_number"
                                value="{{ old('phone_number', $users->phone_number) }}">
                            @error('phone_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="birthdate" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control shadow" id="birthdate" name="birthdate"
                                value="{{ old('birthdate', $users->birthdate) }}">
                            @error('birthdate')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">Jenis Kelamin</label>
                            <select class="form-select shadow" id="gender" name="gender">
                                <option selected disabled>Pilih Jenis Kelamin</option>
                                <option value="male" {{ old('gender', $users->gender) == 'male' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="female" {{ old('gender', $users->gender) == 'female' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('gender')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="profile_image" class="form-label">Foto Profil</label>
                            <input type="file" class="form-control shadow" id="profile_image" name="profile_image">
                            @error('profile_image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Change Password -->
    <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('change_password', $users->id) }}" method="POST"">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-body">
                        <h4 class="mb-3 text-center fw-semibold">Ubah Password</h4>

                        <!-- Current Password -->
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Password Saat Ini</label>
                            <div class="input-group">
                                <input type="password" class="form-control shadow shadow-end-none" id="current_password"
                                    name="current_password" required>
                                <span class="input-group-text toggle-password shadow shadow-start-none"
                                    data-target="current_password">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            @error('current_password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control shadow shadow-end-none" id="password"
                                    name="password">
                                <span class="input-group-text toggle-password shadow shadow-start-none"
                                    data-target="password">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control shadow shadow-end-none"
                                    id="password_confirmation" name="password_confirmation">
                                <span class="input-group-text toggle-password shadow shadow-start-none"
                                    data-target="password_confirmation">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('addCss')
    <style>
        .gradient-custom-2 {
            background: #fbc2eb;
            background: -webkit-linear-gradient(to right, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1));
            background: linear-gradient(to right, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1))
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
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

        @if ($errors->any())
            var passwordModal = new bootstrap.Modal(document.getElementById('passwordModal'));
            passwordModal.show();
        @endif
    </script>
@endsection
