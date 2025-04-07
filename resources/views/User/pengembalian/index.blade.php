@extends('layouts.main')

@section('content')
<div class="container">
    <h2 class="mb-4">Pengembalian Barang</h2>

    @if($peminjaman->isEmpty())
        <div class="alert alert-info text-center">
            Anda belum memiliki barang yang bisa dikembalikan.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Barang</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjaman as $item)
    @php
        $pengembalian = $item->pengembalian;
        $sudahBayar = $pengembalian && $pengembalian->pembayaran;
        $denda = $pengembalian ? $pengembalian->denda_akhir : $item->denda;
    @endphp

    <tr class="{{ $denda > 0 && !$sudahBayar ? 'table-danger' : '' }}">
        <td>{{ $item->barang->nama ?? '-' }}</td>
        <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('d F Y') }}</td>
        <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('d F Y') }}</td>
        <td>
            @if($item->status_peminjaman === 'terlambat')
                <span class="badge bg-danger">Terlambat</span>
            @elseif($item->status_peminjaman === 'returned')
                <span class="badge bg-secondary">Dikembalikan</span>
            @else
                <span class="badge bg-success">Tepat Waktu</span>
            @endif
        </td>
        <td>
            @if($denda > 0 && !$sudahBayar)
                <span class="text-danger">Rp {{ number_format($denda, 0, ',', '.') }}</span>
            @elseif($sudahBayar)
                <span class="text-success">Sudah Dibayar</span>
            @else
                <span class="text-muted">Tidak Ada Denda</span>
            @endif
        </td>
        <td>
            @if($item->status_peminjaman !== 'returned')
                <form action="{{ route('user.pengembalian.proses', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mengembalikan barang ini?')">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm">Kembalikan</button>
                </form>
            @elseif($denda > 0 && !$sudahBayar)
                <a href="{{ route('user.pengembalian.showBayar', $pengembalian->id) }}" class="btn btn-warning btn-sm">Bayar Denda</a>
            @else
                <span class="text-muted">Sudah Dikembalikan</span>
            @endif
        </td>
    </tr>
@endforeach

                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
