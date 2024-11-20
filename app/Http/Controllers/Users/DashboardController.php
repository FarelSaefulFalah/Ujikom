<?php

namespace App\Http\Controllers\Users;

use App\Models\transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $tranksaksis = transaksi::all();
        return view('Users.dashboard', compact('tranksaksis'));
    }
}
