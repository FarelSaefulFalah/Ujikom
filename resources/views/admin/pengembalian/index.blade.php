@extends('layouts.main')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Pengembalian Barang (Admin)</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama User</th>
                <th>Barang</th>
                <th>Tanggal Pengembalian</th>
                <th>Denda</th>
                <th>Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengembalians as $pengembalian)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pengembalian->peminjaman->user->name }}</td>
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
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
