<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 dark:text-white leading-tight">
            ✏️ Edit Data Pembukuan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <form action="{{ route('pembukuan.update', $pembukuan->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="jenis" class="block font-medium text-gray-700">Jenis</label>
                        <select name="jenis" id="jenis" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="Pemasukan" {{ $pembukuan->jenis == 'Pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                            <option value="Pengeluaran" {{ $pembukuan->jenis == 'Pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                        </select>
                    </div>

                    <div>
                        <label for="keterangan" class="block font-medium text-gray-700">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" value="{{ $pembukuan->keterangan }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>

                    <div>
                        <label for="jumlah" class="block font-medium text-gray-700">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" value="{{ $pembukuan->jumlah }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>

                    <div>
                        <label for="tanggal" class="block font-medium text-gray-700">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" value="{{ $pembukuan->tanggal }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('pembukuan.index') }}"
                            class="inline-block bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded mr-2 transition">
                            ← Batal
                        </a>
                        <button type="submit"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded shadow transition">
                            💾 Update
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
