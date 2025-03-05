<?php

namespace App\Http\Controllers\User;

use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $barang = Barang::where('jumlah', '>', 0)->get();
        return view('user.peminjaman.index', compact('barang'));
    }

    public function myPeminjaman()
    {
        $peminjaman = Peminjaman::where('user_id', Auth::id())
            ->with('barang')
            ->orderBy('created_at', 'desc')
            ->get();

        // Debugging: Cek apakah data ada
        if ($peminjaman->isEmpty()) {
            return redirect()->route('user.peminjaman.index')->with('error', 'Tidak ada riwayat peminjaman.');
        }

        return view('user.peminjaman.my', compact('peminjaman'));
    }
    

    public function store(Request $request, $id) {
        $barang = Barang::findOrFail($id);
    
        // Cek apakah user sudah mengajukan peminjaman untuk barang ini
        $cekPeminjaman = Peminjaman::where('user_id', Auth::id())
            ->where('barang_id', $id)
            ->where('status_peminjaman', 'pending')
            ->exists();
    
        if ($cekPeminjaman) {
            return redirect()->back()->with('error', 'Anda sudah mengajukan peminjaman untuk barang ini.');
        }
    
        // User hanya mengajukan peminjaman, tidak mengurangi jumlah barang
        Peminjaman::create([
            'user_id' => Auth::id(),
            'barang_id' => $id,
            'tanggal_pinjam' => now(),
            'tanggal_kembali' => now()->addDays(7),
            'status_peminjaman' => 'pending' // Status awal "pending"
        ]);
    
        return redirect()->route('user.peminjaman.my')->with('success', 'Peminjaman berhasil diajukan dan menunggu persetujuan.');
    }
    
        
}
