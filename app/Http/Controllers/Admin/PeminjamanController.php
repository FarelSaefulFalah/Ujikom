<?php

namespace App\Http\Controllers\Admin;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PeminjamanController extends Controller
{
    /**
     * Menampilkan daftar peminjaman.
     */
    public function index()
    {
        $peminjaman = Peminjaman::with('user', 'barang')->latest()->get();
        return view('admin.peminjaman.index', compact('peminjaman'));
    }

    /**
     * Menyimpan peminjaman baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'barang_id' => 'required|exists:barang,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
        ]);

        Peminjaman::create([
            'user_id' => $request->user_id,
            'barang_id' => $request->barang_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status_peminjaman' => 'pending', // Default status
        ]);

        return redirect()->route('admin.peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan');
    }

    /**
     * Mengupdate status peminjaman.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'status_peminjaman' => 'required|in:pending,approved,returned,rejected',
        ]);

        $peminjaman->update([
            'status_peminjaman' => $request->status_peminjaman,
        ]);

        return redirect()->route('admin.peminjaman.index')->with('success', 'Status peminjaman diperbarui');
    }

    /**
     * Menyetujui peminjaman.
     */
    public function approve($id)
{
    $peminjaman = Peminjaman::findOrFail($id);
    $barang = $peminjaman->barang;

    // Cek apakah barang tersedia
    if ($barang->jumlah <= 0) {
        return redirect()->back()->with('error', 'Barang tidak cukup untuk dipinjam.');
    }

    // Kurangi jumlah barang
    $barang->decrement('jumlah');

    // Update status peminjaman
    $peminjaman->update(['status_peminjaman' => 'approved']);

    return redirect()->route('admin.peminjaman.index')->with('success', 'Peminjaman disetujui, barang telah dikurangi.');
}


    /**
     * Menolak peminjaman.
     */
    public function reject($id)
{
    $peminjaman = Peminjaman::findOrFail($id);
    $peminjaman->update(['status_peminjaman' => 'rejected']);

    return redirect()->route('admin.peminjaman.index')->with('success', 'Peminjaman ditolak.');
}


    /**
     * Menghapus peminjaman.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();
        return redirect()->route('admin.peminjaman.index')->with('success', 'Peminjaman berhasil dihapus');
    }
}
