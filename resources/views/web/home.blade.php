@extends('web.layouts.master')

@section('content')
    <div class="container">
        {{-- <div class="d-flex justify-content-between align-item-center">
            <div class="ms-0">
                <a href="{{ route('terkini') }}" class="text-decoration-none text-dark">
                    <h4 class="fw-bold">Terkini</h4>
                </a>
                <div class="underline pt-0 ms-0"
                    style="width: 3rem; height: 4px; background-color: #007bff; margin: 10px auto;">
                </div>
            </div>
            <div class="d-flex align-item-center">
                <a href="{{ route('terkini') }}" class="text-decoration-none">
                    Baca Selengkapnya
                    <i class="fas fa-angle-right ms-1"></i>
                </a>
            </div>
        </div> --}}

        <div class="d-flex justify-content-between align-items-center position-relative mb-3">
            <div class="ms-0">
                <a href="{{ route('terkini') }}" class="text-decoration-none text-dark">
                    <h4 class="fw-bold">Terkini</h4>
                </a>
                <div class="underline-btm"></div>
            </div>
            <div class="d-flex align-items-center">
                <a href="{{ route('terkini') }}" class="btn btn-secondary btn-sm text-decoration-none">
                    Baca Selengkapnya
                    <i class="fas fa-angle-right ms-1"></i>
                </a>
            </div>
        </div>

        <div id="articleCarousel" class="carousel slide carousel-fade container gap-10" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($articles->chunk(3) as $chunk)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <div class="row">
                            @foreach ($chunk as $article)
                                <div class="col-lg-4">
                                    <a href="{{ route('detail', ['slug' => $article->slug]) }}" data-bs-toogle="tooltip"
                                        data-bs-placement="top" title="{{ $article->title }}">
                                        <div class="card mb-4 border-0">
                                            <div class="ratio ratio-16x9">
                                                <img src="{{ asset('storage/image-article/' . $article->image) }}"
                                                    class="card-img img-fluid" alt="...">
                                            </div>
                                            <div class="image-gradient-overlay rounded"></div>
                                            <div class="card-img-overlay">
                                                <div class="position-absolute bottom-0 mb-2">
                                                    <h6 class="badge text-bg-primary fs-6">{{ $article->Category->name }}
                                                    </h6>
                                                    <p class="card-text text-white fs-5 fw-bolder">{{ $article->title }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Carousel controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#articleCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#articleCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                <!-- Nested row for non-featured blog posts-->
                <div class="row">
                    <div class="d-flex justify-content-between align-item-center position-relative mb-3 hvr">
                        <div class="ms-0">
                            <a href="{{ route('show', ['category' => 'game']) }}" class="text-decoration-none text-dark">
                                <h4 class="fw-bold">Game</h4>
                            </a>
                            {{-- <div class="underline pt-0 ms-0"
                                style="width: 3rem; height: 4px; background-color: #007bff; margin: 10px auto;"></div> --}}
                            <div class="underline-ctg"></div>
                        </div>
                        <div class="d-flex align-item-center">
                            <a href="{{ route('show', ['category' => 'game']) }}"
                                class="text-decoration-none fw-medium text-dark">
                                Baca Selengkapnya
                                <i class="fas fa-angle-right ms-1"></i>
                            </a>
                        </div>
                    </div>

                    @foreach ($gameArticles as $article)
                        <div class="col-md-6">
                            <!-- Blog post-->
                            <div class="card mb-4 border-0">
                                <a href="{{ route('detail', ['slug' => $article->slug]) }}" data-bs-toogle="tooltip"
                                    data-bs-placement="top" title="{{ $article->title }}">
                                    <img class="card-img-top rounded"
                                        src="{{ asset('storage/image-article/' . $article->image) }}" alt="..." />
                                </a>
                                <div class="card-body px-0">
                                    <p class="card-text">{{ $article->title }}</p>
                                    <div class="small text-muted">{{ $article->created_at->format('d F Y') }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="d-flex justify-content-between align-item-center position-relative mb-3 hvr">
                        <div class="ms-0">
                            <a href="{{ route('show', ['category' => 'ai']) }}" class="text-decoration-none text-dark">
                                <h4 class="fw-bold">AI</h4>
                            </a>
                            <div class="underline-ctg"></div>
                        </div>
                        <div class="d-flex align-item-center">
                            <a href="{{ route('show', ['category' => 'ai']) }}"
                                class="text-decoration-none fw-medium text-dark">
                                Baca Selengkapnya
                                <i class="fas fa-angle-right ms-1"></i>
                            </a>
                        </div>
                    </div>

                    @foreach ($aiArticles as $article)
                        <div class="col-md-4">
                            <div class="card mb-4 border-0">
                                <a href="{{ route('detail', ['slug' => $article->slug]) }}" data-bs-toogle="tooltip"
                                    data-bs-placement="top" title="{{ $article->title }}">
                                    <img class="card-img-top rounded"
                                        src="{{ asset('storage/image-article/' . $article->image) }}" alt="..." />
                                </a>
                                <div class="card-body px-0">
                                    <p class="card-text">{{ $article->title }}</p>
                                    <div class="small text-muted">{{ $article->created_at->format('d F Y') }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Side widgets-->
            <div class="col-lg-4">
                @include('web.layouts.sidebar')
            </div>
        </div>
    </div>
@endsection

@section('addCss')
    <style>
        .image-gradient-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 50%;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.7) 100%);
        }

        .carousel:hover .carousel-control-prev,
        .carousel:hover .carousel-control-next {
            opacity: 1;
        }

        @media (max-width: 576px) {

            /* Small screens */
            #articleCarousel .carousel-item .col-lg-4 {
                max-width: 100%;
                flex: 0 0 100%;
            }

            .carousel-control-prev,
            .carousel-control-next {
                width: 5%;
                /* Atur lebar agar lebih kecil */
                opacity: 0;
                /* Sembunyikan tombol saat tidak di-hover */
                transition: opacity 0.3s ease;
                /* Efek transisi */
            }

            .carousel-control-prev {
                left: 15px;
                /* Atur jarak dari sisi kiri */
            }

            .carousel-control-next {
                right: 15px;
                /* Atur jarak dari sisi kanan */
            }
        }

        @media (min-width: 577px) and (max-width: 767px) {

            /* Medium screens */
            #articleCarousel .carousel-item .col-lg-4 {
                max-width: 50%;
                flex: 0 0 50%;
            }

            .carousel-control-prev,
            .carousel-control-next {
                width: 5%;
                /* Atur lebar agar lebih kecil */
                opacity: 0;
                /* Sembunyikan tombol saat tidak di-hover */
                transition: opacity 0.3s ease;
                /* Efek transisi */
            }

            .carousel-control-prev {
                left: 10px;
                /* Atur jarak dari sisi kiri */
            }

            .carousel-control-next {
                right: 10px;
                /* Atur jarak dari sisi kanan */
            }
        }

        @media (min-width: 768px) {

            /* Large screens */
            #articleCarousel .carousel-item .col-lg-4 {
                max-width: 33.3333%;
                flex: 0 0 33.3333%;
            }

            .carousel-control-prev,
            .carousel-control-next {
                width: 5%;
                /* Atur lebar agar lebih kecil */
                opacity: 0;
                /* Sembunyikan tombol saat tidak di-hover */
                transition: opacity 0.3s ease;
                /* Efek transisi */
            }

            .carousel-control-prev {
                left: 10px;
                /* Atur jarak dari sisi kiri */
            }

            .carousel-control-next {
                right: 10px;
                /* Atur jarak dari sisi kanan */
            }

            .position-relative {
                padding-bottom: 4px;
                /* Ruang untuk garis */
            }
        }

        .underline-btm,
        .underline-ctg {
            background-color: #007bff;
            width: 3rem;
            height: 5px;
        }

        .underline-btm::after {
            content: '';
            background-color: #d1d1d1;
            position: absolute;
            left: 49px;
            height: 5px;
            width: calc(100% - 3rem);
            max-width: calc(100vw - 3rem);
        }

        .underline-ctg::after {
            content: '';
            background-color: #d1d1d1;
            position: absolute;
            left: 49px;
            height: 5px;
            width: calc(98.5% - 3rem);
            max-width: calc(100vw - 2rem);
        }

        .hvr a:hover {
            color: #007bff !important;
        }
    </style>
