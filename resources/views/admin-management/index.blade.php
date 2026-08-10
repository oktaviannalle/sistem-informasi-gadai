<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manajemen Admin / Petugas</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-lg flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-lg flex items-center justify-between">
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <div class="flex justify-end mb-4">
                <a href="{{ route('admin-management.create') }}" class="bg-gray-900 text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    + Tambah Admin Baru
                </a>
            </div>

            <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                            <tr>
                                <th class="px-6 py-3">Nama Petugas</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3">Tanggal Terdaftar</th>
                                <th class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($admins as $admin)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900 flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 font-bold flex items-center justify-center text-xs">
                                            {{ strtoupper(substr($admin->name, 0, 1)) }}
                                        </div>
                                        <span>{{ $admin->name }}</span>
                                        @if (auth()->id() === $admin->id)
                                            <span class="bg-blue-100 text-blue-700 text-[10px] font-semibold px-2 py-0.5 rounded-full">Anda</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 font-mono text-xs">{{ $admin->email }}</td>
                                    <td class="px-6 py-4 text-gray-500 text-xs">{{ $admin->created_at->format('d M Y, H:i') }}</td>
                                    <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap text-xs">
                                        <a href="{{ route('admin-management.edit', $admin) }}" class="text-blue-600 hover:underline font-medium">Edit</a>

                                        @if (auth()->id() !== $admin->id)
                                            <form action="{{ route('admin-management.destroy', $admin) }}" method="POST" class="inline" onsubmit="return confirm('Hapus akun admin ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline font-medium">Hapus</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-gray-400">Belum ada akun admin terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">{{ $admins->links() }}</div>
        </div>
    </div>
</x-app-layout>
