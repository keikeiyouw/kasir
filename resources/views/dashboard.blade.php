<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- STAT CARDS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Total Penjualan --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 flex items-center gap-4">
                    <div class="bg-orange-100 dark:bg-orange-900 text-orange-500 rounded-lg p-3 text-xl">
                        🧾
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalPenjualan }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Total Penjualan</div>
                    </div>
                </div>

                {{-- Total Pendapatan --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 flex items-center gap-4">
                    <div class="bg-green-100 dark:bg-green-900 text-green-500 rounded-lg p-3 text-xl">
                        💰
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-800 dark:text-white">
                            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Total Pendapatan</div>
                    </div>
                </div>

                {{-- Total Pelanggan --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 flex items-center gap-4">
                    <div class="bg-blue-100 dark:bg-blue-900 text-blue-500 rounded-lg p-3 text-xl">
                        👥
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalPelanggan }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Total Pelanggan</div>
                    </div>
                </div>

                {{-- Total Produk --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 flex items-center gap-4">
                    <div class="bg-purple-100 dark:bg-purple-900 text-purple-500 rounded-lg p-3 text-xl">
                        📦
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalProduk }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Total Produk</div>
                    </div>
                </div>

            </div>

            {{-- TABEL BAWAH --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Penjualan Terbaru --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow">
                    <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <h3 class="font-semibold text-gray-800 dark:text-white">Penjualan Terbaru</h3>
                        <a href="{{ route('penjualan.index') }}"
                        class="text-sm text-indigo-500 hover:underline">Lihat Semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700">
                                    <th class="px-5 py-3 font-medium">Pelanggan</th>
                                    <th class="px-5 py-3 font-medium">Tanggal</th>
                                    <th class="px-5 py-3 font-medium">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($penjualanTerbaru as $p)
                                <tr class="border-b border-gray-50 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-5 py-3 font-medium text-gray-800 dark:text-white">
                                        {{ $p->pelanggan->NamaPelanggan ?? '-' }}
                                    </td>
                                    <td class="px-5 py-3 text-gray-500 dark:text-gray-400">
                                        {{ \Carbon\Carbon::parse($p->TanggalPenjualan)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-5 py-3 font-semibold text-green-600 dark:text-green-400">
                                        Rp {{ number_format($p->TotalHarga, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-5 py-8 text-center text-gray-400">
                                        Belum ada data penjualan
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Produk Stok Rendah --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow">
                    <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <h3 class="font-semibold text-gray-800 dark:text-white">Stok Produk Rendah</h3>
                        <a href="{{ route('produk.index') }}"
                        class="text-sm text-indigo-500 hover:underline">Lihat Semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700">
                                    <th class="px-5 py-3 font-medium">Produk</th>
                                    <th class="px-5 py-3 font-medium">Harga</th>
                                    <th class="px-5 py-3 font-medium">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($produkStokRendah as $p)
                                <tr class="border-b border-gray-50 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-5 py-3 font-medium text-gray-800 dark:text-white">
                                        {{ $p->NamaProduk }}
                                    </td>
                                    <td class="px-5 py-3 text-gray-500 dark:text-gray-400">
                                        Rp {{ number_format($p->Harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-5 py-3">
                                        @if($p->Stok <= 5)
                                            <span class="bg-red-100 text-red-600 dark:bg-red-900 dark:text-red-300 text-xs font-semibold px-2 py-1 rounded-full">
                                                {{ $p->Stok }}
                                            </span>
                                        @else
                                            <span class="bg-orange-100 text-orange-600 dark:bg-orange-900 dark:text-orange-300 text-xs font-semibold px-2 py-1 rounded-full">
                                                {{ $p->Stok }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-5 py-8 text-center text-gray-400">
                                        Semua stok aman 👍
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
