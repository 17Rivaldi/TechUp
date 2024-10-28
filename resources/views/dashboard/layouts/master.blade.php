<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" type="image/png" href="" />
    <title>Dashboard Admin</title>
    <link rel="icon" type="image/png" href="" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('addCss')
</head>

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('dashboard.layouts.sidebar')

    <main class="main-content position-relative border-radius-lg">
        @include('dashboard.layouts.navbar')

        <div class="container-fluid py-4">
            @yield('content')
        </div>

    </main>

    @include('sweetalert::alert')

    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    {{-- <script src="{{ asset('js/plugins/chartjs.min.js') }}"></script> --}}

    <script src="{{ asset('js/argon-dashboard.min.js?v=2.0.4') }}"></script>

    <!-- jQuery -->
    <script src="{{ asset('js/jquery-3.7.0.js') }}"></script>

    <!-- DataTables -->
    <script type="text/javascript" src="{{ asset('js/dataTables-1.13.7.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>

    <!-- SeetAlert -->
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/alert.js') }}"></script>

    @yield('addJs')
</body>

</html>
