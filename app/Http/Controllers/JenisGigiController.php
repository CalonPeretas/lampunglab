<?php

namespace App\Http\Controllers;

use App\Models\JenisGigi;
use Illuminate\Http\Request;

class JenisGigiController extends Controller
{
    public function index()
    {
        $jenisGigi = JenisGigi::all();
        return view('jenis_gigi.index', compact('jenisGigi'));
    }

    public function create()
    {
        return view('jenis_gigi.create');
    }

    public function store(Request $request)
    {
    $request->validate([
        'nama' => 'required|string|max:255',
        'harga' => 'required|numeric',
    ]);

    \App\Models\JenisGigi::create([
        'nama' => $request->input('nama'),
        'harga' => $request->input('harga'),
    ]);

    return redirect()->route('jenis-gigi.index')->with('success', 'Data berhasil ditambahkan.');
    }


    public function edit(JenisGigi $jenisGigi)
    {
        return view('jenis_gigi.edit', compact('jenisGigi'));
    }

    public function update(Request $request, JenisGigi $jenisGigi)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);

        $jenisGigi->update($request->all());

        return redirect()->route('jenis-gigi.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(JenisGigi $jenisGigi)
    {
        $jenisGigi->delete();

        return redirect()->route('jenis-gigi.index')->with('success', 'Data berhasil dihapus.');
    }
}
