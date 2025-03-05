<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::whereHas('peminjaman', function ($query) {
            $query->where('user_id', auth()->id());
        })->with('peminjaman.barang', 'pembayaran')->get();

        return view('user.pengembalian.index', compact('pengembalians'));
    }

    public function showBayar($id)
    {
        $pengembalian = Pengembalian::with('peminjaman.barang')->findOrFail($id);

        if ($pengembalian->pembayaran) {
            return redirect()->route('user.pengembalian.index')->with('error', 'Denda sudah dibayar.');
        }

        return view('user.pengembalian.bayar', compact('pengembalian'));
    }

    public function prosesBayar(Request $request, $id)
    {
        $pengembalian = Pengembalian::findOrFail($id);

        $berhasil = $pengembalian->bayarDenda(auth()->id(), $request->metode_pembayaran);

        if ($berhasil) {
            return redirect()->route('user.pengembalian.index')->with('success', 'Denda berhasil dibayar!');
        } else {
            return redirect()->route('user.pengembalian.index')->with('error', 'Gagal membayar denda.');
        }
    }
}
