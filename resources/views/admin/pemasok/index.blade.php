@extends('Layouts.main')

@section('content')
    <div class="container">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>DAFTAR Pemasok</h5>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPemasokModal">
                        Tambah Pemasok
                    </button>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>No Telephone</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemasoks as $Pemasok)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $Pemasok->name }}</td>
                                    <td>{{ $Pemasok->no_telp }}</td>
                                    <td>{{ $Pemasok->alamat }}</td>
                                    <td>
                                        <!-- Edit Button -->
                                        <button class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editPemasokModal{{ $Pemasok->id }}">Edit</button>

                                        <!-- Delete Button -->
                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deletePemasokModal{{ $Pemasok->id }}">Delete</button>
                                    </td>
                                </tr>

                                <!-- Edit Pemasok Modal -->
                                <div class="modal fade" id="editPemasokModal{{ $Pemasok->id }}" tabindex="-1"
                                    aria-labelledby="editPemasokModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.pemasok.update', $Pemasok->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editPemasokModalLabel">Edit Pemasok</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="name">Nama</label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ $Pemasok->name }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="no_telp">No Telephone</label>
                                                        <input type="text" name="no_telp" class="form-control"
                                                            value="{{ $Pemasok->no_telp }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat">Alamat</label>
                                                        <input type="text" name="alamat" class="form-control"
                                                            value="{{ $Pemasok->alamat }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Pemasok Modal -->
                                <div class="modal fade" id="deletePemasokModal{{ $Pemasok->id }}" tabindex="-1"
                                    aria-labelledby="deletePemasokModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.pemasok.destroy', $Pemasok->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deletePemasokModalLabel">Delete Pemasok</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete Pemasok
                                                        <strong>{{ $Pemasok->name }}</strong>?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Pemasok Modal -->
    <div class="modal fade" id="createPemasokModal" tabindex="-1" aria-labelledby="createPemasokModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.pemasok.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createPemasokModalLabel">Tambah Pemasok</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="no_telp">No Telephone</label>
                            <input type="text" name="no_telp" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
