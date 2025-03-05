@extends('layouts.main')

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
@endsection
