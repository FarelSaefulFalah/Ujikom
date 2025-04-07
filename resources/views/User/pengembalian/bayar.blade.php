@extends('layouts.main')

@section('content')
<div class="container">
    <h2 class="mb-4">Pembayaran Denda</h2>

    <div class="card">
        <div class="card-body">
            <h5>Barang: {{ $pengembalian->peminjaman->barang->nama }}</h5>
            <p>Tanggal Pengembalian: {{ \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian)->translatedFormat('d F Y') }}</p>
            <p>Denda: <strong class="text-danger">Rp {{ number_format($pengembalian->denda_akhir, 0, ',', '.') }}</strong></p>

            <form action="{{ route('user.pengembalian.prosesBayar', $pengembalian->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                    <select class="form-select" name="metode_pembayaran" required>
                        <option value="">Pilih Metode</option>
                        <option value="transfer">Transfer Bank</option>
                        <option value="qris">QRIS</option>
                        <option value="tunai">Tunai</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Bayar Denda</button>
            </form>
        </div>
    </div>
</div>
@endsection
