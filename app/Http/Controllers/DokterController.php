<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Menampilkan daftar dokter.
     */
    public function index()
    {
        $dokters = Dokter::all(); // Kamu bisa ganti dengan ->paginate(10) jika mau pagination
        return view('dokter.index', compact('dokters'));
    }

    /**
     * Tampilkan form tambah dokter baru.
     */
    public function create()
    {
        return view('dokter.create');
    }

    /**
     * Simpan dokter baru ke database.
     */
    public function store(Request $request)
    {
    $request->validate([
        'nama' => 'required',
        'alamat' => 'nullable',
        'no_hp' => 'nullable'
    ]);

    Dokter::create($request->only(['nama', 'alamat', 'no_hp']));

    return redirect()->route('dokter.index')
        ->with('success', 'Data dokter berhasil disimpan.');
    }


    /**
     * Tampilkan form edit dokter.
     */
    public function edit(Dokter $dokter)
    {
        return view('dokter.edit', compact('dokter'));
    }

    /**
     * Perbarui data dokter di database.
     */
    public function update(Request $request, Dokter $dokter)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
        ]);

        $dokter->update($request->all());

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil diperbarui.');
    }

    /**
     * Hapus dokter dari database.
     */
    public function destroy(Dokter $dokter)
    {
        $dokter->delete();

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil dihapus.');
    }
}
