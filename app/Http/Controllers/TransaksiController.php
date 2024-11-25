<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Cart;
use App\Models\Transaksi;
use App\Models\Transaksi_detail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        // Memulai proses transaksi
        DB::beginTransaction();

        try {
            // Validasi keranjang
            $userId = Auth::id();
            $carts = Cart::where('user_id', $userId)->get();

            if ($carts->isEmpty()) {
                return back()->with('error', 'Keranjang Anda kosong. Tidak ada transaksi yang dapat dilakukan.');
            }

            // Buat transaksi baru
            $transaksi = new Transaksi();
            $transaksi->invoice = 'INV-' . strtoupper(Str::random(8));
            $transaksi->user_id = $userId;
            $transaksi->save();

            // Proses setiap item di keranjang
            foreach ($carts as $cart) {
                // Ambil data barang
                $barang = Barang::find($cart->barang_id);

                if (!$barang) {
                    throw new \Exception("Barang dengan ID {$cart->barang_id} tidak ditemukan.");
                }

                if ($cart->jumlah > $barang->jumlah) {
                    throw new \Exception("Stok tidak mencukupi untuk barang: {$barang->name}");
                }

                // Simpan detail transaksi
                $detail = new Transaksi_detail();
                $detail->transaksi_id = $transaksi->id;
                $detail->barang_id = $cart->barang_id;
                $detail->jumlah = $cart->jumlah;
                $detail->save();

                // Kurangi stok barang
                $barang->decrement('jumlah', $cart->jumlah);
            }

            // Bersihkan keranjang
            Cart::where('user_id', $userId)->delete();

            // Commit database
            DB::commit();

            return redirect()->route('landing')->with('success', 'Transaksi berhasil! Pesanan Anda akan diproses.');
        } catch (\Exception $e) {
            // Rollback jika terjadi error
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
