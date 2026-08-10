<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-black text-2xl text-slate-900 tracking-tight">
                    Executive Dashboard Overview
                </h2>
                <p class="text-xs font-bold text-slate-600 mt-1">Selamat datang, <span class="text-blue-700 font-black">{{ Auth::user()->name }}</span>! Berikut ringkasan statistik operasional Gadai Startech hari ini.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('nasabah.create') }}" class="bg-white border-2 border-slate-300 text-slate-800 text-xs font-black px-4 py-2.5 rounded-xl shadow-sm hover:bg-slate-50 hover:border-slate-400 transition">
                    + Nasabah Baru
                </a>
                <a href="{{ route('transaksi.create') }}" class="bg-blue-700 hover:bg-blue-800 text-white text-xs font-black px-4 py-2.5 rounded-xl shadow-md transition">
                    + Transaksi Gadai
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Hero Welcome Card (Pusat Gadai Indonesia Royal Blue Theme) -->
            <div class="bg-gradient-to-r from-blue-950 via-blue-900 to-blue-700 text-white rounded-3xl p-6 sm:p-8 shadow-xl border-2 border-blue-600 relative overflow-hidden">
                <div class="absolute right-0 top-0 bottom-0 opacity-20 pointer-events-none transform translate-x-8">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo Background" class="h-72 w-72 object-contain">
                </div>
                <div class="relative z-10 max-w-3xl">
                    <div class="inline-flex items-center gap-2 bg-blue-500/30 border border-cyan-400/40 text-cyan-300 text-xs font-black px-3.5 py-1.5 rounded-full mb-3 shadow-inner">
                        ⚡ SISTEM-GADAI MAHENSWA v2.0
                    </div>
                    <h1 class="text-2xl sm:text-4xl font-black tracking-tight mb-3 text-white leading-tight">
                        Pusat Kendali Operasional Gadai Startech
                    </h1>
                    <p class="text-blue-100 text-xs sm:text-sm font-semibold leading-relaxed mb-6">
                        Kelola data nasabah, taksiran barang jaminan, transaksi aktif, tanggal jatuh tempo, denda harian, dan cetak Surat Perjanjian Kredit (SPK) dalam satu dashboard terintegrasi.
                    </p>
                    <div class="flex flex-wrap gap-3 text-xs font-black">
                        <div class="bg-blue-950/80 px-4 py-2.5 rounded-xl border border-blue-400/30 flex items-center gap-2 text-cyan-300">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>Status Server: Aktif Normal</span>
                        </div>
                        <div class="bg-blue-950/80 px-4 py-2.5 rounded-xl border border-blue-400/30 text-white">
                            📅 {{ now()->format('l, d F Y') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kartu Statistik (High Contrast Royal Blue Theme) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                
                <div class="bg-white rounded-2xl p-5 border-2 border-slate-200 shadow-md hover:border-blue-600 transition">
                    <div class="flex justify-between items-start mb-2">
                        <p class="text-xs font-black text-slate-700 uppercase tracking-wider">Total Nasabah</p>
                        <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-800 flex items-center justify-center text-xl font-bold">👥</div>
                    </div>
                    <p class="text-3xl font-black text-slate-900">{{ $totalNasabah }}</p>
                    <p class="text-xs font-bold text-slate-500 mt-1">Nasabah terdaftar aktif</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border-2 border-slate-200 shadow-md hover:border-blue-600 transition">
                    <div class="flex justify-between items-start mb-2">
                        <p class="text-xs font-black text-slate-700 uppercase tracking-wider">Barang Jaminan</p>
                        <div class="w-10 h-10 rounded-xl bg-cyan-100 text-cyan-800 flex items-center justify-center text-xl font-bold">📦</div>
                    </div>
                    <p class="text-3xl font-black text-slate-900">{{ $totalBarang }}</p>
                    <p class="text-xs font-bold text-slate-500 mt-1">Item dalam inventaris</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border-2 border-slate-200 shadow-md hover:border-blue-600 transition">
                    <div class="flex justify-between items-start mb-2">
                        <p class="text-xs font-black text-slate-700 uppercase tracking-wider">Transaksi Aktif</p>
                        <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-900 flex items-center justify-center text-xl font-bold">💳</div>
                    </div>
                    <p class="text-3xl font-black text-blue-700">{{ $transaksiAktif }}</p>
                    <p class="text-xs font-bold text-slate-500 mt-1">Gadai berjalan</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border-2 border-slate-200 shadow-md hover:border-blue-600 transition">
                    <div class="flex justify-between items-start mb-2">
                        <p class="text-xs font-black text-slate-700 uppercase tracking-wider">Total Pinjaman Aktif</p>
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center text-xl font-bold">💰</div>
                    </div>
                    <p class="text-2xl font-black text-emerald-700 font-mono">Rp {{ number_format($totalPinjamanAktif, 0, ',', '.') }}</p>
                    <p class="text-xs font-bold text-slate-500 mt-1">Plafon tersalurkan</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border-2 border-slate-200 shadow-md hover:border-amber-500 transition">
                    <div class="flex justify-between items-start mb-2">
                        <p class="text-xs font-black text-slate-700 uppercase tracking-wider">Segera Tempo (7 hari)</p>
                        <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center text-xl font-bold">⏳</div>
                    </div>
                    <p class="text-3xl font-black text-amber-600">{{ $jatuhTempoMendekat->count() }}</p>
                    <p class="text-xs font-bold text-slate-500 mt-1">Perlu pengingat WA</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border-2 border-slate-200 shadow-md hover:border-rose-500 transition">
                    <div class="flex justify-between items-start mb-2">
                        <p class="text-xs font-black text-slate-700 uppercase tracking-wider">Terlambat / Overdue</p>
                        <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-800 flex items-center justify-center text-xl font-bold">⚠️</div>
                    </div>
                    <p class="text-3xl font-black text-rose-600">{{ $transaksiOverdue }}</p>
                    <p class="text-xs font-bold text-slate-500 mt-1">Dikenakan denda harian</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border-2 border-slate-200 shadow-md hover:border-emerald-500 transition">
                    <div class="flex justify-between items-start mb-2">
                        <p class="text-xs font-black text-slate-700 uppercase tracking-wider">Transaksi Lunas</p>
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center text-xl font-bold">✅</div>
                    </div>
                    <p class="text-3xl font-black text-emerald-600">{{ $transaksiLunas }}</p>
                    <p class="text-xs font-bold text-slate-500 mt-1">Telah ditebus nasabah</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border-2 border-slate-200 shadow-md hover:border-blue-600 transition">
                    <div class="flex justify-between items-start mb-2">
                        <p class="text-xs font-black text-slate-700 uppercase tracking-wider">Total Bunga Terkumpul</p>
                        <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-900 flex items-center justify-center text-xl font-bold">📈</div>
                    </div>
                    <p class="text-2xl font-black text-blue-900 font-mono">Rp {{ number_format($totalBungaTerkumpul, 0, ',', '.') }}</p>
                    <p class="text-xs font-bold text-slate-500 mt-1">Pendapatan bunga</p>
                </div>

            </div>

            <!-- Main Content Tables Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Tabel Jatuh Tempo Minggu Ini -->
                <div class="bg-white rounded-2xl border-2 border-slate-200 shadow-md overflow-hidden">
                    <div class="bg-slate-900 p-5 text-white flex justify-between items-center border-b-2 border-blue-600">
                        <div>
                            <h3 class="font-black text-white text-base uppercase tracking-tight">Jatuh Tempo Minggu Ini</h3>
                            <p class="text-xs text-slate-300 font-semibold">Daftar transaksi yang perlu pengingat H-7 jatuh tempo</p>
                        </div>
                        <span class="bg-amber-500 text-slate-950 text-xs font-black px-3 py-1 rounded-full">
                            {{ $jatuhTempoMendekat->count() }} Transaksi
                        </span>
                    </div>

                    <div class="p-5">
                        @if($jatuhTempoMendekat->isEmpty())
                            <div class="text-center py-8 text-slate-500 text-xs font-bold">
                                <span class="text-3xl block mb-2">🎉</span>
                                Tidak ada transaksi gadai yang mendekati jatuh tempo 7 hari ke depan.
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-xs text-left">
                                    <thead class="text-slate-700 bg-slate-100 uppercase text-[10px] font-black tracking-wider border-b-2 border-slate-200">
                                        <tr>
                                            <th class="py-3 px-3">Nasabah</th>
                                            <th class="py-3 px-3">Barang</th>
                                            <th class="py-3 px-3">Jatuh Tempo</th>
                                            <th class="py-3 px-3 text-right">Pinjaman</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200">
                                        @foreach($jatuhTempoMendekat as $t)
                                            <tr class="hover:bg-slate-50 transition">
                                                <td class="py-3.5 px-4 font-bold text-slate-900">
                                                    <div class="font-black text-slate-900">{{ $t->barang->nasabah->nama ?? '-' }}</div>
                                                    <div class="text-[11px] font-bold text-slate-600 font-mono">{{ $t->barang->nasabah->no_hp ?? '-' }}</div>
                                                </td>
                                                <td class="py-3.5 px-4 text-slate-900 font-bold">{{ $t->barang->nama_barang ?? '-' }}</td>
                                                <td class="py-3.5 px-4 whitespace-nowrap">
                                                    <span class="inline-block whitespace-nowrap px-3 py-1 rounded-lg border-2 border-amber-300 font-black text-amber-900 bg-amber-50 font-mono text-xs shadow-sm">
                                                        📅 {{ $t->tanggal_jatuh_tempo->format('d M Y') }}
                                                    </span>
                                                </td>
                                                <td class="py-3.5 px-4 text-right font-black text-slate-900 font-mono whitespace-nowrap">
                                                    Rp {{ number_format($t->jumlah_pinjaman, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Tabel Transaksi Terbaru -->
                <div class="bg-white rounded-2xl border-2 border-slate-200 shadow-md overflow-hidden">
                    <div class="bg-slate-900 p-5 text-white flex justify-between items-center border-b-2 border-blue-600">
                        <div>
                            <h3 class="font-black text-white text-base uppercase tracking-tight">Transaksi Terbaru</h3>
                            <p class="text-xs text-slate-300 font-semibold">Aktivitas pencatatan gadai terkini di sistem</p>
                        </div>
                        <a href="{{ route('transaksi.index') }}" class="text-xs font-black text-cyan-300 hover:text-white hover:underline">
                            Lihat Semua &rarr;
                        </a>
                    </div>

                    <div class="p-5 overflow-x-auto">
                        <table class="w-full text-xs text-left">
                            <thead class="text-slate-700 bg-slate-100 uppercase text-[10px] font-black tracking-wider border-b-2 border-slate-200">
                                <tr>
                                    <th class="py-3 px-3">Nasabah</th>
                                    <th class="py-3 px-3">Barang</th>
                                    <th class="py-3 px-3">Status</th>
                                    <th class="py-3 px-3 text-right">Tanggal Gadai</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @foreach($transaksiTerbaru as $t)
                                    <tr class="hover:bg-slate-50 transition">
                                        <td class="py-3.5 px-3 font-black text-slate-900">{{ $t->barang->nasabah->nama ?? '-' }}</td>
                                        <td class="py-3.5 px-3 text-slate-900 font-bold">{{ $t->barang->nama_barang ?? '-' }}</td>
                                        <td class="py-3.5 px-3">
                                            @php
                                                $badge = [
                                                    'aktif' => 'bg-blue-100 text-blue-900 border border-blue-300',
                                                    'lunas' => 'bg-emerald-100 text-emerald-900 border border-emerald-300',
                                                    'lelang' => 'bg-rose-100 text-rose-900 border border-rose-300'
                                                ];
                                            @endphp
                                            <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase {{ $badge[$t->status] ?? 'bg-slate-100 text-slate-800' }}">
                                                {{ $t->status }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-3 text-right text-slate-900 font-mono font-black whitespace-nowrap">{{ $t->tanggal_gadai->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
