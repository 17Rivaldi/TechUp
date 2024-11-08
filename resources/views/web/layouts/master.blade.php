<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        #scrollToTopBtn {
            width: 50px;
            height: 50px;
            font-size: 24px;
            display: none;
            z-index: 1000;
            transition: opacity 0.3s;
            position: fixed;
            bottom: 20px;
            right: 20px;
            border-radius: 50%;
        }

        #scrollToTopBtn.show {
            display: block;
        }
    </style>

    @yield('addCss')
</head>

<body>
    {{-- Header & Navbar --}}
    @include('web.layouts.navbar')

    <main>
        {{-- Content --}}
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('web.layouts.footer')

    <!-- Tombol panah ke atas -->
    <button id="scrollToTopBtn" class="btn btn-primary">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <script>
        const scrollToTopBtn = document.getElementById("scrollToTopBtn");

        window.onscroll = function() {
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                scrollToTopBtn.classList.add("show");
            } else {
                scrollToTopBtn.classList.remove("show");
            }
        };

        scrollToTopBtn.onclick = function() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        };
    </script>

    @yield('addJs')
</body>

</html>
