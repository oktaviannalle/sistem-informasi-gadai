<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Barang Gadai</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('barang-gadai.update', $barang_gadai) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-sm rounded-lg p-6 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nasabah</label>
                    <select name="nasabah_id" class="w-full rounded-lg border-gray-300 text-sm focus:ring-gray-900 focus:border-gray-900">
                        @foreach ($nasabahs as $nasabah)
                            <option value="{{ $nasabah->id }}" {{ old('nasabah_id', $barang_gadai->nasabah_id) == $nasabah->id ? 'selected' : '' }}>{{ $nasabah->nama }} ({{ $nasabah->no_ktp }})</option>
                        @endforeach
                    </select>
                    @error('nasabah_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
                    <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang_gadai->nama_barang) }}" class="w-full rounded-lg border-gray-300 text-sm focus:ring-gray-900 focus:border-gray-900">
                    @error('nama_barang') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select name="kategori" class="w-full rounded-lg border-gray-300 text-sm focus:ring-gray-900 focus:border-gray-900">
                        @foreach (['Elektronik', 'Perhiasan', 'Kendaraan', 'Lainnya'] as $kategori)
                            <option value="{{ $kategori }}" {{ old('kategori', $barang_gadai->kategori) == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Taksiran Harga (Rp)</label>
                    <input type="number" name="taksiran_harga" value="{{ old('taksiran_harga', $barang_gadai->taksiran_harga) }}" class="w-full rounded-lg border-gray-300 text-sm focus:ring-gray-900 focus:border-gray-900">
                    @error('taksiran_harga') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto Barang</label>
                    @if ($barang_gadai->foto)
                        <img src="{{ Storage::url($barang_gadai->foto) }}" class="w-20 h-20 object-cover rounded-lg mb-2">
                    @endif
                    <input type="file" name="foto" accept="image/*" class="w-full text-sm">
                    <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengganti foto.</p>
                    @error('foto') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex gap-2 pt-2">
                    <a href="{{ route('barang-gadai.index') }}" class="flex-1 text-center border border-gray-300 rounded-lg py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Batal</a>
                    <button type="submit" class="flex-1 bg-gray-900 text-white rounded-lg py-2 text-sm font-semibold hover:bg-gray-700">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
