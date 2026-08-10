<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Kartu statistik --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white shadow-sm sm:rounded-lg p-5">
                    <p class="text-sm text-gray-500">Total Nasabah</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalNasabah }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-5">
                    <p class="text-sm text-gray-500">Total Barang Gadai</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalBarang }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-5">
                    <p class="text-sm text-gray-500">Transaksi Aktif</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $transaksiAktif }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-5">
                    <p class="text-sm text-gray-500">Total Pinjaman Aktif</p>
                    <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($totalPinjamanAktif, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-5">
                    <p class="text-sm text-gray-500">Jatuh Tempo (7 hari)</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ $jatuhTempoMendekat->count() }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-5">
                    <p class="text-sm text-gray-500">Lewat Jatuh Tempo</p>
                    <p class="text-2xl font-bold text-red-600">{{ $transaksiOverdue }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-5">
                    <p class="text-sm text-gray-500">Transaksi Lunas</p>
                    <p class="text-2xl font-bold text-green-600">{{ $transaksiLunas }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-5">
                    <p class="text-sm text-gray-500">Total Bunga Terkumpul</p>
                    <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($totalBungaTerkumpul, 0, ',', '.') }}</p>
                </div>
            </div>

            {{-- Tabel jatuh tempo mendekat --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-gray-800 mb-4">Jatuh Tempo Minggu Ini</h3>
                @if($jatuhTempoMendekat->isEmpty())
                    <p class="text-sm text-gray-500">Nggak ada barang yang jatuh tempo dalam 7 hari ke depan.</p>
                @else
                    <table class="w-full text-sm text-left">
                        <thead class="text-gray-500 border-b">
                            <tr>
                                <th class="py-2">Nasabah</th>
                                <th class="py-2">Barang</th>
                                <th class="py-2">Jatuh Tempo</th>
                                <th class="py-2">Pinjaman</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jatuhTempoMendekat as $t)
                                <tr class="border-b last:border-0">
                                    <td class="py-2">{{ $t->barang->nasabah->nama }}</td>
                                    <td class="py-2">{{ $t->barang->nama_barang }}</td>
                                    <td class="py-2">{{ $t->tanggal_jatuh_tempo->format('d M Y') }}</td>
                                    <td class="py-2">Rp {{ number_format($t->jumlah_pinjaman, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            {{-- Tabel transaksi terbaru --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-gray-800 mb-4">Transaksi Terbaru</h3>
                <table class="w-full text-sm text-left">
                    <thead class="text-gray-500 border-b">
                        <tr>
                            <th class="py-2">Nasabah</th>
                            <th class="py-2">Barang</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Tanggal Gadai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksiTerbaru as $t)
                            <tr class="border-b last:border-0">
                                <td class="py-2">{{ $t->barang->nasabah->nama }}</td>
                                <td class="py-2">{{ $t->barang->nama_barang }}</td>
                                <td class="py-2 capitalize">{{ $t->status }}</td>
                                <td class="py-2">{{ $t->tanggal_gadai->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
