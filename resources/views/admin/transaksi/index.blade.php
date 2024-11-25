@extends('Layouts.main')
@section('content')
    <div class="container mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Daftar Barang Keluar</h5>
                </div>
                <div class="card-body">
                    <!-- Tabel Transaksi -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Customer</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori Produk</th>
                                    <th>Kuantitas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksis as $i => $transaction)
                                    <tr>
                                        <td>{{ $i + $transaksis->firstItem() }}</td>
                                        <td>{{ $transaction->user->name }}</td>
                                        <td>
                                            @foreach ($transaction->details as $details)
                                                <span class="d-block">{{ $details->barang->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($transaction->details as $details)
                                                <span class="d-block">{{ $details->barang->kategori->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($transaction->details as $details)
                                                <span class="d-block">{{ $details->jumlah }} - {{ $details->barang->satuan }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- Ringkasan Total Barang Keluar -->
                                <tr>
                                    <td colspan="4" class="font-weight-bold text-uppercase">
                                        <span class="text-muted">Total Barang Keluar</span>
                                    </td>
                                    <td class="font-weight-bold text-danger text-end">
                                        {{ $grandQuantity }} Barang
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="d-flex justify-content-end">
                        {{ $transaksis->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
