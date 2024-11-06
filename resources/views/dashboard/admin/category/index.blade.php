@extends('dashboard.layouts.master')

@section('breadcrumb-item')
    <li class="breadcrumb-item text-white fw-bold opacity-7 active" aria-current="page">Category</li>
@endsection

@section('content')
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Daftar Category</h6>
                    <a href="{{ route('category_create') }}" class="btn btn-primary" role="button"><i
                            class="fas fa-plus me-2"></i>Add</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-responsive table-striped table-hover" style="width:100%">
                            <thead>
                                <tr class="text-sm">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @foreach ($categories as $category)
                                <tr class="align-middle">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex flex-column flex-md-row text-center">
                                            <a class="btn btn-primary btn-sm text-xs me-1"
                                                href="{{ route('category_edit', $category->id) }}" role="button"><i
                                                    class="fa fa-edit me-1"></i>Edit</a>
                                            <!-- FORM DELETE -->
                                            <form id="deleteForm_{{ $category->id }}"
                                                action="{{ route('category_destroy', ['id' => $category->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm text-xs"
                                                    onclick="deleteConfirmation('deleteForm_{{ $category->id }}')">
                                                    <i class="fas fa-trash me-1"></i>Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
