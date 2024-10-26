@extends('dashboard.layouts.master')

@section('breadcrumb-item')
    <li class="breadcrumb-item text-white fw-bold opacity-7 active" aria-current="page">User</li>
@endsection

@section('content')
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Daftar User</h6>
                    <a href="{{ route('user_create') }}" class="btn btn-primary" role="button"><i
                            class="fas fa-plus me-2"></i>Add</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-responsive table-striped table-hover" style="width:100%">
                            <thead>
                                <tr class="text-sm">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                {{ $role->name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            <a class="btn btn-primary text-xs my-auto"
                                                href="{{ route('user_edit', $user->id) }}" role="button"><i
                                                    class="fas fa-edit me-1"></i>Edit</a>
                                            <!-- Formulir untuk DELETE -->
                                            <form action="{{ route('user_destroy', $user->id) }}" method="POST"
                                                style="display: inline;"
                                                onsubmit="return confirm('Apakah kamu yakin ingin menghapus artikel ini?');">
                                                @csrf
                                                @method('DELETE')
                                                {{-- <button type="submit" class="btn btn-danger text-xs my-auto"
                                                    onclick="return confirm('Are you sure you want to delete this user?')">
                                                    <i class="fas fa-trash me-1"></i>Hapus
                                                </button> --}}
                                                <button type="submit" class="btn btn-danger text-xs my-auto">
                                                    <i class="fas fa-trash me-1"></i>Hapus
                                                </button>
                                            </form>
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
@endsection
