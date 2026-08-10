<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 tracking-tight">Manajemen Admin & Petugas</h2>
                <p class="text-xs text-slate-500 mt-1">Kelola akun administrator dan hak akses petugas cabang Gadai Startech</p>
            </div>
            <div>
                <a href="{{ route('admin-management.create') }}" class="bg-gradient-to-r from-blue-700 to-cyan-600 text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow hover:shadow-md transition inline-flex items-center gap-1.5">
                    <span>+ Tambah Admin Baru</span>
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

            @if (session('error'))
                <div class="mb-5 bg-rose-50 border border-rose-200 text-rose-700 text-xs font-medium px-4 py-3 rounded-xl flex items-center justify-between shadow-sm">
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-xs text-left">
                        <thead class="bg-slate-50 text-slate-400 font-bold uppercase text-[10px] tracking-wider border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4">Nama Petugas Admin</th>
                                <th class="px-6 py-4">Alamat Email</th>
                                <th class="px-6 py-4">Tanggal Terdaftar</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($admins as $admin)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-6 py-4 font-bold text-slate-900 flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-700 to-cyan-500 text-white font-extrabold flex items-center justify-center text-xs shadow-sm">
                                            {{ strtoupper(substr($admin->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <span class="text-slate-900">{{ $admin->name }}</span>
                                                @if (auth()->id() === $admin->id)
                                                    <span class="bg-blue-100 text-blue-700 text-[10px] font-extrabold px-2 py-0.5 rounded-full">Akun Anda</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-mono text-slate-600 font-semibold">{{ $admin->email }}</td>
                                    <td class="px-6 py-4 text-slate-500 font-mono text-[11px]">{{ $admin->created_at->format('d M Y, H:i') }}</td>
                                    <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                        <a href="{{ route('admin-management.edit', $admin) }}" class="text-blue-600 hover:text-blue-800 font-bold hover:underline">Edit</a>

                                        @if (auth()->id() !== $admin->id)
                                            <form action="{{ route('admin-management.destroy', $admin) }}" method="POST" class="inline" onsubmit="return confirm('Hapus akun admin ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-rose-600 hover:text-rose-800 font-bold hover:underline">Hapus</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-slate-400">Belum ada akun admin terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-5">{{ $admins->links() }}</div>
        </div>
    </div>
</x-app-layout>
