@extends('web.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb fw-semibold">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">
                            <i class="fas fa-home me-1"></i>Home</a></li>
                    {{-- <li class="breadcrumb-item"><a href="">Event</a></li> --}}
                    <li class="breadcrumb-item active" aria-current="page">{{ $category ? ucfirst($category) : 'Terkini' }}
                    </li>
                </ol>
            </nav>

            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-item-center">
                    <div class="ms-0">
                        <a href="{{ route($category ? 'show' : 'terkini', ['category' => $category]) }}"
                            class="text-decoration-none text-dark">
                            <h4 class="fw-bold">{{ $category ? ucfirst($category) : 'Terkini' }}</h4>
                        </a>
                        <div class="underline pt-0 ms-0"
                            style="width: 3rem; height: 4px; background-color: #007bff; margin: 10px auto;"></div>
                    </div>
                </div>

                {{-- <div class="row">
                    @foreach ($articles as $article)
                        <div class="card mb-3 border-0" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <a href="{{ route('detail', ['slug' => $article->slug]) }}" data-bs-toogle="tooltip"
                                        data-bs-placement="top" title="{{ $article->title }}">
                                        <img src="{{ asset('storage/image-article/' . $article->image) }}"
                                            class="img-fluid rounded" alt="gambar {{ $article->title }}">
                                    </a>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card-body py-0">
                                        <h6 class="card-text">{{ $article->title }}</h6>
                                        <p class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro,
                                            quaerat voluptatibus. Exercitationem maxime consequatur aut vel explicabo, porro
                                            dicta sit.</p>
                                        <p class="card-text">
                                            <small class="text-body-secondary">
                                                {{ $article->created_at->format('d F Y') }}
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div> --}}

                <div class="row">
                    @foreach ($articles as $article)
                        <div class="col-lg-4 col-md-6 mb-3">
                            <a href="{{ route('detail', ['slug' => $article->slug]) }}" data-bs-toogle="tooltip"
                                data-bs-placement="top" title="{{ $article->title }}">
                                <img src="{{ asset('storage/image-article/' . $article->image) }}" class="img-fluid rounded"
                                    alt="gambar {{ $article->title }}">
                            </a>
                        </div>
                        <div class="col-lg-8 col-md-6 mb-3">
                            <h6 class="card-text">{{ $article->title }}</h6>
                            <p class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro,
                                quaerat voluptatibus. Exercitationem maxime consequatur aut vel explicabo, porro
                                dicta sit.</p>
                            <p class="card-text">
                                <small class="text-body-secondary">
                                    {{ $article->created_at->format('d F Y') }}
                                </small>
                            </p>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination-->
                <nav aria-label="Pagination">
                    <hr class="my-0" />
                    <ul class="pagination justify-content-center my-4">
                        {{ $articles->links() }}
                </nav>
            </div>

            {{-- <div class="d-flex justify-content-center">
                {{ $articles->links() }}
            </div> --}}

            <!-- Side widgets-->
            <div class="col-lg-4">
                @include('web.layouts.sidebar')
            </div>
        </div>
    </div>
@endsection
