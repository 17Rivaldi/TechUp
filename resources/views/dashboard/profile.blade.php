@extends('web.layouts.master')

@php
    $showNavbar = false;
    $showFooter = false;
@endphp

@section('content')
    <section class="h-100 gradient-custom-2">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center">
                <div class="col col-lg-9 col-xl-8">
                    <div class="card">
                        <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
                            <div class="ms-4 mt-4 d-flex flex-column" style="width: 150px;">
                                <a href="{{ auth()->user()->hasRole('admin') ? route('dashboard') : route('home') }}"
                                    class="text-decoration-none text-light fw-bold">
                                    <i class="fas fa-chevron-left me-1"></i>Back
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
                                <button type="button" class="btn btn-outline-primary mt-2" data-bs-toggle="modal"
                                    data-bs-target="#profileModal" style="z-index: 1;">
                                    Edit Profile
                                </button>
                                <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal"
                                    data-bs-target="#passwordModal" style="z-index: 1;">
                                    <i class="fas fa-cog me-2"></i>
                                </button>
                            </div>
                            <div class="ms-3" style="margin-top: 130px;">
                                <h5>{{ $users->name }}</h5>
                                <p>{{ $users->email }}</p>
                            </div>
                        </div>
                        <div class="p-4 text-black bg-body-tertiary">
                            <div class="d-flex justify-content-end text-center py-1 text-body">
                                <div>
                                    <p class="mb-1 h5">{{ $totalArticle }}</p>
                                    <p class="small text-muted mb-0">Article</p>
                                </div>
                                <div class="px-3">
                                    <p class="mb-1 h5">{{ $totalViews }}</p>
                                    <p class="small text-muted mb-0">Article Viewed</p>
                                </div>

                            </div>
                        </div>
                        <div class="card-body p-4 text-black">
                            <div class="mb-5  text-body">
                                <p class="lead fw-normal mb-1">About</p>
                                <div class="p-4 bg-body-tertiary">
                                    <p class="font-italic mb-1">Nomor Telephone : {{ $users->phone_number }}</p>
                                    <p class="font-italic mb-1">Tanggal Lahir : {{ $users->birthdate }}</p>
                                    <p class="font-italic mb-0">Jenis Kelamin : {{ $users->gender }}</p>
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
                        <h4 class="mb-3 text-center fw-semibold">Edit Profile</h4>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control shadow" id="name" name="name"
                                value="{{ $users->name }}">
                            @error('name')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control shadow" id="email" name="email"
                                value="{{ $users->email }}">
                            @error('email')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="number" class="form-control shadow" id="phone_number" name="phone_number"
                                value="{{ old('phone_number', $users->phone_number) }}">
                            @error('phone_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="birthdate" class="form-label">Birthdate</label>
                            <input type="date" class="form-control shadow" id="birthdate" name="birthdate"
                                value="{{ old('birthdate', $users->birthdate) }}">
                            @error('birthdate')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select shadow" id="gender" name="gender">
                                <option selected disabled>Choose Gender</option>
                                <option value="male" {{ old('gender', $users->gender) == 'male' ? 'selected' : '' }}>
                                    Male</option>
                                <option value="female" {{ old('gender', $users->gender) == 'female' ? 'selected' : '' }}>
                                    Female</option>
                            </select>
                            @error('gender')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="profile_image" class="form-label">Profile Image</label>
                            <input type="file" class="form-control shadow" id="profile_image" name="profile_image">
                            @error('profile_image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Profile</button>
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
                        <h4 class="mb-3 text-center fw-semibold">Change Password</h4>

                        <!-- Current Password -->
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
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
                            <label for="password" class="form-label">New Password</label>
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
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
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

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if (session('alert.config'))
        <pre>{{ print_r(session('alert.config'), true) }}</pre>
    @endif
@endsection


@section('addCss')
    <style>
        .gradient-custom-2 {
            /* fallback for old browsers */
            background: #fbc2eb;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1))
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
