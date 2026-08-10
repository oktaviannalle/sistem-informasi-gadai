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

        <!-- Tailwind CSS CDN Fallback for instant 100% rendering -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            brand: {
                                50: '#eff6ff',
                                100: '#dbeafe',
                                500: '#3b82f6',
                                600: '#2563eb',
                                700: '#1d4ed8',
                                800: '#1e40af',
                                900: '#1e3a8a',
                            }
                        }
                    }
                }
            }
        </script>

        <!-- Vite Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-100 text-slate-900 min-h-full flex flex-col selection:bg-blue-700 selection:text-white">
        <div class="min-h-screen flex flex-col bg-slate-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white border-b-2 border-slate-200 shadow-sm sticky top-0 z-10">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1 pb-12">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-slate-900 border-t-4 border-blue-600 py-6 text-center text-xs text-slate-300">
                <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row justify-between items-center gap-3">
                    <div class="flex items-center gap-2.5">
                        <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-6 w-6">
                        <span class="font-black text-white uppercase tracking-wider text-sm">Sistem-Gadai Mahenswa</span>
                        <span class="text-blue-400 font-bold">&bull; Gadai Startech Sleman</span>
                    </div>
                    <div class="font-medium text-slate-400">
                        &copy; {{ date('Y') }} Gadai Startech. All rights reserved.
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
