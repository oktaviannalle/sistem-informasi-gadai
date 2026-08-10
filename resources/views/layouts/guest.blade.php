<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sistem-Gadai Mahenswa') }}</title>

        <!-- Google Fonts: Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
        </style>
    </head>
    <body class="font-sans text-slate-900 antialiased min-h-full flex flex-col selection:bg-blue-700 selection:text-white">
        <div class="min-h-screen flex flex-col sm:justify-center items-center py-12 px-4 bg-gradient-to-br from-blue-950 via-blue-900 to-slate-900 relative">

            <div class="relative z-10 mb-8 transition transform hover:scale-105">
                <a href="/" class="flex flex-col items-center text-center">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo Sistem Gadai Mahenswa" class="h-20 w-20 object-contain drop-shadow-lg mb-2">
                    <span class="font-black text-2xl tracking-tight text-white uppercase drop-shadow">
                        SISTEM-GADAI MAHENSWA
                    </span>
                    <span class="text-xs font-black text-cyan-300 tracking-widest uppercase">Internal Portal Login</span>
                </a>
            </div>

            <div class="relative z-10 w-full sm:max-w-md bg-white shadow-2xl overflow-hidden sm:rounded-3xl border-4 border-blue-500 p-8 text-slate-900">
                {{ $slot }}
            </div>

            <p class="relative z-10 mt-8 text-center text-xs font-bold text-slate-300">
                &copy; {{ date('Y') }} SISTEM-GADAI MAHENSWA &bull; Gadai Startech
            </p>
        </div>
    </body>
</html>
