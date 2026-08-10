<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 tracking-tight">Manajemen Data Nasabah</h2>
                <p class="text-xs text-slate-500 mt-1">Kelola informasi identitas nasabah dan kontak terdaftar Gadai Startech</p>
            </div>
            <div>
                <a href="{{ route('nasabah.create') }}" class="bg-gradient-to-r from-blue-700 to-cyan-600 text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow hover:shadow-md transition inline-flex items-center gap-1.5">
                    <span>+ Tambah Nasabah</span>
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
                                <th class="px-6 py-4">Nama Nasabah</th>
                                <th class="px-6 py-4">No. KTP</th>
                                <th class="px-6 py-4">No. WhatsApp/HP</th>
                                <th class="px-6 py-4">Alamat Terdaftar</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($nasabahs as $nasabah)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-6 py-4 font-bold text-slate-900 flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-xl bg-blue-100 text-blue-700 font-extrabold flex items-center justify-center text-xs">
                                            {{ strtoupper(substr($nasabah->nama, 0, 1)) }}
                                        </div>
                                        <span>{{ $nasabah->nama }}</span>
                                    </td>
                                    <td class="px-6 py-4 font-mono text-slate-600 font-semibold">{{ $nasabah->no_ktp }}</td>
                                    <td class="px-6 py-4 font-mono text-slate-600">{{ $nasabah->no_hp }}</td>
                                    <td class="px-6 py-4 text-slate-500 max-w-xs truncate">{{ $nasabah->alamat }}</td>
                                    <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                        <a href="{{ route('nasabah.edit', $nasabah) }}" class="text-blue-600 hover:text-blue-800 font-bold hover:underline">Edit</a>
                                        <form action="{{ route('nasabah.destroy', $nasabah) }}" method="POST" class="inline" onsubmit="return confirm('Hapus nasabah {{ $nasabah->nama }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-600 hover:text-rose-800 font-bold hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                        <span class="text-3xl block mb-2">👤</span>
                                        Belum ada data nasabah. Klik <strong>"+ Tambah Nasabah"</strong> untuk mulai pencatatan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-5">{{ $nasabahs->links() }}</div>
        </div>
    </div>
</x-app-layout>
