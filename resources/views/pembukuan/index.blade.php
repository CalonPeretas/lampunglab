<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 dark:text-white leading-tight">
            📚 Data Pembukuan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                {{-- ✅ Alert sukses --}}
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 border border-green-400 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- 🔍 Form Filter --}}
                <form method="GET" class="flex flex-wrap md:flex-nowrap items-end gap-4 mb-6">
                    {{-- Jenis --}}
                    <div>
                        <label for="jenis" class="block text-sm font-semibold text-gray-700">Jenis</label>
                        <select name="jenis" id="jenis" class="border border-gray-300 rounded-md px-3 py-2 w-44 text-sm shadow-sm focus:ring-2 focus:ring-blue-400">
                            <option value="">-- Semua --</option>
                            <option value="Pemasukan" {{ request('jenis') == 'Pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                            <option value="Pengeluaran" {{ request('jenis') == 'Pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                        </select>
                    </div>

                    {{-- Tanggal Awal --}}
                    <div>
                        <label for="tanggal_awal" class="block text-sm font-semibold text-gray-700">Tanggal Awal</label>
                        <input type="date" name="tanggal_awal" id="tanggal_awal" value="{{ request('tanggal_awal') }}"
                            class="border border-gray-300 rounded-md px-3 py-2 w-44 text-sm shadow-sm focus:ring-2 focus:ring-blue-400">
                    </div>

                    {{-- Tanggal Akhir --}}
                    <div>
                        <label for="tanggal_akhir" class="block text-sm font-semibold text-gray-700">Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" id="tanggal_akhir" value="{{ request('tanggal_akhir') }}"
                            class="border border-gray-300 rounded-md px-3 py-2 w-44 text-sm shadow-sm focus:ring-2 focus:ring-blue-400">
                    </div>

                    {{-- Tombol --}}
                    <div class="flex gap-2 pt-5">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
                            🔍 Filter
                        </button>

                        @if(request()->filled('jenis') || request()->filled('tanggal_awal') || request()->filled('tanggal_akhir'))
                            <a href="{{ route('pembukuan.index') }}"
                                class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded shadow">
                                🔁 Reset
                            </a>
                            <a href="{{ route('pembukuan.print', request()->all()) }}" target="_blank"
                                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow">
                                🖨️ Print Filter
                            </a>
                        @endif
                    </div>
                </form>

                {{-- ➕ Tambah --}}
                <div class="mb-4 text-right">
                    <a href="{{ route('pembukuan.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow text-sm transition">
                        ✚ Tambah Data
                    </a>
                </div>

                {{-- 📊 Tabel --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full border text-sm text-gray-900">
                        <thead class="bg-blue-600 text-white">
                            <tr>
                                <th class="border px-4 py-3">No</th>
                                <th class="border px-4 py-3">Jenis</th>
                                <th class="border px-4 py-3">Keterangan</th>
                                <th class="border px-4 py-3">Jumlah</th>
                                <th class="border px-4 py-3">Tanggal</th>
                                <th class="border px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse ($pembukuans as $index => $item)
                                <tr class="hover:bg-gray-100">
                                    <td class="border px-4 py-2 text-center">{{ $index + 1 }}</td>
                                    <td class="border px-4 py-2 text-center">
                                        <span class="px-2 py-1 rounded-full text-sm font-semibold {{ $item->jenis === 'Pemasukan' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                            {{ $item->jenis }}
                                        </span>
                                    </td>
                                    <td class="border px-4 py-2">{{ $item->keterangan }}</td>
                                    <td class="border px-4 py-2 text-right font-semibold">Rp{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                    <td class="border px-4 py-2 text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                    <td class="border px-4 py-2 text-center space-x-1">
                                        <a href="{{ route('pembukuan.edit', $item->id) }}"
                                            class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold text-sm py-1 px-3 rounded shadow-md transition">
                                            ✏️ Edit
                                        </a>
                                        <form action="{{ route('pembukuan.destroy', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Yakin ingin menghapus data ini?')"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-gray-500 font-semibold">Tidak ada data pembukuan ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
