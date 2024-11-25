<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // Ambil data keranjang berdasarkan user
        $carts = Cart::where('user_id', Auth::id())->latest()->get();

        // Hitung total quantity
        $grandQuantity = $carts->sum('jumlah');

        // Jika keranjang ada isinya
        if ($carts->count() > 0) {
            return view('landing.cart.index', compact('carts', 'grandQuantity'));
        }

        // Jika keranjang kosong
        return back()->with('toast_error', 'Keranjang anda kosong');
    }

    public function store(Barang $barang)
    {
        $user = Auth::user();

        // Cek apakah barang sudah ada di keranjang
        $alreadyInCart = Cart::where('user_id', $user->id)
            ->where('barang_id', $barang->id)
            ->first();

        if ($alreadyInCart) {
            // Jika barang sudah ada di keranjang
            return back()->with('toast_error', 'Produk sudah ada di dalam keranjang');
        } else {
            // Tambahkan barang ke keranjang
            $user->cart()->create([
                'barang_id' => $barang->id,
                'jumlah' => 1,
            ]);

            return redirect(route('cart.index'))
                ->with('toast_success', 'Produk berhasil ditambahkan ke keranjang');
        }
    }

    public function update(Request $request, Cart $cart)
    {
        $barang = Barang::whereId($cart->barang_id)->first();

        // Cek apakah stok mencukupi
        if ($barang->stock < $request->jumlah) {
            return back()->with('toast_error', 'Stok produk tidak mencukupi');
        } else {
            // Update jumlah barang di keranjang
            $cart->update([
                'jumlah' => $request->jumlah,
            ]);

            return back()->with('toast_success', 'Jumlah produk berhasil diubah');
        }
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        // Cek apakah masih ada item di keranjang
        if (Cart::where('user_id', Auth::id())->count() >= 1) {
            return back()->with('toast_success', 'Produk berhasil dikeluarkan dari keranjang');
        } else {
            return redirect(route('landing'))
                ->with('toast_success', 'Keranjang anda kosong');
        }
    }
}
