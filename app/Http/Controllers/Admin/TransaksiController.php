<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\transaksi;
use App\Models\transaksi_detail;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
   public function barang()
    {
        $transaksis = transaksi::with('details.barang')->latest()->paginate(10);

        $grandQuantity = transaksi_detail::sum('jumlah');

        return view('admin.transaksi.index', compact('transaksis', 'grandQuantity'));
    }

    // public function vehicle()
    // {
    //     $rents = Rent::with('vehicle', 'user')->when(request()->q, function($search){
    //         $search = $search->whereHas('user', function($query){
    //             $query->where('name', 'like', '%'.request()->q.'%');
    //         })->orWhereHas('vehicle', function($query){
    //             $query->where('name', 'like', '%'.request()->q.'%');
    //         });
    //     })->latest()->paginate(10);

    //     return view('admin.transaksi.vehicle', compact('rents'));
    // }
}
