<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
      public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->latest()->get();

        $grandQuantity = $carts->sum('jumlah');

        if($carts->count() > 0){
            return view('landing.cart.index', compact('carts', 'grandQuantity'));
        }
        return back()->with('toast_error', 'Keranjang anda kosong');
    }

    public function store(barang $barang)
    {
        $user = Auth::user();

        $alreadyInCart = Cart::where('user_id', $user->id)->where('barang_id', $barang->id)->first();

        if($alreadyInCart){
            return back()->with('toast_error', 'Produk sudah ada didalam keranjang');
        }else{
            $user->cart()->create([
                'barang_id' => $barang->id,
                'jumlah' => '1',
            ]);
            return redirect(route('cart.index'))
                ->with('toast_success', 'Produk berhasil ditambahkan keranjang');
        }
    }


    public function update(Request $request, Cart $cart)
    {
        $barang = barang::whereId($cart->barang_id)->first();

        if($barang->jumlah < $request->jumlah){
            return back()->with('toast_error', 'Stok produk tidak mencukupi');
        }else{
            $cart->update([
                'jumlah' => $request->jumlah,
            ]);
            return back()->with('toast_success', 'Jumlah produk berhasil diubah');
        }
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        if($cart->count() >= 1){
            return back()->with('toast_success', 'Produk berhasil dikeluarkan dari keranjang');
        }else{
            return redirect(route('landing'))->with('toast_success', 'Keranjang anda kosong');
        }
    }
}
