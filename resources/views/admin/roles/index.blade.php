@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Manajemen Role dan Permission</h1>

        <!-- Tombol untuk membuka modal create role -->
        <button class="btn btn-primary my-3" data-toggle="modal" data-target="#rolePermissionModal">
            Create Role
        </button>

        <!-- Daftar Role dalam Tabel -->
        <h2 class="mt-4">Daftar Role</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Role</th>
                    <th>Permission</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>
                            @foreach ($role->permissions as $permission)
                                <span class="badge badge-info">{{ $permission->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <!-- Tombol untuk membuka modal edit role -->
                            <button class="btn btn-secondary" data-toggle="modal"
                                data-target="#rolePermissionModal{{ $role->id }}">
                                Edit Role
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Edit Role dan Permission (per role) -->
                    <div class="modal fade" id="rolePermissionModal{{ $role->id }}" tabindex="-1"
                        aria-labelledby="rolePermissionModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="rolePermissionModalLabel">Edit Role: {{ $role->name }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Input untuk nama role -->
                                        <div class="form-group">
                                            <label for="role_name">Nama Role</label>
                                            <input type="text" name="role_name" class="form-control"
                                                value="{{ $role->name }}" required>
                                        </div>

                                        <!-- Checkbox untuk permission -->
                                        <h6>Permission</h6>
                                        @foreach ($permissions as $permission)
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="permissions[]"
                                                    value="{{ $permission->id }}"
                                                    {{ $role->permissions->contains($permission) ? 'checked' : '' }}>
                                                <label class="form-check-label">{{ $permission->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        <!-- Modal Create Role dan Permission -->
        <div class="modal fade" id="rolePermissionModal" tabindex="-1" aria-labelledby="rolePermissionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.roles.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="rolePermissionModalLabel">Create New Role</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Input untuk nama role -->
                            <div class="form-group">
                                <label for="role_name">Nama Role</label>
                                <input type="text" name="role_name" class="form-control" required>
                            </div>

                            <!-- Checkbox untuk permission -->
                            <h6>Assign Permissions</h6>
                            @foreach ($permissions as $permission)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="permissions[]"
                                        value="{{ $permission->name }}">
                                    <label class="form-check-label">{{ $permission->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
