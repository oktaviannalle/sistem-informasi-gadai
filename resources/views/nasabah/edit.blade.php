<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Nasabah</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('nasabah.update', $nasabah) }}" method="POST" class="bg-white shadow-sm rounded-lg p-6 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $nasabah->nama) }}" class="w-full rounded-lg border-gray-300 text-sm focus:ring-gray-900 focus:border-gray-900">
                    @error('nama') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No KTP</label>
                    <input type="text" name="no_ktp" value="{{ old('no_ktp', $nasabah->no_ktp) }}" class="w-full rounded-lg border-gray-300 text-sm focus:ring-gray-900 focus:border-gray-900">
                    @error('no_ktp') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $nasabah->no_hp) }}" class="w-full rounded-lg border-gray-300 text-sm focus:ring-gray-900 focus:border-gray-900">
                    @error('no_hp') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <textarea name="alamat" rows="3" class="w-full rounded-lg border-gray-300 text-sm focus:ring-gray-900 focus:border-gray-900">{{ old('alamat', $nasabah->alamat) }}</textarea>
                    @error('alamat') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex gap-2 pt-2">
                    <a href="{{ route('nasabah.index') }}" class="flex-1 text-center border border-gray-300 rounded-lg py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Batal</a>
                    <button type="submit" class="flex-1 bg-gray-900 text-white rounded-lg py-2 text-sm font-semibold hover:bg-gray-700">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
