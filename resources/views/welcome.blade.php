<!DOCTYPE html>
<html lang="id" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistem-Gadai Mahenswa - Pusat Informasi Internal Gadai Startech</title>

        <!-- Google Fonts: Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-100 text-slate-900 min-h-full flex flex-col selection:bg-blue-700 selection:text-white">
        <div class="min-h-screen flex flex-col bg-slate-100">

            <!-- Navbar Clean White (Pusat Gadai Style) -->
            <nav class="w-full py-5 px-6 sm:px-12 bg-white border-b-4 border-blue-700 shadow-md sticky top-0 z-30">
                <div class="max-w-7xl mx-auto flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.svg') }}" alt="Logo Sistem Gadai Mahenswa" class="h-12 w-12 object-contain drop-shadow">
                        <div class="flex flex-col">
                            <span class="font-black text-lg sm:text-xl tracking-tight text-blue-950 uppercase leading-tight">
                                SISTEM-GADAI MAHENSWA
                            </span>
                            <span class="text-[10px] font-black text-blue-600 tracking-widest uppercase">Gadai Startech Internal System</span>
                        </div>
                    </div>
                    <div>
                        @auth
                            <a href="{{ route('dashboard') }}" class="bg-blue-700 hover:bg-blue-800 text-white text-xs font-black px-6 py-3 rounded-xl shadow-md transition inline-block">
                                Buka Dashboard &rarr;
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="bg-blue-900 hover:bg-blue-950 text-white text-xs font-black px-6 py-3 rounded-xl shadow-md transition inline-block">
                                Masuk Portal Internal
                            </a>
                        @endauth
                    </div>
                </div>
            </nav>

            <!-- Hero Banner (Pusat Gadai Royal Blue Theme) -->
            <main class="flex-1">
                <section class="bg-gradient-to-r from-blue-950 via-blue-900 to-blue-700 text-white py-16 sm:py-24 px-6 sm:px-12 relative overflow-hidden border-b-4 border-blue-800">
                    <div class="max-w-7xl mx-auto grid lg:grid-cols-12 gap-12 items-center relative z-10">
                        
                        <!-- Left Hero Text -->
                        <div class="lg:col-span-7 space-y-6">
                            <div class="inline-flex items-center gap-2 bg-blue-500/30 border border-cyan-300/40 text-cyan-300 text-xs font-black px-4 py-1.5 rounded-full shadow-inner">
                                ⚡ SISTEM INFORMASI GADAI STARTECH SLEMAN
                            </div>
                            
                            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black leading-tight tracking-tight text-white">
                                Layanan Gadai Cepat, <span class="text-cyan-300 underline decoration-cyan-400">Aman & Terpercaya</span>
                            </h1>
                            
                            <p class="text-blue-100 text-sm sm:text-base font-semibold leading-relaxed max-w-xl">
                                Penuhi kebutuhan transaksi penaksiran barang gadai elektronik, gadget, perhiasan emas, dan kendaraan secara akurat, cepat, dan transparan.
                            </p>

                            <div class="pt-4 flex flex-wrap items-center gap-4">
                                @auth
                                    <a href="{{ route('dashboard') }}" class="bg-cyan-400 hover:bg-cyan-300 text-blue-950 font-black text-sm px-8 py-4 rounded-xl shadow-xl transition transform hover:scale-105 inline-block uppercase tracking-wider">
                                        Buka Executive Dashboard &rarr;
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="bg-cyan-400 hover:bg-cyan-300 text-blue-950 font-black text-sm px-8 py-4 rounded-xl shadow-xl transition transform hover:scale-105 inline-block uppercase tracking-wider">
                                        Login Administrator &rarr;
                                    </a>
                                @endauth
                            </div>
                        </div>

                        <!-- Right Visual Cards Showcase -->
                        <div class="lg:col-span-5">
                            <div class="bg-white rounded-3xl p-8 shadow-2xl text-slate-900 border-4 border-blue-400 space-y-5">
                                <div class="flex items-center gap-4 pb-4 border-b-2 border-slate-200">
                                    <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-900 flex items-center justify-center text-2xl font-black">
                                        🏛️
                                    </div>
                                    <div>
                                        <h3 class="font-black text-slate-900 text-base uppercase">Internal Back-Office</h3>
                                        <p class="text-xs font-bold text-slate-600">Sistem Operasional Petugas Cabang</p>
                                    </div>
                                </div>

                                <div class="space-y-3 font-bold text-xs">
                                    <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-100 border border-slate-200">
                                        <span class="text-slate-800">👥 Manajemen Data Nasabah</span>
                                        <span class="font-black text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded">Aktif</span>
                                    </div>
                                    <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-100 border border-slate-200">
                                        <span class="text-slate-800">📦 Taksiran Barang Jaminan</span>
                                        <span class="font-black text-blue-700 bg-blue-100 px-2 py-0.5 rounded">Akurat</span>
                                    </div>
                                    <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-100 border border-slate-200">
                                        <span class="text-slate-800">💰 Perhitungan Denda Harian</span>
                                        <span class="font-black text-cyan-700 bg-cyan-100 px-2 py-0.5 rounded">Otomatis</span>
                                    </div>
                                    <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-100 border border-slate-200">
                                        <span class="text-slate-800">🖨️ Cetak Nota SPK Bukti Gadai</span>
                                        <span class="font-black text-amber-800 bg-amber-100 px-2 py-0.5 rounded">Print Ready</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </main>

            <!-- Footer -->
            <footer class="bg-slate-900 text-center text-xs text-slate-300 py-6 border-t-4 border-blue-600">
                &copy; {{ date('Y') }} SISTEM-GADAI MAHENSWA &bull; Gadai Startech Sleman. All rights reserved.
            </footer>
        </div>
    </body>
</html>
