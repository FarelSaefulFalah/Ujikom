@extends('layouts.user')

@section('content')
<div class="container">
    <h2 class="mb-4">Bayar Denda</h2>

    <div class="card">
        <div class="card-body">
            <h5>Barang: {{ $pengembalian->peminjaman->barang->nama }}</h5>
            <p><strong>Tanggal Pengembalian:</strong> {{ $pengembalian->tanggal_pengembalian }}</p>
            <p><strong>Denda:</strong> Rp {{ number_format($pengembalian->denda_akhir, 0, ',', '.') }}</p>

            <form action="{{ route('user.pengembalian.prosesBayar', $pengembalian->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                    <select name="metode_pembayaran" class="form-control" required>
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Bayar Sekarang</button>
            </form>
        </div>
    </div>
</div>
@endsection
