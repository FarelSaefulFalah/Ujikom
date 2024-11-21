@extends('Layouts.main')

@section('content')
    <div class="container">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>DAFTAR BARANG</h5>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBarangModal">
                        Tambah Barang
                    </button>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Pemasok</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangs as $barang)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $barang->name }}</td>
                                    <td>{{ $barang->kategori->name }}</td>
                                    <td>{{ $barang->pemasok->name }}</td>
                                    <td>{{ $barang->keterangan }}</td>
                                    <td>{{ $barang->jumlah }}</td>
                                    <td>{{ $barang->satuan }}</td>
                                    <td>
                                        <!-- Menampilkan gambar atau fallback jika tidak ada gambar -->
                                        <img src="{{ asset('storage/' . ($barang->gambar ?? 'default-image.jpg')) }}"
                                            alt="Gambar Barang" width="50">
                                    </td>
                                    <td>
                                        <!-- Edit Button -->
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editBarangModal{{ $barang->id }}">Edit</button>

                                        <!-- Delete Button -->
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteBarangModal{{ $barang->id }}">Delete</button>
                                    </td>
                                </tr>

                                <!-- Edit Barang Modal -->
                                <div class="modal fade" id="editBarangModal{{ $barang->id }}" tabindex="-1"
                                    aria-labelledby="editBarangModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.barang.update', $barang->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editBarangModalLabel">Edit Barang</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group mb-3">
                                                        <label for="name">Nama</label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ $barang->name }}" required>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="kategori_id">Kategori</label>
                                                        <select name="kategori_id" class="form-control" required>
                                                            @foreach ($kategoris as $kategori)
                                                                <option value="{{ $kategori->id }}"
                                                                    {{ $barang->kategori_id == $kategori->id ? 'selected' : '' }}>
                                                                    {{ $kategori->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="pemasok_id">Pemasok</label>
                                                        <select name="pemasok_id" class="form-control" required>
                                                            @foreach ($pemasoks as $pemasok)
                                                                <option value="{{ $pemasok->id }}"
                                                                    {{ $barang->pemasok_id == $pemasok->id ? 'selected' : '' }}>
                                                                    {{ $pemasok->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="keterangan">Keterangan</label>
                                                        <input type="text" name="keterangan" class="form-control"
                                                            value="{{ $barang->keterangan }}" required>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="jumlah">Jumlah</label>
                                                        <input type="number" name="jumlah" class="form-control"
                                                            value="{{ $barang->jumlah }}" required>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="satuan">Satuan</label>
                                                        <input type="text" name="satuan" class="form-control"
                                                            value="{{ $barang->satuan }}" required>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="gambar">Gambar</label>
                                                        <input type="file" name="gambar" class="form-control">
                                                        <small>Biarkan kosong jika tidak ingin mengganti gambar.</small>
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

                                <!-- Delete Barang Modal -->
                                <div class="modal fade" id="deleteBarangModal{{ $barang->id }}" tabindex="-1"
                                    aria-labelledby="deleteBarangModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.barang.destroy', $barang->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteBarangModalLabel">Delete Barang</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin ingin menghapus Barang
                                                        <strong>{{ $barang->name }}</strong>?
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

    <!-- Create Barang Modal -->
    <div class="modal fade" id="createBarangModal" tabindex="-1" aria-labelledby="createBarangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.barang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createBarangModalLabel">Tambah Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name">Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="kategori_id">Kategori</label>
                            <select name="kategori_id" class="form-control" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="pemasok_id">Pemasok</label>
                            <select name="pemasok_id" class="form-control" required>
                                <option value="" disabled selected>Pilih Pemasok</option>
                                @foreach ($pemasoks as $pemasok)
                                    <option value="{{ $pemasok->id }}">{{ $pemasok->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="keterangan">Keterangan</label>
                             <input type="text" name="keterangan" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="satuan">Satuan</label>
                            <input type="text" name="satuan" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="gambar">Gambar</label>
                            <input type="file" name="gambar" class="form-control" required>
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
