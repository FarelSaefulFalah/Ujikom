<?php

namespace App\Http\Controllers\Admin;

use App\Models\pemasok;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class PemasokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemasoks = pemasok::all();

        return view('admin.pemasok.index', compact('pemasoks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(pemasok $pemasok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pemasok $pemasok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pemasok $pemasok)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pemasok $pemasok)
    {
        //
    }
}
