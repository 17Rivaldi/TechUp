@extends('dashboard.layouts.master')

@section('breadcrumb-item')
    <li class="breadcrumb-item text-white" aria-current="page">
        <a href="{{ route('user_index') }}" class="text-white">User</a>
    </li>
    <li class="breadcrumb-item text-white active opacity-8" aria-current="page">Edit</li>
@endsection

@section('content')
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Edit User</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('role_update', $roles->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Jenis Role</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $roles->name }}" required>
                            @error('name')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('role_index') }}" class="btn btn-danger" role="button">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
