{{-- @extends('layouts.main')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Barang yang Bisa Dipinjam</h2>
    <div class="row">
        @foreach($barang as $item)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->nama }}</h5>
                        <p class="card-text">Kategori: {{ $item->kategori->name }}</p>
                        <p class="card-text">Jumlah Tersedia: {{ $item->jumlah }}</p>
                        <form action="{{ route('user.peminjaman.store', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Pinjam</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection --}}

@extends('layouts.main')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Barang yang Bisa Dipinjam</h2>

    <div class="row">
        @foreach($barang as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $item->nama }}</h5>
                        <p class="card-text">Kategori: {{ $item->kategori->name }}</p>
                        <p class="card-text">Jumlah Tersedia: {{ $item->jumlah }}</p>

                        <form action="{{ route('user.peminjaman.store', $item->id) }}" method="POST" class="mt-auto">
                            @csrf
                            <div class="mb-2">
                                <label for="tanggal_pinjam_{{ $item->id }}" class="form-label">Tanggal Pinjam</label>
                                <input type="date" name="tanggal_pinjam" id="tanggal_pinjam_{{ $item->id }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_kembali_{{ $item->id }}" class="form-label">Tanggal Kembali</label>
                                <input type="date" name="tanggal_kembali" id="tanggal_kembali_{{ $item->id }}" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Ajukan Peminjaman</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
