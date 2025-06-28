<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Dokter
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-8 shadow rounded-xl space-y-6">

                {{-- Tampilkan error validasi --}}
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('dokter.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="nama" class="block font-medium text-sm text-gray-700 dark:text-gray-200">Nama Dokter</label>
                        <input type="text" name="nama" id="nama" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white" required>
                    </div>

                    <div>
                        <label for="nama_klinik" class="block font-medium text-sm text-gray-700 dark:text-gray-200">Nama Klinik</label>
                        <input type="text" name="nama_klinik" id="nama_klinik" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white">
                    </div>

                    <div>
                        <label for="alamat" class="block font-medium text-sm text-gray-700 dark:text-gray-200">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white">
                    </div>

                    <div>
                        <label for="no_hp" class="block font-medium text-sm text-gray-700 dark:text-gray-200">No HP</label>
                        <input type="text" name="no_hp" id="no_hp" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white">
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('dokter.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-md shadow-sm transition">
                            Kembali
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md shadow-sm transition">
                            Simpan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
