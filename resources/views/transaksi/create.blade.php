<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Transaksi Gadai Baru</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('transaksi.store') }}" method="POST" class="bg-white shadow-sm rounded-lg p-6 space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Barang</label>
                    <select name="barang_gadai_id" id="barang_gadai_id" class="w-full rounded-lg border-gray-300 text-sm focus:ring-gray-900 focus:border-gray-900">
                        <option value="">-- Pilih Barang --</option>
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}" {{ old('barang_gadai_id') == $barang->id ? 'selected' : '' }}>
                                {{ $barang->nama_barang }} — {{ $barang->nasabah->nama ?? '-' }} (taksiran Rp {{ number_format($barang->taksiran_harga, 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                    @error('barang_gadai_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    @if ($barangs->isEmpty())
                        <p class="text-xs text-amber-600 mt-1">Semua barang sudah punya transaksi aktif, atau belum ada data barang gadai.</p>
                    @endif
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Pinjaman (Rp)</label>
                        <input type="number" name="jumlah_pinjaman" id="jumlah_pinjaman" value="{{ old('jumlah_pinjaman') }}" class="w-full rounded-lg border-gray-300 text-sm focus:ring-gray-900 focus:border-gray-900">
                        @error('jumlah_pinjaman') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Bunga (%/bulan)</label>
                        <input type="number" step="0.1" name="bunga_persen" id="bunga_persen" value="{{ old('bunga_persen', 5) }}" class="w-full rounded-lg border-gray-300 text-sm focus:ring-gray-900 focus:border-gray-900">
                        @error('bunga_persen') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tenor (bulan)</label>
                    <input type="number" name="tenor_bulan" id="tenor_bulan" value="{{ old('tenor_bulan', 1) }}" min="1" max="12" class="w-full rounded-lg border-gray-300 text-sm focus:ring-gray-900 focus:border-gray-900">
                    @error('tenor_bulan') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div id="preview" class="bg-amber-50 text-amber-800 rounded-lg px-4 py-3 text-xs space-y-1"></div>

                <div class="flex gap-2 pt-2">
                    <a href="{{ route('transaksi.index') }}" class="flex-1 text-center border border-gray-300 rounded-lg py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Batal</a>
                    <button type="submit" class="flex-1 bg-gray-900 text-white rounded-lg py-2 text-sm font-semibold hover:bg-gray-700">Simpan Transaksi</button>
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
                <div class="flex justify-between"><span>Total Bunga</span><b>${fmt(totalBunga)}</b></div>
                <div class="flex justify-between"><span>Total Tagihan</span><b>${fmt(totalTagihan)}</b></div>
                <div class="flex justify-between"><span>Jatuh Tempo</span><b>${fmtDate(jatuhTempo)}</b></div>
            `;
        }

        ['jumlah_pinjaman', 'bunga_persen', 'tenor_bulan'].forEach(id => {
            document.getElementById(id).addEventListener('input', updatePreview);
        });
        updatePreview();
    </script>
</x-app-layout>
