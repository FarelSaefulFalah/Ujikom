<?php

namespace App\Http\Controllers\User;

use App\Models\Barang;
use App\Models\Peminjaman;
use Carbon\Carbon;
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
        $peminjaman = Peminjaman::with(['barang', 'pengembalian.pembayaran'])
        ->where('user_id', auth()->id())
        ->get();
    

        // Debugging: Cek apakah data ada
        if ($peminjaman->isEmpty()) {
            return redirect()->route('user.peminjaman.index')->with('error', 'Tidak ada riwayat peminjaman.');
        }

        return view('user.peminjaman.my', compact('peminjaman'));
    }
    

//     public function store(Request $request, $id) {
//         $barang = Barang::findOrFail($id);
    
//         // Cek apakah user sudah mengajukan peminjaman untuk barang ini
//         $cekPeminjaman = Peminjaman::where('user_id', Auth::id())
//             ->where('barang_id', $id)
//             ->where('status_peminjaman', 'pending')
//             ->exists();
    
//         if ($cekPeminjaman) {
//             return redirect()->back()->with('error', 'Anda sudah mengajukan peminjaman untuk barang ini.');
//         }
    
//         // User hanya mengajukan peminjaman, tidak mengurangi jumlah barang
      

// Peminjaman::create([
//     'user_id' => Auth::id(),
//     'barang_id' => $id,
//     'tanggal_pinjam' => Carbon::now(),
//     'tanggal_kembali' => Carbon::now()->addMinutes(5), // hanya 1 menit kemudian
//     'status_peminjaman' => 'pending'
// ]);

    
//         return redirect()->route('user.peminjaman.my')->with('success', 'Peminjaman berhasil diajukan dan menunggu persetujuan.');
//     }
    
    // PERCOBAA DENDA

    public function store(Request $request, $id)
{
    $request->validate([
        'tanggal_pinjam' => 'required|date|after_or_equal:today',
        'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
    ]);

    $barang = Barang::findOrFail($id);

    $cekPeminjaman = Peminjaman::where('user_id', Auth::id())
        ->where('barang_id', $id)
        ->where('status_peminjaman', 'pending')
        ->exists();

    if ($cekPeminjaman) {
        return back()->with('error', 'Anda sudah mengajukan peminjaman untuk barang ini.');
    }

    Peminjaman::create([
        'user_id' => Auth::id(),
        'barang_id' => $id,
        'tanggal_pinjam' => $request->tanggal_pinjam,
        'tanggal_kembali' => $request->tanggal_kembali,
        'status_peminjaman' => 'pending'
    ]);

    return redirect()->route('user.peminjaman.my')->with('success', 'Peminjaman diajukan.');
}

        
}
