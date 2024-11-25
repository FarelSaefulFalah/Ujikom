@extends('Layouts.landing.master')

@section('content')
    <div class="container my-5">
        <h3 class="mb-4">Keranjang Pengambilan Barang</h3>
        <div class="row">
            <!-- Keranjang -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        @if ($carts->isEmpty())
                            <div class="text-center py-5">
                                <h5 class="text-muted">Keranjang Anda Kosong</h5>
                                <a href="{{ route('barang.index') }}" class="btn btn-primary mt-3">
                                    <i class="fas fa-shopping-cart"></i> Tambah Barang
                                </a>
                            </div>
                        @else
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Gambar</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $index => $cart)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . ($cart->barang->gambar ?? 'default-image.jpg')) }}"
                                                     alt="{{ $cart->barang->name }}"
                                                     style="width: 60px; height: 40px; object-fit: cover;"
                                                     class="rounded">
                                            </td>
                                            <td>{{ $cart->barang->name }}</td>
                                            <td>
                                                <form action="{{ route('cart.update', $cart->id) }}" method="POST" class="d-flex align-items-center">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="number" name="jumlah" value="{{ $cart->jumlah }}"
                                                           min="1" max="{{ $cart->barang->jumlah }}"
                                                           class="form-control form-control-sm me-2" style="width: 70px;">
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fas fa-sync"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Ringkasan -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Ringkasan</h5>
                        <p>Total Barang: <span class="fw-bold">{{ $carts->count() }}</span></p>
                        <p>Total Jumlah: <span class="fw-bold">{{ $grandQuantity }} Qty</span></p>
                        <form action="{{ route('transaksi.store') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-check-circle"></i> Selesaikan Pengambilan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