@endsection

@section('addJs')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const carouselInner = document.querySelector('#articleCarousel .carousel-inner');
            const articles = Array.from(carouselInner.querySelectorAll('.col-lg-4'));
            let chunkSize = getChunkSize();

            // Fungsi untuk menentukan ukuran chunk berdasarkan layar
            function getChunkSize() {
                if (window.innerWidth < 576) return 1;
                if (window.innerWidth < 768) return 2;
                return 3;
            }

            // Fungsi untuk membagi ulang item berdasarkan ukuran layar
            function updateCarouselItems() {
                chunkSize = getChunkSize();
                carouselInner.innerHTML = ''; // Kosongkan carousel-inner

                for (let i = 0; i < articles.length; i += chunkSize) {
                    const chunk = articles.slice(i, i + chunkSize);
                    const carouselItem = document.createElement('div');
                    carouselItem.classList.add('carousel-item');
                    if (i === 0) carouselItem.classList.add('active'); // Set yang pertama sebagai aktif
                    const row = document.createElement('div');
                    row.classList.add('row');

                    chunk.forEach(col => row.appendChild(col)); // Masukkan item ke dalam row
                    carouselItem.appendChild(row);
                    carouselInner.appendChild(carouselItem); // Masukkan ke carousel
                }
            }

            // Panggil fungsi saat pertama kali dimuat
            updateCarouselItems();

            // Tambahkan event listener untuk menyesuaikan saat ukuran layar berubah
            window.addEventListener('resize', updateCarouselItems);
        });
    </script>
@endsection
