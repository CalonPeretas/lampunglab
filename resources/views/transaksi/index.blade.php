<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Data Transaksi
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- 🔘 Header dan Tombol Tambah --}}
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">List Transaksi</h3>
                    <a href="{{ route('transaksi.create') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow">
                        ➕ Tambah Transaksi
                    </a>
                </div>

                {{-- 🔍 Filter dan Tombol --}}
                <div class="flex justify-between mb-4 flex-col md:flex-row gap-4">
                    <form method="GET" action="{{ route('transaksi.index') }}" class="flex flex-wrap gap-2 items-end">
                        {{-- Status --}}
                        <div>
                            <label class="text-sm text-gray-600 dark:text-gray-300">Status Pembayaran</label>
                            <select name="status" class="form-select rounded-md shadow-sm">
                                <option value="">-- Semua --</option>
                                <option value="Lunas" {{ request('status') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                <option value="Belum Lunas" {{ request('status') == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                            </select>
                        </div>

                        {{-- Dokter --}}
                        <div>
                            <label class="text-sm text-gray-600 dark:text-gray-300">Nama Dokter</label>
                            <select name="dokter_id" class="form-select rounded-md shadow-sm">
                                <option value="">-- Semua Dokter --</option>
                                @foreach($dokters as $dokter)
                                    <option value="{{ $dokter->id }}" {{ request('dokter_id') == $dokter->id ? 'selected' : '' }}>
                                        {{ $dokter->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tombol Filter --}}
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md shadow">
                            🔍 Filter
                        </button>

                        {{-- Cetak Semua --}}
                        <a href="{{ route('transaksi.cetak') }}" target="_blank"
                           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md shadow">
                            🖨️ Cetak Semua
                        </a>

                        {{-- Cetak Berdasarkan Filter --}}
                        <a href="{{ route('transaksi.print.filter', ['status' => request('status'), 'dokter_id' => request('dokter_id')]) }}"
                           target="_blank"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow">
                            🖨️ Cetak Hasil Filter
                        </a>
                    </form>
                </div>

                {{-- Tabel --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Nama Dokter</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Jenis Gigi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Jumlah</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Ongkir</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Total Harga</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Tgl Selesai</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($transaksis as $item)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $item->id }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $item->dokter->nama ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $item->jenisGigi->nama ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $item->jumlah }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">Rp{{ number_format($item->ongkir, 0, ',', '.') }}</td> <!-- Kolom Ongkir -->
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                        {{ $item->tgl_selesai ? \Carbon\Carbon::parse($item->tgl_selesai)->format('d-m-Y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded
                                            {{ $item->status_pembayaran === 'Lunas' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                                            {{ $item->status_pembayaran ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-right">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('transaksi.nota', $item->id) }}"
                                               target="_blank"
                                               class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md text-xs font-medium shadow">
                                                🧾 Nota
                                            </a>
                                            <a href="{{ route('transaksi.edit', $item->id) }}"
                                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-xs font-medium shadow">
                                                ✏️ Edit
                                            </a>
                                            <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-xs font-medium shadow">
                                                    🗑️ Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center px-6 py-4 text-sm text-gray-500 dark:text-gray-300">
                                        Belum ada data transaksi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
