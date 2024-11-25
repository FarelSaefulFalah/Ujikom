<?php

namespace App\Http\Controllers\Users;

use App\Models\transaksi;
use App\Models\cart;
use App\Http\Controllers\Controller;
use App\Models\transaksi_detail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class TransaksiController extends Controller
{

    public function __invoke(Request $request)
    {
        $user = Auth::id();

        $transaksis = transaksi::with('details.barang')->where('user_id', $user)->latest()->paginate(10);

        // $grandQuantity = transaksiDetail::sum('quantity');

        // $transaksis = transaksiDetail::with('barang', 'transaksi')->whereHas('transaksi', function($query) use($user){
        //     $query->where('user_id', $user);
        // })->paginate(10);

        $grandtransaksi = transaksi::with('details.barang')->where('user_id', $user)->count();

        $grandQuantity = transaksi_detail::with('transaksi', 'barang')->whereHas('transaksi', function($query) use($user){
            $query->where('user_id', $user);
        })->sum('jumlah');

        return view('Users.transaksi.index', compact('transaksis', 'grandtransaksi', 'grandQuantity'));
    }
}

