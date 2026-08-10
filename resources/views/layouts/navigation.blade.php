<nav x-data="{ open: false }" class="bg-white border-b-4 border-blue-700 shadow-md sticky top-0 z-30">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo with "sistem-gadai mahenswa" -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 transition transform hover:scale-[1.01]">
                        <img src="{{ asset('images/logo.svg') }}" alt="Logo Sistem Gadai Mahenswa" class="h-12 w-12 object-contain drop-shadow">
                        <div class="flex flex-col">
                            <span class="font-black text-base sm:text-lg tracking-tight text-blue-950 uppercase leading-tight">
                                SISTEM-GADAI MAHENSWA
                            </span>
                            <span class="text-[10px] font-black text-blue-600 tracking-widest uppercase">Internal Management System</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 lg:space-x-3 sm:-my-px sm:ms-8 sm:flex items-center">
                    <a href="{{ route('dashboard') }}" class="px-3.5 py-2 rounded-xl text-xs font-black tracking-wide transition flex items-center gap-1.5 {{ request()->routeIs('dashboard') ? 'bg-blue-700 text-white shadow-md' : 'text-slate-800 hover:bg-slate-100 hover:text-blue-700' }}">
                        <span>📊 Dashboard</span>
                    </a>
                    <a href="{{ route('nasabah.index') }}" class="px-3.5 py-2 rounded-xl text-xs font-black tracking-wide transition flex items-center gap-1.5 {{ request()->routeIs('nasabah.*') ? 'bg-blue-700 text-white shadow-md' : 'text-slate-800 hover:bg-slate-100 hover:text-blue-700' }}">
                        <span>👥 Nasabah</span>
                    </a>
                    <a href="{{ route('barang-gadai.index') }}" class="px-3.5 py-2 rounded-xl text-xs font-black tracking-wide transition flex items-center gap-1.5 {{ request()->routeIs('barang-gadai.*') ? 'bg-blue-700 text-white shadow-md' : 'text-slate-800 hover:bg-slate-100 hover:text-blue-700' }}">
                        <span>📦 Barang Gadai</span>
                    </a>
                    <a href="{{ route('transaksi.index') }}" class="px-3.5 py-2 rounded-xl text-xs font-black tracking-wide transition flex items-center gap-1.5 {{ request()->routeIs('transaksi.*') ? 'bg-blue-700 text-white shadow-md' : 'text-slate-800 hover:bg-slate-100 hover:text-blue-700' }}">
                        <span>💳 Transaksi</span>
                    </a>
                    <a href="{{ route('admin-management.index') }}" class="px-3.5 py-2 rounded-xl text-xs font-black tracking-wide transition flex items-center gap-1.5 {{ request()->routeIs('admin-management.*') ? 'bg-blue-700 text-white shadow-md' : 'text-slate-800 hover:bg-slate-100 hover:text-blue-700' }}">
                        <span>🛡️ Kelola Admin</span>
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2.5 px-4 py-2 rounded-xl text-xs font-black text-white bg-blue-900 hover:bg-blue-800 shadow transition border border-blue-700">
                            <div class="w-6 h-6 rounded-lg bg-cyan-400 text-blue-950 font-black flex items-center justify-center text-xs">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span>{{ Auth::user()->name }}</span>

                            <svg class="fill-current h-4 w-4 text-cyan-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-slate-200 bg-slate-100">
                            <p class="text-xs font-black text-slate-900">{{ Auth::user()->name }}</p>
                            <p class="text-[11px] text-slate-600 font-mono font-bold truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="text-xs font-bold text-slate-800">
                            ⚙️ {{ __('Profile Admin') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="text-xs font-bold text-rose-600 hover:text-rose-700">
                                🚪 {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2.5 rounded-xl text-slate-700 bg-slate-100 hover:bg-slate-200 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t-2 border-slate-200 shadow-xl">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2.5 rounded-xl text-xs font-black {{ request()->routeIs('dashboard') ? 'bg-blue-700 text-white' : 'text-slate-800 hover:bg-slate-100' }}">
                📊 {{ __('Dashboard') }}
            </a>
            <a href="{{ route('nasabah.index') }}" class="block px-4 py-2.5 rounded-xl text-xs font-black {{ request()->routeIs('nasabah.*') ? 'bg-blue-700 text-white' : 'text-slate-800 hover:bg-slate-100' }}">
                👥 {{ __('Nasabah') }}
            </a>
            <a href="{{ route('barang-gadai.index') }}" class="block px-4 py-2.5 rounded-xl text-xs font-black {{ request()->routeIs('barang-gadai.*') ? 'bg-blue-700 text-white' : 'text-slate-800 hover:bg-slate-100' }}">
                📦 {{ __('Barang Gadai') }}
            </a>
            <a href="{{ route('transaksi.index') }}" class="block px-4 py-2.5 rounded-xl text-xs font-black {{ request()->routeIs('transaksi.*') ? 'bg-blue-700 text-white' : 'text-slate-800 hover:bg-slate-100' }}">
                💳 {{ __('Transaksi') }}
            </a>
            <a href="{{ route('admin-management.index') }}" class="block px-4 py-2.5 rounded-xl text-xs font-black {{ request()->routeIs('admin-management.*') ? 'bg-blue-700 text-white' : 'text-slate-800 hover:bg-slate-100' }}">
                🛡️ {{ __('Kelola Admin') }}
            </a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-4 border-t-2 border-slate-200 px-4 bg-slate-50">
            <div class="px-2">
                <div class="font-black text-base text-slate-900">{{ Auth::user()->name }}</div>
                <div class="font-bold text-xs text-slate-600 font-mono">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-xs font-bold text-slate-800 hover:bg-slate-200">
                    ⚙️ {{ __('Profile Admin') }}
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="block w-full text-left px-3 py-2 rounded-lg text-xs font-bold text-rose-600 hover:bg-rose-50">
                        🚪 {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
