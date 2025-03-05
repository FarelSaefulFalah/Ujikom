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
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjaman as $item)
                <tr>
                    <td>{{ $item->barang->nama }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                    <td>
                        @if($item->status_peminjaman == 'pending')
                            <span class="badge bg-secondary">Menunggu Persetujuan</span>
                        @elseif($item->status_peminjaman == 'approved')
                            <span class="badge bg-primary">Disetujui</span>
                        @elseif($item->status_peminjaman == 'returned')
                            <span class="badge bg-success">Dikembalikan</span>
                        @elseif($item->status_peminjaman == 'rejected')
                            <span class="badge bg-danger">Ditolak</span>
                        @else
                            <span class="badge bg-dark">Status Tidak Diketahui</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Belum ada riwayat peminjaman</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
