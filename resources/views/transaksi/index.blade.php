<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Transaksi Gadai</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-700 text-sm px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-end mb-4">
                <a href="{{ route('transaksi.create') }}" class="bg-gray-900 text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    + Transaksi Baru
                </a>
            </div>

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                            <tr>
                                <th class="px-6 py-3">Barang</th>
                                <th class="px-6 py-3">Nasabah</th>
                                <th class="px-6 py-3">Pinjaman</th>
                                <th class="px-6 py-3">Bunga</th>
                                <th class="px-6 py-3">Jatuh Tempo</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transaksis as $transaksi)
                                <tr class="border-t border-gray-100">
                                    <td class="px-6 py-3 font-medium text-gray-800">{{ $transaksi->barang->nama_barang ?? '-' }}</td>
                                    <td class="px-6 py-3 text-gray-600">{{ $transaksi->barang->nasabah->nama ?? '-' }}</td>
                                    <td class="px-6 py-3 text-gray-600">Rp {{ number_format($transaksi->jumlah_pinjaman, 0, ',', '.') }}</td>
                                    <td class="px-6 py-3 text-gray-600">{{ $transaksi->bunga_persen }}%/bln</td>
                                    <td class="px-6 py-3 text-gray-600">
                                        {{ $transaksi->tanggal_jatuh_tempo->format('d M Y') }}
                                        @if ($transaksi->status === 'aktif' && now()->diffInDays($transaksi->tanggal_jatuh_tempo, false) <= 7)
                                            <span class="text-amber-600 text-xs block">segera jatuh tempo</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-3">
                                        @php
                                            $badge = ['aktif' => 'bg-blue-100 text-blue-700', 'lunas' => 'bg-green-100 text-green-700', 'lelang' => 'bg-red-100 text-red-700'];
                                        @endphp
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $badge[$transaksi->status] }}">{{ ucfirst($transaksi->status) }}</span>
                                    </td>
                                    <td class="px-6 py-3 text-right space-x-2 whitespace-nowrap">
                                        @if ($transaksi->status === 'aktif')
                                            <form action="{{ route('transaksi.updateStatus', $transaksi) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="lunas">
                                                <button type="submit" class="text-green-600 hover:underline text-xs" onclick="return confirm('Tandai transaksi ini lunas?')">Lunas</button>
                                            </form>
                                            <form action="{{ route('transaksi.updateStatus', $transaksi) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="lelang">
                                                <button type="submit" class="text-red-600 hover:underline text-xs" onclick="return confirm('Tandai transaksi ini lelang?')">Lelang</button>
                                            </form>
                                        @endif
                                        <form action="{{ route('transaksi.destroy', $transaksi) }}" method="POST" class="inline" onsubmit="return confirm('Hapus transaksi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-500 hover:underline text-xs">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-gray-400">Belum ada transaksi gadai. Klik "Transaksi Baru" untuk mulai.</td>
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
