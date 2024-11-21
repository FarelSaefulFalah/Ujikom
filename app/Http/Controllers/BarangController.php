<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;
use App\Http\Controllers\TransaksiDetailController;
class BarangController extends Controller
{
     public function index(Request $request)
    {
        $search = $request->search;

        $barangs = barang::with('kategori', 'pemasok')->when($search, function($query) use($search){
            $query = $query->where('name', 'like', '%'.$search.'%');
        })->orWhereHas('kategori', function($query) use($search){
            $query = $query->where('name', 'like', '%'.$search.'%');
        })->get();

        return view('landing.barang.index', compact('barangs', 'search'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $barang = barang::with('kategori')->where('slug', $slug)->first();

        $barangs = $barang->where('kategori_id', $barang->kategori_id)->where('id', '!=',$barang->id)->limit(5)->inRandomOrder()->get();

        $transaksis = TransaksiDetailController::with('transaksi', 'barang')->where('barang_id', $barang->id)->get();

        return view('landing.barang.show', compact('barang', 'barangs', 'transaksis'));
    }
}
