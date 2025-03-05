<style>
      .jumbotron {
            padding: 6rem 2rem;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                        url('https://source.unsplash.com/1600x900/?technology,office') no-repeat center center;
            background-size: cover;
            color: white;
            text-align: center;
        }
        .jumbotron h1 {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .jumbotron p {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }
</style>

@extends('layouts.landing.master')

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h1>Welcome to Inventariz</h1>
            <p>Pusat Dimana Barang - Barang Yang Kamu Perlukan Berada Disini.</p>
        </div>
    </div>
    <br>

    <div class="container my-5">
        <div class="row">
            <!-- Kategori Section -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="fw-bold">Daftar Kategori</h3>
                        <span>Data Kategori</span>
                        <ul class="list-group">
                            @foreach ($kategoris as $kategori)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">{{ $kategori->name }}</span>
                                    <span class="badge bg-secondary">{{ $kategori->slug }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Barang Section -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="fw-bold">Daftar Barang</h3>
                        <span>Data Barang-Barang</span>
                        @foreach ($barangs as $barang)
                            <!-- Landscape Item -->
                            <div class="d-flex border-bottom py-3">
                                <!-- Gambar Barang -->
                                <div class="me-3">
                                    <img src="{{ asset('storage/' . ($barang->gambar ?? 'default-image.jpg')) }}"
                                        class="rounded" alt="Gambar {{ $barang->name }}"
                                        style="width: 120px; height: 80px; object-fit: cover;">
                                </div>
                                <!-- Detail Barang -->
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1">{{ $barang->name }}</h6>
                                    <p class="text-muted mb-0">Slug: {{ $barang->slug }}</p>
                                    <p class="text-secondary mb-2">Jumlah Stok: <span class="fw-bold">{{ $barang->jumlah }}</span></p>
                                </div>
                                <!-- Tambah ke Keranjang -->
                            </div>
                        @endforeach
                        <!-- Jika tidak ada barang -->
                        @if ($barangs->isEmpty())
                            <div class="text-center py-5">
                                <p class="text-muted">Tidak ada barang tersedia.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
