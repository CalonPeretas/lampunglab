<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 dark:text-white leading-tight">
            ➕ Tambah Data Pembukuan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <form action="{{ route('pembukuan.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="jenis" class="block font-medium text-gray-700">Jenis</label>
                        <select name="jenis" id="jenis" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Pemasukan">Pemasukan</option>
                            <option value="Pengeluaran">Pengeluaran</option>
                        </select>
                    </div>

                    <div>
                        <label for="keterangan" class="block font-medium text-gray-700">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>

                    <div>
                        <label for="jumlah" class="block font-medium text-gray-700">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>

                    <div>
                        <label for="tanggal" class="block font-medium text-gray-700">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('pembukuan.index') }}"
                            class="inline-block bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded mr-2 transition">
                            ← Kembali
                        </a>
                            <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow transition">
                            💾 Simpan
                            </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
