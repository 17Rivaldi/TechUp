@extends('web.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb fw-semibold">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" class="text-decoration-none">
                                <i class="fas fa-home me-1"></i>Home
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('show', ['category' => $article->Category->name]) }}"
                                class="text-decoration-none">
                                {{ $article->Category->name }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
                    </ol>
                </nav>

                <section class="detail-article">
                    <div class="text-center">
                        <h4 class="fw-bold my-4">{{ $article->title }}</h4>
                        <p class="mb-0">{{ $article->created_at->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm') }}</p>
                        <p>{{ $article->user->name }} -
                            <span class="text-primary fw-bolder">
                                <a href="{{ route('show', ['category' => $article->Category->name]) }}"
                                    class="text-decoration-none">
                                    {{ $article->Category->name }}
                                </a>
                            </span>
                        </p>
                    </div>
                    <img src="{{ asset('storage/image-article/' . $article->image) }}" class="card-img rounded"
                        alt="...">
                    <div class="my-3">
                        <p>{!! $article->description !!}</p>
                    </div>
                    <div>
                        @foreach ($article->tags as $tag)
                            <a href="{{ route('showTag', ['tagslug' => $tag->slug]) }}" class="text-decoration-none">
                                <h1 class="badge bg-primary fw-bolder">{{ $tag->name }}</h1>
                            </a>
                        @endforeach
                    </div>
                </section>

                <div class="d-flex justify-content-between align-items-center position-relative mb-3 mt-4 hvr">
                    <div class="ms-0">
                        <a href="{{ route('terkini') }}" class="text-decoration-none text-dark hvr-ttl">
                            <h4 class="fw-bold">Terkini</h4>
                        </a>
                        <div class="underline-btm"></div>
                    </div>
                    <div class="d-flex align-item-center">
                        <a href="{{ route('terkini') }}" class="text-decoration-none fw-medium text-dark hvr-ttl">
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
                                    data-bs-placement="top" title="{{ $article->title }}" class="img-box">
                                    <img class="card-img-top rounded img-hvr"
                                        src="{{ asset('storage/image-article/' . $article->image) }}"
                                        alt="gambar {{ $article->title }}" />
                                </a>
                                <div class="card-body px-0">
                                    <h6 class="card-text fw-bold">{{ $article->title }}</h6>
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
    </style>
@endsection
