<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
     public function index(Request $request)
    {
        $search = $request->search;

        $kategoris = kategori::when($search, function($query) use($search){
            $query = $query->where('name', 'like', '%'.$search.'%');
        })->get();

        return view('landing.kategori.index', compact('kategoris', 'search'));
    }

    public function show($slug)
    {
        $kategori = kategori::where('slug', $slug)->first();

        $barangs = barang::where('kategori_id', $kategori->id)->get();

        return view('landing.kategori.show', compact('kategori', 'barangs'));
    }
}
