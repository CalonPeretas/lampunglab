<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Dokter;
use App\Models\JenisGigi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status');
        $dokterId = $request->input('dokter_id');

        $query = Transaksi::with(['dokter', 'jenisGigi'])->latest();

        if ($status && in_array($status, ['Lunas', 'Belum Lunas'])) {
            $query->where('status_pembayaran', $status);
        }

        if ($dokterId) {
            $query->where('dokter_id', $dokterId);
        }

        $transaksis = $query->get();
        $dokters = Dokter::all();

        return view('transaksi.index', compact('transaksis', 'status', 'dokters', 'dokterId'));
    }

    public function create()
    {
        $dokters = Dokter::all();
        $jenisGigis = JenisGigi::all();
        return view('transaksi.create', compact('dokters', 'jenisGigis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
            'jenis_gigi_id' => 'required|exists:jenis_gigis,id',
            'jumlah' => 'required|integer|min:1',
            'ongkir' => 'nullable|integer|min:0',
            'status_pembayaran' => 'required|in:Lunas,Belum Lunas',
            'tgl_selesai' => 'nullable|date',
        ]);

        $jenisGigi = JenisGigi::findOrFail($request->jenis_gigi_id);
        $totalHarga = $jenisGigi->harga * $request->jumlah;

        Transaksi::create([
            'dokter_id' => $request->dokter_id,
            'jenis_gigi_id' => $request->jenis_gigi_id,
            'jumlah' => $request->jumlah,
            'ongkir' => $request->ongkir ?? 0,
            'total_harga' => $totalHarga,
            'tgl_selesai' => $request->tgl_selesai,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    public function edit(Transaksi $transaksi)
    {
        $dokters = Dokter::all();
        $jenisGigis = JenisGigi::all();
        return view('transaksi.edit', compact('transaksi', 'dokters', 'jenisGigis'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
            'jenis_gigi_id' => 'required|exists:jenis_gigis,id',
            'jumlah' => 'required|integer|min:1',
            'ongkir' => 'nullable|integer|min:0',
            'status_pembayaran' => 'required|in:Lunas,Belum Lunas',
            'tgl_selesai' => 'nullable|date',
        ]);

        $jenisGigi = JenisGigi::findOrFail($request->jenis_gigi_id);
        $totalHarga = $jenisGigi->harga * $request->jumlah;

        $transaksi->update([
            'dokter_id' => $request->dokter_id,
            'jenis_gigi_id' => $request->jenis_gigi_id,
            'jumlah' => $request->jumlah,
            'ongkir' => $request->ongkir ?? 0,
            'total_harga' => $totalHarga,
            'status_pembayaran' => $request->status_pembayaran,
            'tgl_selesai' => $request->tgl_selesai,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function rekap()
    {
        $transaksis = Transaksi::with(['dokter', 'jenisGigi'])->get();
        return view('transaksi.rekap', compact('transaksis'));
    }

    public function cetak()
    {
        $transaksis = Transaksi::with(['dokter', 'jenisGigi'])->get();
        $totalPendapatan = $transaksis->sum(function ($trx) {
         return $trx->total_harga + ($trx->ongkir ?? 0); // jika ada ongkir
        });

        return view('transaksi.cetak', compact('transaksis', 'totalPendapatan'));
    }


    public function cetakFilter(Request $request)
    {
        $status = $request->input('status');
        $dokterId = $request->input('dokter_id');

        $query = Transaksi::with(['dokter', 'jenisGigi']);

        if ($status && in_array($status, ['Lunas', 'Belum Lunas'])) {
            $query->where('status_pembayaran', $status);
        }

        if ($dokterId) {
            $query->where('dokter_id', $dokterId);
        }

        $transaksis = $query->get();
        $dokter = $dokterId ? Dokter::find($dokterId) : null;
        $dokters = Dokter::all();

        $total = $transaksis->sum(function ($item) {
            return $item->total_harga + ($item->ongkir ?? 0);
        });

        return view('transaksi.print-filter', compact(
            'transaksis',
            'status',
            'dokter',
            'dokterId',
            'dokters',
            'total'
        ));
    }

    public function pembukuan(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $query = Transaksi::query();

        if ($tanggalAwal && $tanggalAkhir) {
            $query->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir]);
        }

        $transaksis = $query->with(['dokter', 'jenisGigi'])->get();
        $totalPendapatan = $transaksis->sum('total_harga');

        return view('pembukuan.index', compact(
            'transaksis',
            'totalPendapatan',
            'tanggalAwal',
            'tanggalAkhir'
        ));
    }

    public function cetakNota($id)
    {
        $transaksi = Transaksi::with(['dokter', 'jenisGigi'])->findOrFail($id);
        return view('transaksi.nota', compact('transaksi'));
    }

    public function show(Transaksi $transaksi)
    {
        return redirect()->route('transaksi.index');
    }
}
