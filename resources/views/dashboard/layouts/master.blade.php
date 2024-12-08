<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title>Dashboard Admin</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
    <!-- Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
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

    <!-- SeetAlert -->
    @include('sweetalert::alert')
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    <!-- FontAwesome -->
    <script src="{{ asset('js/FontAwesome.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ asset('js/jquery-3.7.0.js') }}"></script>
    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    {{-- <script src="{{ asset('js/plugins/chartjs.min.js') }}"></script> --}}
    <script src="{{ asset('js/argon-dashboard.min.js?v=2.0.4') }}"></script>
    <!-- CkEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- DataTables -->
    <script type="text/javascript" src="{{ asset('js/dataTables-1.13.7.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>

    <script src="{{ asset('js/alert.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('addJs')
</body>

</html>
