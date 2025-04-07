<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    public function index()
{
    $peminjaman = Peminjaman::where('user_id', auth()->id())
        ->with(['barang', 'pengembalian.pembayaran']) // tambahkan relasi ini
        ->get();

    foreach ($peminjaman as $pinjam) {
        $pinjam->cekKeterlambatan(); // ini juga bagus udah otomatis update
    }

    return view('user.pengembalian.index', compact('peminjaman'));
}


public function prosesPengembalian($id)
{
    $peminjaman = Peminjaman::with('barang')->where('user_id', auth()->id())->findOrFail($id);

    if ($peminjaman->status_peminjaman === 'returned') {
        return redirect()->back()->with('error', 'Barang sudah dikembalikan sebelumnya.');
    }

    // Update status keterlambatan sebelum diproses
    $peminjaman->cekKeterlambatan();

    $tanggalHariIni = now();
    $denda = 0;

    if ($tanggalHariIni->gt($peminjaman->tanggal_kembali)) {
        $selisihHari = $tanggalHariIni->diffInDays($peminjaman->tanggal_kembali);
        $denda = $peminjaman->hitungDenda($tanggalHariIni);
    }

    // Buat data pengembalian
    $pengembalian = new Pengembalian();
    $pengembalian->peminjaman_id = $peminjaman->id;
    $pengembalian->tanggal_pengembalian = $tanggalHariIni;
    $pengembalian->denda_akhir = $denda;
    $pengembalian->keterangan = $denda > 0 ? 'Terlambat' : 'Tepat waktu';
    $pengembalian->save();

    // Ubah status peminjaman ke "returned"
    $peminjaman->status_peminjaman = 'returned';
    $peminjaman->save();

    // Tambahkan stok barang kembali
    $peminjaman->barang->jumlah += 1;
    $peminjaman->barang->save();

    return redirect()->route('user.pengembalian.index')->with('success', 'Barang berhasil dikembalikan' . ($denda > 0 ? ' dan Anda dikenakan denda.' : '.'));
}


public function showBayar($id)
{
    $pengembalian = Pengembalian::with(['peminjaman.barang', 'pembayaran'])
        ->where('id', $id)
        ->firstOrFail();

    return view('user.pengembalian.bayar', compact('pengembalian'));
}


public function prosesBayar(Request $request, $id)
{
    $request->validate([
        'metode_pembayaran' => 'required',
    ]);

    $pengembalian = Pengembalian::with('pembayaran', 'peminjaman')->findOrFail($id);

    if ($pengembalian->peminjaman->user_id !== Auth::id()) {
        abort(403);
    }

    if ($pengembalian->denda_akhir <= 0 || $pengembalian->pembayaran) {
        return redirect()->route('user.pengembalian.index')->with('info', 'Tidak ada denda yang perlu dibayar.');
    }

    $pengembalian->bayarDenda(Auth::id(), $request->metode_pembayaran);

    return redirect()->route('user.pengembalian.index')->with('success', 'Denda berhasil dibayar.');
}
}
