<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Edit Transaksi
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Dokter --}}
                    <div class="mb-4">
                        <label for="dokter_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Dokter</label>
                        <select name="dokter_id" id="dokter_id" class="w-full mt-1 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @foreach ($dokters as $dokter)
                                <option value="{{ $dokter->id }}" {{ $transaksi->dokter_id == $dokter->id ? 'selected' : '' }}>{{ $dokter->nama }}</option>
                            @endforeach
                        </select>
                        @error('dokter_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    {{-- Jenis Gigi --}}
                    <div class="mb-4">
                        <label for="jenis_gigi_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Gigi</label>
                        <select name="jenis_gigi_id" id="jenis_gigi_id" class="w-full mt-1 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @foreach ($jenisGigis as $gigi)
                                <option value="{{ $gigi->id }}" {{ $transaksi->jenis_gigi_id == $gigi->id ? 'selected' : '' }}>{{ $gigi->nama }}</option>
                            @endforeach
                        </select>
                        @error('jenis_gigi_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    {{-- Jumlah --}}
                    <div class="mb-4">
                        <label for="jumlah" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" min="1" value="{{ $transaksi->jumlah }}"
                               class="w-full mt-1 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        @error('jumlah') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    {{-- Ongkir --}}
                    <div class="mb-4">
                        <label for="ongkir" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ongkir (Rp)</label>
                        <input type="number" name="ongkir" id="ongkir" min="0"
                               value="{{ old('ongkir', $transaksi->ongkir ?? 0) }}"
                               class="w-full mt-1 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        @error('ongkir') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    {{-- Status Pembayaran --}}
                    <div class="mb-4">
                        <label for="status_pembayaran" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status Pembayaran</label>
                        <select name="status_pembayaran" id="status_pembayaran"
                                class="w-full mt-1 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            <option value="Lunas" {{ $transaksi->status_pembayaran === 'Lunas' ? 'selected' : '' }}>Lunas</option>
                            <option value="Belum Lunas" {{ $transaksi->status_pembayaran === 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                        </select>
                        @error('status_pembayaran') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    {{-- Tanggal Selesai --}}
                    <div class="mb-4">
                        <label for="tgl_selesai" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Selesai</label>
                        <input type="date" name="tgl_selesai" id="tgl_selesai"
                               value="{{ $transaksi->tgl_selesai ? date('Y-m-d', strtotime($transaksi->tgl_selesai)) : '' }}"
                               class="w-full mt-1 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        @error('tgl_selesai') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('transaksi.index') }}" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md mr-2">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
