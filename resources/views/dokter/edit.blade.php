<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Dokter
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

                <form action="{{ route('dokter.update', $dokter->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="nama" class="block font-medium text-sm text-gray-700 dark:text-gray-200">Nama Dokter</label>
                        <input type="text" name="nama" id="nama" value="{{ $dokter->nama }}" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white" required>
                    </div>

                    <div>
                        <label for="nama_klinik" class="block font-medium text-sm text-gray-700 dark:text-gray-200">Nama Klinik</label>
                        <input type="text" name="nama_klinik" id="nama_klinik" value="{{ $dokter->nama_klinik }}" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white">
                    </div>

                    <div>
                        <label for="alamat" class="block font-medium text-sm text-gray-700 dark:text-gray-200">Alamat</label>
                        <input type="text" name="alamat" id="alamat" value="{{ $dokter->alamat }}" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white">
                    </div>

                    <div>
                        <label for="no_hp" class="block font-medium text-sm text-gray-700 dark:text-gray-200">No HP</label>
                        <input type="text" name="no_hp" id="no_hp" value="{{ $dokter->no_hp }}" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white">
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('dokter.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-md shadow-sm transition">
                            Kembali
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-md shadow-sm transition">
                            Update
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
