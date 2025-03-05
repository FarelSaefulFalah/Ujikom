@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Kelola Peminjaman</h1>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Peminjaman</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Peminjam</th>
                            <th>Barang</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peminjaman as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->barang->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d-m-Y') }}</td>
                            <td>
                                @php
                                    $badgeClass = match ($item->status_peminjaman) {
                                        'pending' => 'warning',
                                        'approved' => 'primary',
                                        'returned' => 'success',
                                        'rejected' => 'danger',
                                        default => 'secondary'
                                    };
                                @endphp
                                <span class="badge badge-{{ $badgeClass }}">
                                    {{ ucfirst($item->status_peminjaman) }}
                                </span>
                            </td>
                            <td>
                                @if($item->status_peminjaman == 'pending')
                                <form action="{{ route('admin.peminjaman.approve', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                </form>
                                <form action="{{ route('admin.peminjaman.reject', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
