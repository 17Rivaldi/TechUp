@extends('dashboard.layouts.master')

@section('breadcrumb-item')
    <li class="breadcrumb-item text-white fw-bold opacity-7 active" aria-current="page">Role</li>
@endsection

@section('content')
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Daftar Role</h6>
                    <a href="{{ route('role_create') }}" class="btn btn-primary" role="button"><i
                            class="fas fa-plus me-2"></i>Add</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-responsive table-striped table-hover" style="width:100%">
                            <thead>
                                <tr class="text-sm">
                                    <th>No</th>
                                    <th>Role</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr class="text-sm">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td class="align-middle">
                                            <div class="d-flex flex column flex-md-row textcenter">
                                                <a class="btn btn-primary btn-sm text-xs me-1"
                                                    href="{{ route('role_edit', $role->id) }}" role="button"><i
                                                        class="fas fa-edit me-1"></i>Edit</a>
                                                <!-- FORM DELETE -->
                                                <form id="deleteForm_{{ $role->id }}"
                                                    action="{{ route('role_destroy', ['id' => $role->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm text-xs"
                                                        onclick="deleteConfirmation('deleteForm_{{ $role->id }}')">
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
@endsection
