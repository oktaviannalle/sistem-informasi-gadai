<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 tracking-tight">Manajemen Transaksi Gadai</h2>
                <p class="text-xs text-slate-500 mt-1">Pencatatan pinjaman, kalkulasi denda, pelunasan, dan cetak SPK/Nota Bukti Gadai</p>
            </div>
            <div>
                <a href="{{ route('transaksi.create') }}" class="bg-gradient-to-r from-blue-700 to-cyan-600 text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow hover:shadow-md transition inline-flex items-center gap-1.5">
                    <span>+ Transaksi Gadai Baru</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-medium px-4 py-3 rounded-xl flex items-center justify-between shadow-sm">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-5 bg-rose-50 border border-rose-200 text-rose-700 text-xs font-medium px-4 py-3 rounded-xl flex items-center justify-between shadow-sm">
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-xs text-left">
                        <thead class="bg-slate-50 text-slate-400 font-bold uppercase text-[10px] tracking-wider border-b border-slate-100">
                            <tr>
                                <th class="px-5 py-4">Barang Jaminan</th>
                                <th class="px-5 py-4">Nasabah</th>
                                <th class="px-5 py-4">Pinjaman Pokok</th>
                                <th class="px-5 py-4">Bunga & Denda</th>
                                <th class="px-5 py-4">Total Pelunasan</th>
                                <th class="px-5 py-4">Jatuh Tempo</th>
                                <th class="px-5 py-4">Status</th>
                                <th class="px-5 py-4 text-right">Aksi Operasional</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($transaksis as $transaksi)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-5 py-4">
                                        <div class="font-extrabold text-slate-900">{{ $transaksi->barang->nama_barang ?? '-' }}</div>
                                        <span class="inline-block bg-slate-100 text-slate-600 text-[10px] font-semibold px-2 py-0.5 rounded mt-0.5">
                                            {{ $transaksi->barang->kategori ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4">
                                        <div class="text-slate-900 font-bold">{{ $transaksi->barang->nasabah->nama ?? '-' }}</div>
                                        <div class="text-[11px] text-slate-400 font-mono">{{ $transaksi->barang->nasabah->no_hp ?? '-' }}</div>
                                    </td>
                                    <td class="px-5 py-4 text-slate-900 font-bold font-mono">
                                        Rp {{ number_format($transaksi->jumlah_pinjaman, 0, ',', '.') }}
                                    </td>
                                    <td class="px-5 py-4 text-[11px]">
                                        <div class="text-slate-600 font-medium">Bunga: Rp {{ number_format($transaksi->total_bunga, 0, ',', '.') }} ({{ $transaksi->bunga_persen }}%)</div>
                                        @if ($transaksi->denda > 0)
                                            <div class="text-rose-600 font-extrabold mt-0.5">Denda: Rp {{ number_format($transaksi->denda, 0, ',', '.') }} ({{ $transaksi->hari_terlambat }} hr)</div>
                                        @else
                                            <div class="text-slate-400">Denda: Rp 0</div>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 font-extrabold text-blue-900 text-sm font-mono">
                                        Rp {{ number_format($transaksi->total_tebusan, 0, ',', '.') }}
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap text-xs">
                                        <div class="font-black text-slate-900 font-mono whitespace-nowrap">📅 {{ $transaksi->tanggal_jatuh_tempo->format('d M Y') }}</div>
                                        @if ($transaksi->status === 'aktif')
                                            @if ($transaksi->hari_terlambat > 0)
                                                <span class="bg-rose-100 text-rose-800 font-black px-2 py-0.5 rounded-md text-[10px] block w-max mt-1 whitespace-nowrap border border-rose-300">Terlambat {{ $transaksi->hari_terlambat }} hr</span>
                                            @elseif (now()->diffInDays($transaksi->tanggal_jatuh_tempo, false) <= 7)
                                                <span class="bg-amber-100 text-amber-900 font-black px-2 py-0.5 rounded-md text-[10px] block w-max mt-1 whitespace-nowrap border border-amber-300">Segera Tempo</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        @php
                                            $badge = [
                                                'aktif' => 'bg-blue-100 text-blue-800 border border-blue-200/60',
                                                'lunas' => 'bg-emerald-100 text-emerald-800 border border-emerald-200/60',
                                                'lelang' => 'bg-rose-100 text-rose-800 border border-rose-200/60'
                                            ];
                                        @endphp
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase {{ $badge[$transaksi->status] ?? 'bg-slate-100 text-slate-700' }}">
                                            {{ $transaksi->status }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-right space-x-1.5 whitespace-nowrap text-xs">
                                        <!-- Cetak Nota / SPK -->
                                        <a href="{{ route('transaksi.cetak', $transaksi) }}" target="_blank" class="inline-flex items-center bg-slate-100 hover:bg-slate-200 text-slate-700 px-2.5 py-1.5 rounded-xl transition font-bold" title="Cetak Surat Bukti Gadai">
                                            🖨️ Nota
                                        </a>

                                        @if ($transaksi->status === 'aktif')
                                            <!-- Kirim WA Pengingat -->
                                            <form action="{{ route('transaksi.kirimPengingat', $transaksi) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200/60 px-2.5 py-1.5 rounded-xl transition font-bold" title="Kirim Pesan WhatsApp">
                                                    💬 Kirim WA
                                                </button>
                                            </form>

                                            <!-- Ubah ke Lunas -->
                                            <form action="{{ route('transaksi.updateStatus', $transaksi) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="lunas">
                                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-2.5 py-1.5 rounded-xl transition font-bold shadow-sm" onclick="return confirm('Tandai transaksi ini LUNAS?')">
                                                    Lunas
                                                </button>
                                            </form>

                                            <!-- Ubah ke Lelang -->
                                            <form action="{{ route('transaksi.updateStatus', $transaksi) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="lelang">
                                                <button type="submit" class="bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200/60 px-2.5 py-1.5 rounded-xl transition font-bold" onclick="return confirm('Tandai barang gadai ini untuk DILELANG?')">
                                                    Lelang
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Hapus Transaksi -->
                                        <form action="{{ route('transaksi.destroy', $transaksi) }}" method="POST" class="inline" onsubmit="return confirm('Hapus transaksi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-slate-400 hover:text-rose-600 transition px-1.5 py-1">
                                                🗑️
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-12 text-center text-slate-400">
                                        <span class="text-3xl block mb-2">💳</span>
                                        Belum ada transaksi gadai. Klik <strong>"+ Transaksi Gadai Baru"</strong> untuk memproses pinjaman.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-5">{{ $transaksis->links() }}</div>
        </div>
    </div>
</x-app-layout>
