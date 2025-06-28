<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
            🦷 Lampung Dental Laboratory
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            {{-- Banner Welcome --}}
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-8 rounded-xl shadow-md flex flex-col md:flex-row justify-between items-center gap-6">
                <div>
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Lampung Dental" class="w-28 h-28 rounded-full shadow-lg border-2 border-white">
                </div>
                <div class="flex justify-center text-center my-8 px-4">
                    <div class="flex-1 max-w-3xl">
                        <h3 class="text-3xl font-bold mb-2">Selamat Datang di LAMPUNG DENTAL LABORATORY</h3>
                        <p class="text-sm leading-relaxed">
                        Sistem informasi laboratorium gigi untuk mengelola data transaksi, dokter, jenis gigi, dan laporan keuangan secara digital & efisien.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Statistik Singkat --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow text-center border-l-4 border-indigo-500">
                    <h4 class="text-sm text-gray-500 dark:text-gray-300">Jumlah Dokter</h4>
                    <p class="text-2xl font-bold text-indigo-600 mt-1">{{ \App\Models\Dokter::count() }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow text-center border-l-4 border-blue-500">
                    <h4 class="text-sm text-gray-500 dark:text-gray-300">Jenis Gigi</h4>
                    <p class="text-2xl font-bold text-blue-600 mt-1">{{ \App\Models\JenisGigi::count() }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow text-center border-l-4 border-green-500">
                    <h4 class="text-sm text-gray-500 dark:text-gray-300">Total Transaksi</h4>
                    <p class="text-2xl font-bold text-green-600 mt-1">{{ \App\Models\Transaksi::count() }}</p>
                </div>
            </div>

            {{-- Tentang Laboratorium --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-3">Tentang Lampung Dental Laboratory</h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                            Kami adalah laboratorium gigi profesional di Lampung yang melayani pembuatan gigi tiruan dengan kualitas terbaik. Berkomitmen sejak 2019 dalam memberikan produk berkualitas tinggi yang nyaman dan presisi bagi pasien.
                        </p>
                        <div class="mt-4 text-sm space-y-1 text-gray-700 dark:text-gray-300">
                            <p><strong>📍 Alamat:</strong> Jl. Family No.1, RT.01/RW.02, Hajimena, Kabupaten Lampung Selatan, 35143</p>
                            <p><strong>📞 Telepon:</strong> 0812-7189-6805</p>
                            <p><strong>📧 Email:</strong> info@lampungdental.com</p>
                            <p>
                                <strong>📷 Instagram:</strong>
                                <a href="https://www.instagram.com/lampungdental" target="_blank" class="text-blue-600 hover:underline">
                                @dental_lab_lampung
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Call to Action --}}
            <div class="bg-indigo-50 dark:bg-gray-700 p-6 rounded-lg text-center shadow-md">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">
                    Akses Modul Sistem
                </h4>
                <div class="flex flex-wrap justify-center gap-4 mt-4">
                    <a href="{{ route('dokter.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded shadow">
                        👨‍⚕️ Dokter
                    </a>
                    <a href="{{ route('jenis-gigi.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">
                        🦷 Jenis Gigi
                    </a>
                    <a href="{{ route('transaksi.index') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded shadow">
                        💳 Transaksi
                    </a>
                    <a href="{{ route('pembukuan.index') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-2 rounded shadow">
                        📊 Pembukuan
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
