@extends('Layouts.main')
@section('content')
<div class="container">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>DAFTAR PRODUK</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangs as $i => $barang)
                            <tr>
                                <td>{{ $i + $barangs->firstItem() }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . ($barang->gambar ?? 'default-image.jpg')) }}" width="50">
                                </td>
                                <td>{{ $barang->nama }}</td>
                                <td>{{ $barang->kategori->name }}</td>
                                <td>{{ $barang->jumlah }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-{{ $barang->id }}">Tambah Stok</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modal-{{ $barang->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $barang->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel-{{ $barang->id }}">Tambah Stok Barang - {{ $barang->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.stock.update', $barang->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="jumlah-{{ $barang->id }}" class="form-label">Stok Barang</label>
                                                            <input type="text" name="jumlah" id="jumlah-{{ $barang->id }}" class="form-control" value="{{ $barang->jumlah }}" placeholder="Jumlah Barang">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $barangs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
