@extends('web.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb fw-semibold">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">
                                <i class="fas fa-home me-1"></i>Home</a></li>
                        {{-- <li class="breadcrumb-item"><a href="">Event</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
                    </ol>
                </nav>

                <h4 class="fw-bold">{{ $article->title }}</h4>
                <div class="text-center">
                    <p class="mb-0">{{ $article->created_at->format('l, d F Y H:i') }}</p>
                    <p>Rivaldi Syaputra -
                        <span class="text-primary">
                            <a href="{{ route('show', ['category' => $article->Category->name]) }}"
                                class="text-decoration-none">
                                {{ $article->Category->name }}
                            </a>
                        </span>
                    </p>
                </div>
                <img src="{{ asset('storage/image-article/' . $article->image) }}" class="card-img rounded" alt="...">
                <div class="my-3">
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod ipsum sit assumenda ea voluptatem,
                        libero odio. Soluta aliquid beatae, autem deserunt illum debitis officia voluptatem mollitia id
                        earum impedit dolores eveniet ducimus nemo delectus quas placeat? Beatae fuga, error maxime facere
                        maiores voluptatum amet reiciendis. Non fugit adipisci cupiditate, facere numquam obcaecati magnam
                        dignissimos quidem aspernatur corporis, reiciendis facilis optio repellendus dicta quisquam omnis
                        tempora praesentium esse deserunt perferendis minima. Quasi excepturi iste temporibus ipsum saepe
                        sit tenetur suscipit facere minus earum perferendis, repellat id odio dolores nisi sequi beatae.
                        Consequatur culpa sapiente, voluptatum neque iste sequi non minus at.</p>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Deleniti iste itaque tempore accusamus
                        quidem earum at iure commodi voluptate dolor.</p>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Numquam iste consequuntur error ipsa
                        eveniet cum, quaerat quam corporis accusantium sint dignissimos voluptates cupiditate, culpa facilis
                        quisquam nisi similique? Earum non enim, omnis ducimus magnam consectetur.</p>
                </div>
                <div>
                    <p class="badge bg-primary">AI</p>
                </div>

                <div class="d-flex justify-content-between align-items-center position-relative mb-3 hvr">
                    <div class="ms-0">
                        <a href="{{ route('terkini') }}" class="text-decoration-none text-dark">
                            <h4 class="fw-bold">Terkini</h4>
                        </a>
                        <div class="underline-btm"></div>
                    </div>
                    <div class="d-flex align-item-center">
                        <a href="{{ route('terkini') }}" class="text-decoration-none fw-medium text-dark">
                            Baca Selengkapnya
                            <i class="fas fa-angle-right ms-2"></i>
                        </a>
                    </div>
                </div>

                <div class="row">
                    @foreach ($otherArticle as $article)
                        <div class="col-lg-4">
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

                {{-- Commentar --}}
                <div class="d-flex justify-content-between align-item-center">
                    <div class="ms-0">
                        <h4 class="fw-bold">Komentar</h4>
                        <div class="underline pt-0 ms-0"
                            style="width: 3rem; height: 4px; background-color: #007bff; margin: 10px auto;"></div>
                    </div>
                </div>

                <div class="pt-4 pb-3 mb-2 rounded-4" style="background-color: #D9D9D9">
                    <div class="bg-white pb-5 mx-4 mt-0 rounded">
                        <p class="ms-2">Tulis Komentar</p>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary mt-3 me-4">Kirim</button>
                    </div>
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
        .underline-btm {
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
            max-width: calc(100vw - 2rem);
        }

        .hvr a:hover {
            color: #007bff !important;
        }
    </style>
@endsection
