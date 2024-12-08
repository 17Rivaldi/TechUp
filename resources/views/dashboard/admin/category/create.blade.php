@extends('dashboard.layouts.master')

@section('breadcrumb-item')
    <li class="breadcrumb-item text-white" aria-current="page">
        <a href="{{ route('category_index') }}" class="text-white">Category</a>
    </li>
    <li class="breadcrumb-item text-white active opacity-8" aria-current="page">Create</li>
@endsection

@section('content')
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Tambah Category</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('category_store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Category</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug"
                                value="{{ old('slug') }}" disabled>
                        </div>

                        <button type="submit" class="btn btn-primary">Tambah Category</button>
                        <a href="{{ route('category_index') }}" class="btn btn-danger" role="button">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
