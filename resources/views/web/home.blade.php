@extends('web.layouts.master')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center position-relative mb-3 hvr">
            <div class="ms-0">
                <a href="{{ route('terkini') }}" class="text-decoration-none text-dark hvr-ttl">
                    <h4 class="fw-bold">Terkini</h4>
                </a>
                <div class="underline-btm"></div>
            </div>
            <div class="d-flex align-items-center">
                <a href="{{ route('terkini') }}" class="text-decoration-none fw-medium text-dark hvr-ttl">
                    Selengkapnya
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
                                                    <h6 class="badge text-bg-primary" style="font-size: 0.8rem">
                                                        {{ $article->Category->name }}
                                                    </h6>
                                                    <p class="card-text text-white fw-bold" style="font-size: 17px">
                                                        {{ $article->title }}</p>
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
            <div class="col-lg-8">
                <div class="row">
                    <div class="d-flex justify-content-between align-items-center position-relative mb-3 hvr">
                        <div class="ms-0">
                            <a href="{{ route('show', ['category' => 'game']) }}"
                                class="text-decoration-none text-dark hvr-ttl">
                                <h4 class="fw-bold">Game</h4>
                            </a>
                            <div class="underline-ctg"></div>
                        </div>
                        <div class="d-flex align-item-center">
                            <a href="{{ route('show', ['category' => 'game']) }}"
                                class="text-decoration-none fw-medium text-dark hvr-ttl">
                                Selengkapnya
                                <i class="fas fa-angle-right ms-1"></i>
                            </a>
                        </div>
                    </div>

                    @foreach ($gameArticles as $article)
                        <div class="col-md-6">
                            <div class="card mb-4 border-0">
                                <a href="{{ route('detail', ['slug' => $article->slug]) }}" data-bs-toogle="tooltip"
                                    data-bs-placement="top" title="{{ $article->title }}">
                                    <img class="card-img-top rounded"
                                        src="{{ asset('storage/image-article/' . $article->image) }}" alt="..." />
                                </a>
                                <div class="card-body px-0">
                                    <h6 class="card-text fw-semibold">{{ $article->title }}</h6>
                                    <div class="small text-muted" style="color: #6c757d !important">
                                        {{ $article->created_at->format('d F Y') }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @foreach ($otherArticles as $categoryName => $articles)
                    <div class="row">
                        <div class="d-flex justify-content-between align-items-center position-relative mb-3 hvr">
                            <div class="ms-0">
                                <a href="{{ route('show', ['category' => $categoryName]) }}"
                                    class="text-decoration-none text-dark hvr-ttl">
                                    <h4 class="fw-bold">{{ ucfirst($categoryName) }}</h4>
                                </a>
                                <div class="underline-ctg"></div>
                            </div>
                            <div class="d-flex align-item-center">
                                <a href="{{ route('show', ['category' => $categoryName]) }}"
                                    class="text-decoration-none fw-medium text-dark hvr-ttl">
                                    Selengkapnya
                                    <i class="fas fa-angle-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                        @foreach ($articles as $article)
                            <div class="col-md-4">
                                <div class="card mb-4 border-0">
                                    <a href="{{ route('detail', ['slug' => $article->slug]) }}" data-bs-toogle="tooltip"
                                        data-bs-placement="top" title="{{ $article->title }}" class="img-box">
                                        <img class="card-img-top rounded img-hvr"
                                            src="{{ asset('storage/image-article/' . $article->image) }}" alt="..." />
                                    </a>
                                    <div class="card-body px-0">
                                        <h6 class="card-text fw-semibold">{{ $article->title }}</h6>
                                        <div class="small text-muted" style="color: #6c757d !important">
                                            {{ $article->created_at->format('d F Y') }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
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
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .carousel-control-prev {
                left: 15px;
            }

            .carousel-control-next {
                right: 15px;
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
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .carousel-control-prev {
                left: 10px;
            }

            .carousel-control-next {
                right: 10px;
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
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .carousel-control-prev {
                left: 10px;
            }

            .carousel-control-next {
                right: 10px;
            }

            .position-relative {
                padding-bottom: 4px;
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
