@extends('layouts.user')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Pengembalian Barang Saya</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Barang</th>
                <th>Tanggal Pengembalian</th>
                <th>Denda</th>
                <th>Status Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengembalians as $pengembalian)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pengembalian->peminjaman->barang->nama }}</td>
                <td>{{ $pengembalian->tanggal_pengembalian }}</td>
                <td>Rp {{ number_format($pengembalian->denda_akhir, 0, ',', '.') }}</td>
                <td>
                    @if($pengembalian->pembayaran)
                        <span class="badge bg-success">Lunas</span>
                    @else
                        <span class="badge bg-danger">Belum Lunas</span>
                    @endif
                </td>
                <td>
                    @if(!$pengembalian->pembayaran)
                    <a href="{{ route('user.pengembalian.bayar', $pengembalian->id) }}" class="btn btn-primary btn-sm">Bayar</a>
                    @else
                    <button class="btn btn-secondary btn-sm" disabled>Sudah Dibayar</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
