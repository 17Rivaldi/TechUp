@extends('dashboard.layouts.master')

@section('breadcrumb-item')
    <li class="breadcrumb-item text-white" aria-current="page">
        <a href="{{ route('article_index') }}" class="text-white">Article</a>
    </li>
    <li class="breadcrumb-item text-white fw-bold opacity-7 active" aria-current="page">Edit</li>
@endsection

@section('content')
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Edit Article</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('article_update', $article->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ $article->title }}" required>
                            @error('title')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug"
                                value="{{ $article->slug }}" selected disabled>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="5">{{ $article->description }}</textarea>
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
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $article->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            @if ($article->image)
                                <img class="mb-2" src="{{ asset('storage/image-article/' . $article->image) }}"
                                    alt="Current Event Image" width="100%" height="auto" style="max-width: 200px">
                            @else
                                No Image
                            @endif
                            <input type="file" class="form-control" id="image" name="image"
                                value="{{ $article->image }}">
                            @error('image')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tags" class="form-label">Tag</label>
                            <select class="form-select" id="tags" name="tags[]" multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->name }}" @if (in_array($tag->name, old('tags', $article->tags->pluck('name')->toArray()))) selected @endif>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tags')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('article_index') }}" class="btn btn-danger" role="button">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addJs')
    <!-- CkEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <!-- Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(editor => {
                editor.editing.view.change(writer => {
                    const toolbarElement = editor.ui.view.toolbar.element;
                    const editorElement = editor.ui.view.editable.element;

                    writer.setStyle('height', 'auto', editor.editing.view.document.getRoot());
                    writer.setStyle('border-bottom-left-radius', '10px', editor.editing.view.document
                        .getRoot());
                    writer.setStyle('border-bottom-right-radius', '10px', editor.editing.view.document
                        .getRoot());

                    // Set border radius dengan nilai berbeda untuk setiap ujung pada toolbar
                    toolbarElement.style.borderTopLeftRadius = '10px';
                    toolbarElement.style.borderTopRightRadius = '10px';
                    toolbarElement.style.borderBottomLeftRadius = '0';
                    toolbarElement.style.borderBottomRightRadius = '0';

                    // editor.ui.focusTracker.on('change:isFocused', (eventInfo, name, value) => {
                    //     if (value) {
                    //         editorElement.style.height = 'auto';
                    //         editorElement.style.borderBottomLeftRadius = '10px';
                    //         editorElement.style.borderBottomRightRadius = '10px';
                    //     } else {
                    //         editorElement.style.height = 'auto';
                    //         editorElement.style.borderBottomRightRadius = '10px';
                    //         editorElement.style.borderBottomLeftRadius = '10px';
                    //     }
                    // });
                })
            })
            .catch(error => {
                console.error(error);
            });

        $(document).ready(function() {
            $('#tags').select2({
                tags: true,
                tokenSeparators: [',', ' '],
                placeholder: "Select or type new tags",
            });
        });
    </script>
@endsection
