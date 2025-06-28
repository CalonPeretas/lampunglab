<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Jenis Gigi
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-8 shadow rounded-xl space-y-6">

                {{-- Pesan Error --}}
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('jenis-gigi.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama</label>
                        <input type="text" name="nama" id="nama" required
                               class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white">
                    </div>

                    <div>
                        <label for="harga" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Harga</label>
                        <input type="number" name="harga" id="harga" required
                               class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white">
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('jenis-gigi.index') }}"
                           class="inline-block px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-md shadow transition">
                            Kembali
                        </a>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md shadow transition">
                            Simpan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
