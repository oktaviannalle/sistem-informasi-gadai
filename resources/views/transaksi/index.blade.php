<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Transaksi Gadai</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-lg flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-lg flex items-center justify-between">
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <div class="flex justify-end mb-4">
                <a href="{{ route('transaksi.create') }}" class="bg-gray-900 text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    + Transaksi Baru
                </a>
            </div>

            <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                            <tr>
                                <th class="px-5 py-3">Barang</th>
                                <th class="px-5 py-3">Nasabah</th>
                                <th class="px-5 py-3">Pinjaman</th>
                                <th class="px-5 py-3">Denda & Bunga</th>
                                <th class="px-5 py-3">Total Tebusan</th>
                                <th class="px-5 py-3">Jatuh Tempo</th>
                                <th class="px-5 py-3">Status</th>
                                <th class="px-5 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($transaksis as $transaksi)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-5 py-4">
                                        <div class="font-medium text-gray-900">{{ $transaksi->barang->nama_barang ?? '-' }}</div>
                                        <div class="text-xs text-gray-500">{{ $transaksi->barang->kategori ?? '-' }}</div>
                                    </td>
                                    <td class="px-5 py-4">
                                        <div class="text-gray-800 font-medium">{{ $transaksi->barang->nasabah->nama ?? '-' }}</div>
                                        <div class="text-xs text-gray-400">{{ $transaksi->barang->nasabah->no_hp ?? '-' }}</div>
                                    </td>
                                    <td class="px-5 py-4 text-gray-800 font-medium">
                                        Rp {{ number_format($transaksi->jumlah_pinjaman, 0, ',', '.') }}
                                    </td>
                                    <td class="px-5 py-4 text-xs">
                                        <div class="text-gray-600">Bunga: Rp {{ number_format($transaksi->total_bunga, 0, ',', '.') }} ({{ $transaksi->bunga_persen }}%)</div>
                                        @if ($transaksi->denda > 0)
                                            <div class="text-red-600 font-semibold mt-0.5">Denda: Rp {{ number_format($transaksi->denda, 0, ',', '.') }} ({{ $transaksi->hari_terlambat }} hari)</div>
                                        @else
                                            <div class="text-gray-400">Denda: Rp 0</div>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 font-bold text-blue-900">
                                        Rp {{ number_format($transaksi->total_tebusan, 0, ',', '.') }}
                                    </td>
                                    <td class="px-5 py-4 text-xs whitespace-nowrap">
                                        <span class="font-medium text-gray-700">{{ $transaksi->tanggal_jatuh_tempo->format('d M Y') }}</span>
                                        @if ($transaksi->status === 'aktif')
                                            @if ($transaksi->hari_terlambat > 0)
                                                <span class="bg-red-100 text-red-700 font-semibold px-2 py-0.5 rounded text-[10px] block w-max mt-1">Terlambat {{ $transaksi->hari_terlambat }} hr</span>
                                            @elseif (now()->diffInDays($transaksi->tanggal_jatuh_tempo, false) <= 7)
                                                <span class="bg-amber-100 text-amber-700 font-semibold px-2 py-0.5 rounded text-[10px] block w-max mt-1">Segera Tempo</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        @php
                                            $badge = [
                                                'aktif' => 'bg-blue-100 text-blue-700',
                                                'lunas' => 'bg-green-100 text-green-700',
                                                'lelang' => 'bg-red-100 text-red-700'
                                            ];
                                        @endphp
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $badge[$transaksi->status] ?? 'bg-gray-100 text-gray-700' }}">
                                            {{ ucfirst($transaksi->status) }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-right space-x-1.5 whitespace-nowrap text-xs">
                                        <!-- Cetak Nota / SPK -->
                                        <a href="{{ route('transaksi.cetak', $transaksi) }}" target="_blank" class="inline-flex items-center bg-gray-100 hover:bg-gray-200 text-gray-700 px-2.5 py-1 rounded transition font-medium" title="Cetak Surat Bukti Gadai">
                                            🖨️ Nota
                                        </a>

                                        @if ($transaksi->status === 'aktif')
                                            <!-- Kirim WA Pengingat -->
                                            <form action="{{ route('transaksi.kirimPengingat', $transaksi) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="bg-emerald-50 hover:bg-emerald-100 text-emerald-700 px-2.5 py-1 rounded transition font-medium" title="Kirim Pesan WhatsApp">
                                                    💬 Kirim WA
                                                </button>
                                            </form>

                                            <!-- Ubah ke Lunas -->
                                            <form action="{{ route('transaksi.updateStatus', $transaksi) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="lunas">
                                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-2.5 py-1 rounded transition font-medium" onclick="return confirm('Tandai transaksi ini LUNAS?')">
                                                    Lunas
                                                </button>
                                            </form>

                                            <!-- Ubah ke Lelang -->
                                            <form action="{{ route('transaksi.updateStatus', $transaksi) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="lelang">
                                                <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 px-2.5 py-1 rounded transition font-medium" onclick="return confirm('Tandai barang gadai ini untuk DILELANG?')">
                                                    Lelang
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Hapus Transaksi -->
                                        <form action="{{ route('transaksi.destroy', $transaksi) }}" method="POST" class="inline" onsubmit="return confirm('Hapus transaksi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-600 transition px-1 py-1">
                                                🗑️
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-8 text-center text-gray-400">Belum ada transaksi gadai. Klik "+ Transaksi Baru" untuk mulai.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">{{ $transaksis->links() }}</div>
        </div>
    </div>
</x-app-layout>
