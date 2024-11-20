<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\kategori;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function __invoke(){
        $kategoris = kategori::all();
        $barangs = barang::all();

        return view('landing.welcome', compact('kategoris', 'barangs'));
    }
}
