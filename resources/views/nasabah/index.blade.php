<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Nasabah</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-700 text-sm px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-end mb-4">
                <a href="{{ route('nasabah.create') }}" class="bg-gray-900 text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    + Tambah Nasabah
                </a>
            </div>

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                            <tr>
                                <th class="px-6 py-3">Nama</th>
                                <th class="px-6 py-3">No KTP</th>
                                <th class="px-6 py-3">No HP</th>
                                <th class="px-6 py-3">Alamat</th>
                                <th class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($nasabahs as $nasabah)
                                <tr class="border-t border-gray-100">
                                    <td class="px-6 py-3 font-medium text-gray-800">{{ $nasabah->nama }}</td>
                                    <td class="px-6 py-3 text-gray-600">{{ $nasabah->no_ktp }}</td>
                                    <td class="px-6 py-3 text-gray-600">{{ $nasabah->no_hp }}</td>
                                    <td class="px-6 py-3 text-gray-500">{{ Str::limit($nasabah->alamat, 40) }}</td>
                                    <td class="px-6 py-3 text-right space-x-3">
                                        <a href="{{ route('nasabah.edit', $nasabah) }}" class="text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('nasabah.destroy', $nasabah) }}" method="POST" class="inline" onsubmit="return confirm('Hapus nasabah {{ $nasabah->nama }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-400">Belum ada data nasabah. Klik "Tambah Nasabah" untuk mulai.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">{{ $nasabahs->links() }}</div>
        </div>
    </div>
</x-app-layout>
