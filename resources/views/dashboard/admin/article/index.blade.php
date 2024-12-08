@extends('dashboard.layouts.master')

@section('breadcrumb-item')
    <li class="breadcrumb-item text-white fw-bold opacity-7 active" aria-current="page">
        Article</li>
@endsection

@section('content')
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Daftar Article</h6>
                    <a href="{{ route('article_create') }}" class="btn btn-primary" role="button"><i
                            class="fas fa-plus me-2"></i>Add</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-responsive table-striped table-hover" style="width:100%">
                            <thead>
                                <tr class="text-sm">
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Slug</th>
                                    <th>Kategori</th>
                                    <th>Publish</th>
                                    @if (auth()->user()->hasRole(['admin', 'editor']))
                                        <th>Rekomendasi</th>
                                    @endif
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articles as $article)
                                    <tr class="text-sm">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $article->title }}</td>
                                        <td>{{ $article->slug }}</td>
                                        <td>{{ $article->Category->name }}</td>
                                        <td>
                                            @if (is_null($article->publish))
                                                <span>Belum Dipublikasikan</span>
                                            @else
                                                <span>{{ \Carbon\Carbon::parse($article->publish)->format('d F Y H:i:s') }}</span>
                                            @endif
                                        </td>
                                        @if (auth()->user()->hasRole(['admin', 'editor']))
                                            <td>
                                                @if ($article->recommended)
                                                    <span>Direkomendasikan</span>
                                                @endif
                                            </td>
                                        @endif
                                        <td class="align-middle">
                                            <div class="dropdwon">
                                                <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu"
                                                    aria-labelledby="actionDropdown{{ $article->id }}">
                                                    <li>
                                                        <button type="button" class="dropdown-item text-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#articleDetail{{ $article->id }}">
                                                            <i class="fas fa-eye me-2"></i>Detail</button>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item text-warning"
                                                            href="{{ route('article_edit', $article->id) }}"
                                                            role="button"><i class="fas fa-edit me-2"></i>Edit</a>
                                                    </li>
                                                    <li>
                                                        <form
                                                            action="{{ route('article_publish', ['id' => $article->id]) }}"
                                                            id="publishForm_{{ $article->id }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="dropdown-item text-info">
                                                                @if (is_null($article->publish))
                                                                    <i class="fas fa-check me-2"></i>Publish
                                                                @else
                                                                    <i class="fas fa-times me-2"></i>UnPublish
                                                                @endif
                                                            </button>
                                                        </form>
                                                    </li>
                                                    @if (auth()->user()->hasRole(['admin', 'editor']))
                                                        <li>
                                                            <form
                                                                action="{{ route('article_recommended', ['id' => $article->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="dropdown-item text-secondary">
                                                                    @if (!$article->recommended)
                                                                        <i class="fas fa-check me-2"></i>Rekomendasikan
                                                                    @else
                                                                        <i class="fas fa-times me-2"></i>UnRekomendasi
                                                                    @endif
                                                                </button>
                                                            </form>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <form id="deleteForm_{{ $article->id }}"
                                                            action="{{ route('article_destroy', ['id' => $article->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="dropdown-item text-danger"
                                                                onclick="deleteConfirmation('deleteForm_{{ $article->id }}')">
                                                                <i class="fas fa-trash me-2"></i>Hapus
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($articles as $article)
        <!-- Modal Detail Article -->
        <div class="modal fade custom-modal" id="articleDetail{{ $article->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Article</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2 ">
                            <h6>Gambar</h6>
                            <img src="{{ asset('storage/image-article/' . $article->image) }}"
                                alt="Image {{ $article->event_name }}" class="shadow rounded text-center event_img">
                        </div>
                        <div class="mb-2">
                            <h6>Judul</h6>
                            <p>{{ $article->title }}</p>
                        </div>
                        <hr class="bg-primary">
                        <div class="mb-2">
                            <h6>Slug</h6>
                            <p>{{ $article->slug }}</p>
                        </div>
                        <hr class="bg-primary">
                        <div class="mb-2">
                            <h6>Kategori</h6>
                            <p>{{ $article->category->name }}</p>
                        </div>
                        <hr class="bg-primary">
                        <div class="mb-2">
                            <h6>Deskripsi</h6>
                            <p>{!! $article->description !!}</p>
                        </div>
                        <hr class="bg-primary">
                        <div class="mb-2">
                            <h6>Tag</h6>
                            @foreach ($article->tags as $tag)
                                <p class="badge bg-primary">{{ $tag->name }}</p>
                            @endforeach
                        </div>
                        <hr class="bg-primary">
                        <div class="mb-2">
                            <h6>Penulis</h6>
                            <p>{{ $article->user->name }}</p>
                        </div>
                        <hr class="bg-primary">
                        <div class="mb-2">
                            <h6>Publish</h6>
                            <p>
                                @if (is_null($article->publish))
                                    <span>Belum Dipublikasikan</span>
                                @else
                                    <span>Dipublikasikan pada
                                        {{ \Carbon\Carbon::parse($article->publish)->format('d F Y H:i:s') }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection


@section('addCss')
    <style>
        .event_img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            max-width: 100%;
            height: auto;
            width: 500px;
        }

        figure img {
            width: 100%;
            height: auto;
        }
    </style>
@endsection
