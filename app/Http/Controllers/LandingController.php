<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function __Invoke(Request $request)
    {
        // Search functionality
        $search = $request->input('search', '');

        // Ambil semua barang, termasuk kategori
        $barangs = Barang::with('kategori')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->get();

        // Ambil semua kategori, termasuk jumlah barang di dalamnya
        $kategoris = Kategori::withCount('barang')->get();

        return view('landing.welcome', compact('barangs', 'kategoris', 'search'));
    }
}
