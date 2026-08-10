<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Bukti Gadai - #TRX-{{ str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background-color: #fff;
                padding: 0;
            }
            .print-container {
                box-shadow: none;
                border: none;
                padding: 0;
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans p-6">

    <div class="no-print max-w-3xl mx-auto mb-4 flex justify-between items-center">
        <a href="{{ route('transaksi.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900">
            &larr; Kembali ke Daftar Transaksi
        </a>
        <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-5 py-2.5 rounded-lg shadow transition">
            🖨️ Cetak / Simpan PDF
        </button>
    </div>

    <div class="print-container max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-200">
        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-6 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-blue-900 tracking-wide">GADAI STARTECH</h1>
                <p class="text-xs text-gray-500">Layanan Gadai Cepat, Aman & Terpercaya</p>
                <p class="text-xs text-gray-500">Jl. Kaliurang KM 9, Sleman, DI Yogyakarta | Telp: 0823-4275-6680</p>
            </div>
            <div class="text-right">
                <span class="inline-block bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-1">
                    Surat Perjanjian Kredit (SPK)
                </span>
                <p class="text-xs text-gray-400">No. Transaksi:</p>
                <p class="font-mono text-lg font-bold text-gray-800">#TRX-{{ str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>

        <!-- Detail Nasabah & Transaksi -->
        <div class="grid grid-cols-2 gap-6 mb-6 text-sm">
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                <h3 class="font-semibold text-gray-700 border-b pb-2 mb-3">Identitas Nasabah</h3>
                <table class="w-full text-xs">
                    <tr class="py-1"><td class="text-gray-500 w-28 py-1">Nama Nasabah</td><td class="font-semibold text-gray-800">: {{ $transaksi->barang->nasabah->nama ?? '-' }}</td></tr>
                    <tr class="py-1"><td class="text-gray-500 py-1">No. KTP</td><td class="text-gray-800">: {{ $transaksi->barang->nasabah->no_ktp ?? '-' }}</td></tr>
                    <tr class="py-1"><td class="text-gray-500 py-1">No. HP</td><td class="text-gray-800">: {{ $transaksi->barang->nasabah->no_hp ?? '-' }}</td></tr>
                    <tr class="py-1"><td class="text-gray-500 py-1">Alamat</td><td class="text-gray-800">: {{ $transaksi->barang->nasabah->alamat ?? '-' }}</td></tr>
                </table>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                <h3 class="font-semibold text-gray-700 border-b pb-2 mb-3">Informasi Transaksi</h3>
                <table class="w-full text-xs">
                    <tr class="py-1"><td class="text-gray-500 w-28 py-1">Tanggal Gadai</td><td class="text-gray-800">: {{ $transaksi->tanggal_gadai->format('d M Y') }}</td></tr>
                    <tr class="py-1"><td class="text-gray-500 py-1">Jatuh Tempo</td><td class="font-bold text-red-600">: {{ $transaksi->tanggal_jatuh_tempo->format('d M Y') }}</td></tr>
                    <tr class="py-1"><td class="text-gray-500 py-1">Status Gadai</td><td class="font-semibold text-gray-800">: {{ strtoupper($transaksi->status) }}</td></tr>
                    <tr class="py-1"><td class="text-gray-500 py-1">Petugas / Admin</td><td class="text-gray-800">: {{ $transaksi->admin->name ?? 'Admin' }}</td></tr>
                </table>
            </div>
        </div>

        <!-- Detail Barang Gadai -->
        <div class="mb-6">
            <h3 class="font-semibold text-gray-800 text-sm mb-3">Detail Barang Jaminan</h3>
            <table class="w-full text-xs border border-gray-200">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="border px-4 py-2 text-left">Nama Barang</th>
                        <th class="border px-4 py-2 text-left">Kategori</th>
                        <th class="border px-4 py-2 text-right">Taksiran Harga</th>
                        <th class="border px-4 py-2 text-right">Pinjaman Disetujui</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-3 font-semibold text-gray-800">{{ $transaksi->barang->nama_barang ?? '-' }}</td>
                        <td class="border px-4 py-3 text-gray-600">{{ $transaksi->barang->kategori ?? '-' }}</td>
                        <td class="border px-4 py-3 text-right text-gray-600">Rp {{ number_format($transaksi->barang->taksiran_harga ?? 0, 0, ',', '.') }}</td>
                        <td class="border px-4 py-3 text-right font-bold text-blue-900">Rp {{ number_format($transaksi->jumlah_pinjaman, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Rincian Pembayaran & Tebusan -->
        <div class="bg-blue-50/50 p-4 rounded-lg border border-blue-100 mb-6">
            <h3 class="font-semibold text-blue-900 text-sm border-b border-blue-200 pb-2 mb-3">Rincian Perhitungan Pelunasan</h3>
            <div class="grid grid-cols-2 gap-4 text-xs">
                <div>
                    <div class="flex justify-between py-1 border-b border-blue-100">
                        <span class="text-gray-600">Pinjaman Pokok:</span>
                        <span class="font-semibold">Rp {{ number_format($transaksi->jumlah_pinjaman, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-blue-100">
                        <span class="text-gray-600">Bunga Gadai ({{ $transaksi->bunga_persen }}%):</span>
                        <span class="font-semibold">Rp {{ number_format($transaksi->total_bunga, 0, ',', '.') }}</span>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between py-1 border-b border-blue-100">
                        <span class="text-gray-600">Terlambat (Hari):</span>
                        <span class="font-semibold {{ $transaksi->hari_terlambat > 0 ? 'text-red-600' : 'text-gray-700' }}">{{ $transaksi->hari_terlambat }} Hari</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-blue-100">
                        <span class="text-gray-600">Denda Keterlambatan:</span>
                        <span class="font-semibold text-red-600">Rp {{ number_format($transaksi->denda, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            <div class="flex justify-between items-center mt-3 pt-3 border-t border-blue-200 text-sm">
                <span class="font-bold text-blue-900">TOTAL HARUS DIBAYAR (TEBUSAN):</span>
                <span class="font-extrabold text-xl text-blue-900">Rp {{ number_format($transaksi->total_tebusan, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Ketentuan -->
        <div class="text-[11px] text-gray-500 mb-8 border-t border-b py-3 leading-relaxed">
            <p class="font-semibold text-gray-700 mb-1">Ketentuan & Syarat Gadai Startech:</p>
            <ol class="list-decimal pl-4 space-y-0.5">
                <li>Surat bukti gadai ini adalah bukti sah kepemilikan barang yang digadaikan. Jangan sampai hilang.</li>
                <li>Pelunasan atau perpanjangan gadai wajib dilakukan sebelum tanggal jatuh tempo.</li>
                <li>Barang gadai yang tidak ditebus atau diperpanjang sampai batas akhir dapat diproses lelang sesuai aturan yang berlaku.</li>
            </ol>
        </div>

        <!-- Tanda Tangan -->
        <div class="grid grid-cols-2 text-center text-xs text-gray-600 pt-4">
            <div>
                <p class="mb-14">Nasabah / Pemilik Barang</p>
                <p class="font-bold text-gray-800 border-t border-gray-300 inline-block px-8 pt-1">({{ $transaksi->barang->nasabah->nama ?? 'Nasabah' }})</p>
            </div>
            <div>
                <p class="mb-14">Sleman, {{ now()->format('d M Y') }}<br>Petugas Gadai Startech</p>
                <p class="font-bold text-gray-800 border-t border-gray-300 inline-block px-8 pt-1">({{ $transaksi->admin->name ?? 'Admin Startech' }})</p>
            </div>
        </div>
    </div>

</body>
</html>
