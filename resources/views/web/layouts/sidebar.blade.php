<div class="">
    <h4 class="text-center fw-bold">Terpopuler</h4>
    <div class="underline pt-0" style="width: 3rem; height: 4px; background-color: #007bff; margin: 10px auto;"></div>
</div>

@foreach ($popularArticles as $article)
    <div class="row">
        <div class="col-md-6 mb-2">
            <a href="{{ route('detail', ['slug' => $article->slug]) }}" data-bs-toogle="tooltip" data-bs-placement="top"
                title="{{ $article->title }}">
                <img src="{{ asset('storage/image-article/' . $article->image) }}" class="img-fluid rounded img-sidebar"
                    alt="gambar {{ $article->title }}">
            </a>
        </div>
        <div class="col-md-6 mb-2">
            <h6 class="card-text fw-semibold">{{ $article->title }}</h6>
            <p class="card-text">
                <small class="text-body-secondary"
                    style="color: #6c757d !important">{{ $article->created_at->format('d F Y') }}</small>
            </p>
        </div>
    </div>
@endforeach

<style>
    .img-sidebar:hover {
        filter: contrast(85%);
    }
</style>
