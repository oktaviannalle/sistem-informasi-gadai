<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 tracking-tight">Inventaris Barang Gadai</h2>
                <p class="text-xs text-slate-500 mt-1">Kelola barang jaminan, kategori produk, dan taksiran harga gadai</p>
            </div>
            <div>
                <a href="{{ route('barang-gadai.create') }}" class="bg-gradient-to-r from-blue-700 to-cyan-600 text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow hover:shadow-md transition inline-flex items-center gap-1.5">
                    <span>+ Tambah Barang</span>
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

            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-xs text-left">
                        <thead class="bg-slate-50 text-slate-400 font-bold uppercase text-[10px] tracking-wider border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4">Preview</th>
                                <th class="px-6 py-4">Nama Barang Jaminan</th>
                                <th class="px-6 py-4">Kategori</th>
                                <th class="px-6 py-4">Pemilik (Nasabah)</th>
                                <th class="px-6 py-4">Taksiran Harga Pasar</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($barangGadais as $barang)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-6 py-3">
                                        @if ($barang->foto)
                                            <img src="{{ Storage::url($barang->foto) }}" class="w-12 h-12 object-cover rounded-xl border border-slate-200 shadow-sm">
                                        @else
                                            <div class="w-12 h-12 bg-slate-100 border border-slate-200 rounded-xl flex items-center justify-center text-slate-400 text-base font-bold">📷</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-bold text-slate-900">{{ $barang->nama_barang }}</td>
                                    <td class="px-6 py-4">
                                        <span class="bg-cyan-50 text-cyan-700 border border-cyan-200/60 font-semibold px-2.5 py-0.5 rounded-full text-[10px]">
                                            {{ $barang->kategori }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-slate-800">{{ $barang->nasabah->nama ?? '-' }}</td>
                                    <td class="px-6 py-4 font-bold text-emerald-700 font-mono">
                                        Rp {{ number_format($barang->taksiran_harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                        <a href="{{ route('barang-gadai.edit', $barang) }}" class="text-blue-600 hover:text-blue-800 font-bold hover:underline">Edit</a>
                                        <form action="{{ route('barang-gadai.destroy', $barang) }}" method="POST" class="inline" onsubmit="return confirm('Hapus barang {{ $barang->nama_barang }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-600 hover:text-rose-800 font-bold hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                        <span class="text-3xl block mb-2">📦</span>
                                        Belum ada data barang gadai. Klik <strong>"+ Tambah Barang"</strong> untuk pencatatan baru.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-5">{{ $barangGadais->links() }}</div>
        </div>
    </div>
</x-app-layout>
