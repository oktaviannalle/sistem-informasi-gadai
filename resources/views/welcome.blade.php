<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen flex flex-col">

            <nav class="w-full py-5 px-6 sm:px-10">
                <div class="max-w-6xl mx-auto flex justify-between items-center">
                    <span class="font-bold text-lg text-gray-900">Sistem Gadai</span>
                    <div class="flex gap-3">
                        @auth
                            <a href="{{ route('dashboard') }}" class="bg-gray-900 text-white text-sm font-semibold px-5 py-2 rounded-lg hover:bg-gray-700 transition">
                                Ke Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-100 transition">
                                Masuk
                            </a>
                        @endauth
                    </div>
                </div>
            </nav>

            <main class="flex-1 flex items-center">
                <div class="max-w-6xl mx-auto px-6 sm:px-10 py-16 grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <span class="inline-block bg-amber-100 text-amber-800 text-xs font-semibold px-3 py-1 rounded-full mb-4">
                            Internal Admin System
                        </span>
                        <h1 class="text-4xl font-bold text-gray-900 leading-tight mb-4">
                            Kelola Data Gadai Lebih Rapi dan Terpusat
                        </h1>
                        <p class="text-gray-600 mb-8 leading-relaxed">
                            Platform internal untuk mencatat nasabah, barang gadai, transaksi pinjaman,
                            bunga, dan jatuh tempo — semua dalam satu dashboard.
                        </p>
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-block bg-gray-900 text-white font-semibold px-6 py-3 rounded-lg hover:bg-gray-700 transition">
                                Buka Dashboard →
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-block bg-gray-900 text-white font-semibold px-6 py-3 rounded-lg hover:bg-gray-700 transition">
                                Masuk ke Sistem →
                            </a>
                        @endauth
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm p-8 space-y-4">
                        <div class="flex items-center gap-4 pb-4 border-b border-gray-100">
                            <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 font-bold">N</div>
                            <div>
                                <p class="font-semibold text-gray-800 text-sm">Manajemen Nasabah</p>
                                <p class="text-xs text-gray-500">Data lengkap dan riwayat barang</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 pb-4 border-b border-gray-100">
                            <div class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center text-amber-600 font-bold">B</div>
                            <div>
                                <p class="font-semibold text-gray-800 text-sm">Barang Gadai</p>
                                <p class="text-xs text-gray-500">Taksiran harga & foto barang</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center text-green-600 font-bold">T</div>
                            <div>
                                <p class="font-semibold text-gray-800 text-sm">Transaksi & Bunga</p>
                                <p class="text-xs text-gray-500">Hitung otomatis jatuh tempo</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="text-center text-xs text-gray-400 py-6">
                &copy; {{ date('Y') }} Sistem Gadai — Dibangun dengan Laravel
            </footer>
        </div>
    </body>
</html>
