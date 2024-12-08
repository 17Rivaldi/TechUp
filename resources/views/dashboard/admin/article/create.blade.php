@extends('dashboard.layouts.master')

@section('breadcrumb-item')
    <li class="breadcrumb-item text-white" aria-current="page">
        <a href="{{ route('article_index') }}" class="text-white">Article</a>
    </li>
    <li class="breadcrumb-item text-white active opacity-8" aria-current="page">Create</li>
@endsection

@section('content')
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Tambah Article</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('article_store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ old('title') }}" required autofocus>
                            @error('title')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug"
                                value="{{ old('slug') }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                            @error('description')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category_id"
                                aria-label="Default select example">
                                <option selected disabled>Pilih Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image"
                                value="{{ old('image') }}" required>
                            @error('image')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tags" class="form-label">Tag</label>
                            <select class="form-select" id="tags" name="tags[]" multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            @error('tags')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Tambah Article</button>
                        <a href="{{ route('article_index') }}" class="btn btn-danger" role="button">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addJs')
    <script>
        ClassicEditor
            .create(document.querySelector('#description'), {
                ckfinder: {
                    uploadUrl: '{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}',
                },
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
