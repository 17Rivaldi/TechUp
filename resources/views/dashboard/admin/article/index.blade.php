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
                                                <span>Dipublikasikan pada {{ $article->publish }}</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex flex-column flex-md-row text-center">
                                                <a class="btn btn-primary btn-sm text-xs"
                                                    href="{{ route('article_edit', $article->id) }}" role="button"><i
                                                        class="fas fa-edit me-1"></i>Edit</a>
                                                <button type="button" class="btn btn-warning btn-sm text-xs mx-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#articleDetail{{ $article->id }}"><i
                                                        class="fas fa-eye me-1"></i>Detail</button>
                                                <!-- FORM DELETE -->
                                                <form id="deleteForm_{{ $article->id }}"
                                                    action="{{ route('article_destroy', ['id' => $article->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm text-xs"
                                                        onclick="deleteConfirmation('deleteForm_{{ $article->id }}')">
                                                        <i class="fas fa-trash me-1"></i>Hapus
                                                    </button>
                                                </form>
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
        <!-- Modal untuk Detail Article -->
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
                        <div class="mb-2">
                            <h6>Slug</h6>
                            <p>{{ $article->slug }}</p>
                        </div>
                        <div class="mb-2">
                            <h6>Kategori</h6>
                            <p>{{ $article->category->name }}</p>
                        </div>
                        <div class="mb-2">
                            <h6>Deskripsi</h6>
                            <p>{!! $article->description !!}</p>
                        </div>
                        <div class="mb-2">
                            <h6>Publish</h6>
                            <p>
                                @if (is_null($article->publish))
                                    <span>Belum Dipublikasikan</span>
                                @else
                                    <span>Dipublikasikan pada {{ $article->publish }}</span>
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
    </style>
@endsection
