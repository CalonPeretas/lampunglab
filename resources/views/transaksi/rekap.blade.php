<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Rekap Transaksi
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            <form method="GET" action="{{ route('transaksi.rekap') }}" class="bg-white dark:bg-gray-800 p-4 rounded-md shadow-sm">
                <div class="flex items-center space-x-4">
                    <div>
                        <label for="tanggal_awal" class="block text-sm text-gray-700 dark:text-gray-300">Tanggal Awal</label>
                        <input type="date" name="tanggal_awal" id="tanggal_awal" class="rounded-md border-gray-300 dark:bg-gray-700 dark:text-white" value="{{ request('tanggal_awal') }}">
                    </div>
                    <div>
                        <label for="tanggal_akhir" class="block text-sm text-gray-700 dark:text-gray-300">Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="rounded-md border-gray-300 dark:bg-gray-700 dark:text-white" value="{{ request('tanggal_akhir') }}">
                    </div>
                    <div class="pt-5">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Filter</button>
                        <a href="{{ route('transaksi.cetak', request()->only(['tanggal_awal', 'tanggal_akhir'])) }}" target="_blank" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md ml-2">Cetak</a>
                    </div>
                </div>
            </form>

            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg mt-4">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">No</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tgl Masuk</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Dokter</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Jenis Gigi</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Qty</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Total</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($transaksis as $trx)
                            <tr>
                                <td class="px-4 py-2 text-sm text-gray-900 dark:text-white">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 text-sm text-gray-900 dark:text-white">{{ $trx->created_at->format('d-m-Y') }}</td>
                                <td class="px-4 py-2 text-sm text-gray-900 dark:text-white">{{ $trx->dokter->nama ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-900 dark:text-white">{{ $trx->jenisGigi->nama ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-900 dark:text-white">{{ $trx->jumlah }}</td>
                                <td class="px-4 py-2 text-sm text-gray-900 dark:text-white">Rp{{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                                <td class="px-4 py-2 text-sm text-gray-900 dark:text-white">{{ $trx->status_pembayaran }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
