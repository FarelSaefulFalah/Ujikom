<?php

namespace App\Http\Controllers\Admin;

use App\Models\barang;
use App\Models\kategori;
use App\Models\kendaraan;
use App\Models\pemasok;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class DashboardController extends Controller
{
    public function index(){
        $barangs = barang::count();
        $kategoris = kategori::count();
        $pemasoks = pemasok::count();
        $users = user::count();
        return view('admin.dashboard', compact('barangs', 'kategoris','pemasoks','users'));
    }
}
