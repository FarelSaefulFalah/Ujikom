<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pemasok;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PemasokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data pemasok
        $pemasoks = Pemasok::all();

        // Menampilkan data di view
        return view('admin.pemasok.index', compact('pemasoks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form untuk menambahkan pemasok baru
        return view('admin.pemasok.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        // Validasi input dari user
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'no_telp' => 'required|string',
            'alamat' => 'required|string',
        ]);

        // Menyimpan data pemasok baru
        Pemasok::create($validatedData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.pemasok.index')->with('success', 'Pemasok berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemasok $pemasok)
    {
        // Menampilkan detail pemasok tertentu
        return view('admin.pemasok.show', compact('pemasok'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemasok $pemasok)
    {
        // Menampilkan form untuk mengedit pemasok
        return view('admin.pemasok.edit', compact('pemasok'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemasok $pemasok)
    {
        // Validasi input dari user
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'no_telp' => 'required|string',
            'alamat' => 'required|string',
        ]);

        // Memperbarui data pemasok
        $pemasok->update($validatedData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.pemasok.index')->with('success', 'Pemasok berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemasok $pemasok)
    {
        // Menghapus data pemasok
        $pemasok->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.pemasok.index')->with('success', 'Pemasok berhasil dihapus.');
    }
}
