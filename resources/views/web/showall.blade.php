@extends('web.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb fw-semibold">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">
                            <i class="fas fa-home me-1"></i>Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        @if (isset($query))
                            Search: {{ $query }}
                        @elseif (isset($category))
                            {{ ucfirst($category) }}
                        @elseif (isset($tag))
                            # {{ ucfirst($tag->name) }}
                        @else
                            Terkini
                        @endif
                    </li>
                </ol>
            </nav>

            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-item-center">
                    <div class="ms-0">
                        <h4 class="fw-bold">
                            @if (isset($query))
                                Search: {{ $query }}
                            @elseif (isset($category))
                                {{ ucfirst($category) }}
                            @elseif (isset($tag))
                                # {{ ucfirst($tag->name) }}
                            @else
                                Terkini
                            @endif
                        </h4>
                        <div class="underline pt-0 ms-0"
                            style="width: 3rem; height: 4px; background-color: #007bff; margin: 10px auto;"></div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($articles as $article)
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="img-box">
                                <a href="{{ route('detail', ['slug' => $article->slug]) }}" data-bs-toogle="tooltip"
                                    data-bs-placement="top" title="{{ $article->title }}">
                                    <img src="{{ asset('storage/image-article/' . $article->image) }}"
                                        class="img-fluid rounded img-hvr" alt="gambar {{ $article->title }}">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-6 mb-3">
                            <h6 class="fw-bold">{{ $article->title }}</h6>
                            <p class="fw-medium my-1" style="color: #555555; font-size: 0.9rem;">{!! $article->description !!}</p>
                            <small style="color: #6c757d !important">
                                @if ($article->created_at->isToday())
                                    {{ $article->created_at->diffForHumans() }}
                                @elseif ($article->created_at->isYesterday())
                                    Kemarin, {{ $article->created_at->format('H:i') }}
                                @else
                                    {{ $article->created_at->format('d F Y') }}
                                @endif
                            </small>
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

            <!-- Side widgets-->
            <div class="col-lg-4">
                @include('web.layouts.sidebar')
            </div>
        </div>
    </div>
@endsection
