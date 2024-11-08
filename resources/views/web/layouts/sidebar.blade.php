<div class="">
    <h4 class="text-center">Terpopuler</h4>
    <div class="underline pt-0" style="width: 3rem; height: 4px; background-color: #007bff; margin: 10px auto;"></div>
</div>

{{-- @foreach ($popularArticles as $article)
    <div class="card mb-3 border-0" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-6">
                <a href="{{ route('detail', ['slug' => $article->slug]) }}" data-bs-toogle="tooltip"
                    data-bs-placement="top" title="{{ $article->title }}">
                    <img src="{{ asset('storage/image-article/' . $article->image) }}" class="img-fluid rounded"
                        alt="gambar {{ $article->title }}">
                </a>
            </div>
            <div class="col-md-6">
                <div class="card-body py-0">
                    <h6 class="card-text">{{ $article->title }}</h6>
                    <p class="card-text"><small
                            class="text-body-secondary">{{ $article->created_at->format('d F Y') }}</small>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endforeach --}}

@foreach ($popularArticles as $article)
    <div class="row">
        <div class="col-md-6 mb-2">
            <a href="{{ route('detail', ['slug' => $article->slug]) }}" data-bs-toogle="tooltip" data-bs-placement="top"
                title="{{ $article->title }}">
                <img src="{{ asset('storage/image-article/' . $article->image) }}" class="img-fluid rounded"
                    alt="gambar {{ $article->title }}">
            </a>
        </div>
        <div class="col-md-6 mb-2">
            <h6 class="card-text">{{ $article->title }}</h6>
            <p class="card-text"><small class="text-body-secondary">{{ $article->created_at->format('d F Y') }}</small>
            </p>
        </div>
    </div>
@endforeach
