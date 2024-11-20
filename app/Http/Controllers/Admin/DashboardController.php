<?php

namespace App\Http\Controllers\Admin;

use App\Models\barang;
use App\Models\kategori;
use App\Models\kendaraan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class DashboardController extends Controller
{
    public function index(){
        $barangs = barang::count();
        $kategoris = kategori::count();
        $kendaraans = kendaraan::count();
        return view('admin.dashboard', compact('barangs', 'kategoris', 'kendaraans'));
    }
}
