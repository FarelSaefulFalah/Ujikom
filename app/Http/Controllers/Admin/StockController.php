<?php

namespace App\Http\Controllers\Admin;

use App\Models\barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
     public function index()
    {
        $barangs = barang::paginate(10);

        return view('admin.stock.index', compact('barangs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $barang = barang::findOrFail($id);

        $barang->update([
            'jumlah' => $request->jumlah,
        ]);

        return back()->with('toast_success', 'Berhasil Menambahkan Stok Produk');
    }

}
