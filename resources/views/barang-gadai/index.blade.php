<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Barang Gadai</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-700 text-sm px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-end mb-4">
                <a href="{{ route('barang-gadai.create') }}" class="bg-gray-900 text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    + Tambah Barang
                </a>
            </div>

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                            <tr>
                                <th class="px-6 py-3">Foto</th>
                                <th class="px-6 py-3">Nama Barang</th>
                                <th class="px-6 py-3">Kategori</th>
                                <th class="px-6 py-3">Taksiran</th>
                                <th class="px-6 py-3">Nasabah</th>
                                <th class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($barangGadais as $barang)
                                <tr class="border-t border-gray-100">
                                    <td class="px-6 py-3">
                                        @if ($barang->foto)
                                            <img src="{{ Storage::url($barang->foto) }}" class="w-12 h-12 object-cover rounded-lg">
                                        @else
                                            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 text-xs">N/A</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-3 font-medium text-gray-800">{{ $barang->nama_barang }}</td>
                                    <td class="px-6 py-3 text-gray-600">{{ $barang->kategori }}</td>
                                    <td class="px-6 py-3 text-gray-600">Rp {{ number_format($barang->taksiran_harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-3 text-gray-600">{{ $barang->nasabah->nama ?? '-' }}</td>
                                    <td class="px-6 py-3 text-right space-x-3">
                                        <a href="{{ route('barang-gadai.edit', $barang) }}" class="text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('barang-gadai.destroy', $barang) }}" method="POST" class="inline" onsubmit="return confirm('Hapus barang {{ $barang->nama_barang }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-400">Belum ada data barang gadai. Klik "Tambah Barang" untuk mulai.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">{{ $barangGadais->links() }}</div>
        </div>
    </div>
</x-app-layout>
