<?php

namespace App\Http\Controllers;

use App\Models\Pembukuan;
use Illuminate\Http\Request;

class PembukuanController extends Controller
{
    /**
     * Menampilkan daftar pembukuan dengan filter opsional.
     */
    public function index(Request $request)
    {
        $query = Pembukuan::query();

        // 🔍 Filter berdasarkan jenis
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        // 🔍 Filter berdasarkan rentang tanggal
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        // Ambil data terbaru
        $pembukuans = $query->latest()->get();

        return view('pembukuan.index', compact('pembukuans'));
    }

    /**
     * Tampilkan form untuk menambahkan data pembukuan baru.
     */
    public function create()
    {
        return view('pembukuan.create');
    }

    /**
     * Simpan data pembukuan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:Pemasukan,Pengeluaran',
            'keterangan' => 'required|string',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        Pembukuan::create($request->all());

        return redirect()->route('pembukuan.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit data pembukuan.
     */
    public function edit(Pembukuan $pembukuan)
    {
        return view('pembukuan.edit', compact('pembukuan'));
    }

    /**
     * Perbarui data pembukuan yang dipilih.
     */
    public function update(Request $request, Pembukuan $pembukuan)
    {
        $request->validate([
            'jenis' => 'required|in:Pemasukan,Pengeluaran',
            'keterangan' => 'required|string',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        $pembukuan->update($request->all());

        return redirect()->route('pembukuan.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Hapus data pembukuan.
     */
    public function destroy(Pembukuan $pembukuan)
    {
        $pembukuan->delete();

        return redirect()->route('pembukuan.index')->with('success', 'Data berhasil dihapus.');
    }

    /**
     * Tampilkan halaman cetak berdasarkan filter yang diberikan.
     */
    public function print(Request $request)
    {
        $query = Pembukuan::query();

        // 🔍 Filter jenis jika ada
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        // 🔍 Filter tanggal jika lengkap
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        $pembukuans = $query->latest()->get();

        return view('pembukuan.print', compact('pembukuans'));
    }
}
