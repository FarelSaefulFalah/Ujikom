@extends('layouts.main')

@section('content')
<div class="container">
    <h2 class="mb-4">Riwayat Peminjaman Saya</h2>
    
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjaman as $item)
                @php
                    $pengembalian = $item->pengembalian;
                    $sudahBayar = $pengembalian && $pengembalian->pembayaran;
                @endphp
                <tr @if($item->denda > 0 && !$sudahBayar && $item->status_peminjaman === 'returned') style="background-color: #f8d7da;" @endif>
                    <td>{{ $item->barang->nama }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d-m-Y') }}</td>
                    <td>
                        @if($item->status_peminjaman == 'returned')
                            <span class="badge bg-success">Dikembalikan</span>
                        @elseif($item->status_peminjaman == 'terlambat')
                            <span class="badge bg-warning">Terlambat</span>
                        @elseif($item->status_peminjaman == 'pending')
                            <span class="badge bg-secondary">Menunggu Persetujuan</span>
                        @elseif($item->status_peminjaman == 'approved')
                            <span class="badge bg-primary">Disetujui</span>
                        @elseif($item->status_peminjaman == 'rejected')
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                    <td>
                        @if($item->denda > 0)
                            @if($sudahBayar)
                                <span class="badge bg-success">Sudah Dibayar</span>
                            @else
                                <span class="text-danger">Rp {{ number_format($item->denda, 0, ',', '.') }}</span><br>
                                <a href="{{ route('user.pengembalian.bayar', $pengembalian->id ?? 0) }}" class="btn btn-sm btn-danger mt-1">Bayar Denda</a>
                            @endif
                        @else
                            <span class="text-success">-</span>
                        @endif
                    </td>
                    
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada riwayat peminjaman</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
