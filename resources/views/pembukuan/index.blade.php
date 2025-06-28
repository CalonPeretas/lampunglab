@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-xl font-bold mb-4">Laporan Pembukuan</h2>

    <form method="GET" class="mb-4 flex flex-wrap gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Tanggal Awal</label>
            <input type="date" name="tanggal_awal" class="border rounded px-3 py-2" value="{{ request('tanggal_awal') }}">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Tanggal Akhir</label>
            <input type="date" name="tanggal_akhir" class="border rounded px-3 py-2" value="{{ request('tanggal_akhir') }}">
        </div>
        <div class="flex items-end">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Tampilkan</button>
        </div>
    </form>

    <p class="font-semibold mb-2">Total Pendapatan: 
        <span class="text-green-600 font-bold">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</span>
    </p>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Tanggal</th>
                    <th class="px-4 py-2 border">Dokter</th>
                    <th class="px-4 py-2 border">Pasien</th>
                    <th class="px-4 py-2 border">Jenis Gigi</th>
                    <th class="px-4 py-2 border">Qty</th>
                    <th class="px-4 py-2 border">Status Bayar</th>
                    <th class="px-4 py-2 border">Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksis as $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2">{{ $item->created_at->format('Y-m-d') }}</td>
                        <td class="border px-4 py-2">{{ $item->dokter->nama }}</td>
                        <td class="border px-4 py-2">{{ $item->pasien }}</td>
                        <td class="border px-4 py-2">{{ $item->jenisGigi->nama }}</td>
                        <td class="border px-4 py-2">{{ $item->jumlah }}</td>
                        <td class="border px-4 py-2">{{ $item->status_pembayaran }}</td>
                        <td class="border px-4 py-2">Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
