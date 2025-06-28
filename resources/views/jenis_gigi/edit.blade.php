<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Jenis Gigi
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-8 shadow rounded-xl space-y-6">
                <form action="{{ route('jenis-gigi.update', $jenisGigi->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="nama" class="block font-medium text-sm text-gray-700 dark:text-gray-200">Nama Jenis Gigi</label>
                        <input type="text" name="nama" id="nama" value="{{ $jenisGigi->nama }}" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white" required>
                    </div>

                    <div>
                        <label for="harga" class="block font-medium text-sm text-gray-700 dark:text-gray-200">Harga</label>
                        <input type="number" name="harga" id="harga" value="{{ $jenisGigi->harga }}" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white" required>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('jenis-gigi.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow">
                            Kembali
                        </a>
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded shadow">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
