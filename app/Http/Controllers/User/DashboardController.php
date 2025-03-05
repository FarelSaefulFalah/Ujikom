<?php

namespace App\Http\Controllers\User;

use App\Models\transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        return view('user.dashboard');
    }
}
