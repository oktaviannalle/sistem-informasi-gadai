<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 tracking-tight">Proses Transaksi Gadai Baru</h2>
                <p class="text-xs text-slate-500 mt-1">Pilih barang jaminan, atur jumlah pinjaman, persen bunga, dan tenor tenor pelunasan</p>
            </div>
            <a href="{{ route('transaksi.index') }}" class="text-xs font-bold text-slate-600 hover:text-slate-900 bg-white border border-slate-200 px-3.5 py-2 rounded-xl shadow-sm hover:bg-slate-50 transition">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('transaksi.store') }}" method="POST" class="bg-white shadow-sm rounded-2xl p-6 sm:p-8 space-y-5 border border-slate-200/80">
                @csrf

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Pilih Barang Jaminan</label>
                    <select name="barang_gadai_id" id="barang_gadai_id" class="w-full rounded-xl border-slate-200 text-xs focus:ring-blue-600 focus:border-blue-600 py-2.5">
                        <option value="">-- Pilih Barang Jaminan Nasabah --</option>
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}" {{ old('barang_gadai_id') == $barang->id ? 'selected' : '' }}>
                                {{ $barang->nama_barang }} — {{ $barang->nasabah->nama ?? '-' }} (Taksiran: Rp {{ number_format($barang->taksiran_harga, 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                    @error('barang_gadai_id') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
                    @if ($barangs->isEmpty())
                        <p class="text-xs text-amber-600 mt-1.5 font-medium">⚠️ Semua barang sudah memiliki transaksi aktif, atau belum ada data barang gadai terdaftar.</p>
                    @endif
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Jumlah Pinjaman (Rp)</label>
                        <input type="number" name="jumlah_pinjaman" id="jumlah_pinjaman" value="{{ old('jumlah_pinjaman') }}" placeholder="Contoh: 5000000" class="w-full rounded-xl border-slate-200 text-xs font-mono focus:ring-blue-600 focus:border-blue-600 py-2.5">
                        @error('jumlah_pinjaman') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Bunga (% / Bulan)</label>
                        <input type="number" step="0.1" name="bunga_persen" id="bunga_persen" value="{{ old('bunga_persen', 5) }}" class="w-full rounded-xl border-slate-200 text-xs font-mono focus:ring-blue-600 focus:border-blue-600 py-2.5">
                        @error('bunga_persen') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Tenor Pinjaman (Bulan)</label>
                    <input type="number" name="tenor_bulan" id="tenor_bulan" value="{{ old('tenor_bulan', 1) }}" min="1" max="12" class="w-full rounded-xl border-slate-200 text-xs font-mono focus:ring-blue-600 focus:border-blue-600 py-2.5">
                    @error('tenor_bulan') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Live Preview Card -->
                <div id="preview" class="bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-100 rounded-xl p-4 text-xs space-y-2"></div>

                <div class="flex gap-3 pt-3 border-t border-slate-100">
                    <a href="{{ route('transaksi.index') }}" class="flex-1 text-center border border-slate-200 rounded-xl py-2.5 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">Batal</a>
                    <button type="submit" class="flex-1 bg-gradient-to-r from-blue-700 to-cyan-600 text-white rounded-xl py-2.5 text-xs font-bold hover:shadow-md transition">Simpan & Cetak Nota SPK</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updatePreview() {
            const pinjaman = parseFloat(document.getElementById('jumlah_pinjaman').value) || 0;
            const bunga = parseFloat(document.getElementById('bunga_persen').value) || 0;
            const tenor = parseInt(document.getElementById('tenor_bulan').value) || 1;

            const totalBunga = pinjaman * (bunga / 100) * tenor;
            const totalTagihan = pinjaman + totalBunga;

            const today = new Date();
            const jatuhTempo = new Date(today.getFullYear(), today.getMonth() + tenor, today.getDate());

            const fmt = (n) => 'Rp ' + Math.round(n).toLocaleString('id-ID');
            const fmtDate = (d) => d.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });

            document.getElementById('preview').innerHTML = `
                <div class="font-bold text-blue-900 border-b border-blue-100 pb-1 mb-2">Simulasi Perhitungan Kredit:</div>
                <div class="flex justify-between text-slate-600"><span>Estimasi Total Bunga (${tenor} bln):</span><b class="text-slate-800 font-mono">${fmt(totalBunga)}</b></div>
                <div class="flex justify-between text-slate-600"><span>Estimasi Total Pelunasan:</span><b class="text-blue-900 font-mono font-bold text-sm">${fmt(totalTagihan)}</b></div>
                <div class="flex justify-between text-slate-600"><span>Estimasi Tanggal Jatuh Tempo:</span><b class="text-rose-600 font-bold">${fmtDate(jatuhTempo)}</b></div>
            `;
        }

        ['jumlah_pinjaman', 'bunga_persen', 'tenor_bulan'].forEach(id => {
            document.getElementById(id).addEventListener('input', updatePreview);
        });
        updatePreview();
    </script>
</x-app-layout>
