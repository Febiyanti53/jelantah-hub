<aside 
    :class="sidebarExpanded ? 'w-64' : 'w-20'" 
    class="hidden md:flex flex-col fixed inset-y-0 left-0 bg-slate-900 text-slate-300 transition-all duration-300 ease-in-out z-30 border-r border-slate-800 shadow-xl">
    
    <div class="h-16 flex items-center px-4 border-b border-slate-800 bg-slate-950 overflow-hidden shrink-0">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-emerald-600 rounded-xl text-white shadow-md shadow-emerald-900/30 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                </svg>
            </div>
            <div class="flex flex-col tracking-tight transition-opacity duration-200" x-show="sidebarExpanded">
                <span class="font-bold text-sm text-white">JelantahHub</span>
                <span class="text-[10px] text-emerald-400 font-medium uppercase -mt-0.5">{{ Auth::user()->role }}</span>
            </div>
        </div>
    </div>

    <nav class="flex-1 p-3 space-y-1.5 overflow-y-auto">
        
        <a href="{{ route('masyarakat.dashboard') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all group {{ request()->routeIs('masyarakat.dashboard') ? 'bg-emerald-600/10 text-emerald-400 border border-emerald-500/20 font-semibold' : 'font-medium hover:bg-slate-800 text-slate-400 hover:text-white' }}">
            <span class="shrink-0 {{ request()->routeIs('masyarakat.dashboard') ? 'text-emerald-400' : 'text-slate-400 group-hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>
            </span>
            <span x-show="sidebarExpanded" x-transition:opacity class="whitespace-nowrap">Dashboard Utama</span>
        </a>

        <!-- Menu Tambahan: Cari Pengepul Terdekat -->
<a href="{{ route('masyarakat.pengepul.terdekat') }}" 
   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all group {{ request()->routeIs('masyarakat.pengepul.terdekat') ? 'bg-emerald-600/10 text-emerald-400 border border-emerald-500/20 font-semibold' : 'font-medium hover:bg-slate-800 text-slate-400 hover:text-white' }}">
    <span class="shrink-0 {{ request()->routeIs('masyarakat.pengepul.terdekat') ? 'text-emerald-400' : 'text-slate-400 group-hover:text-white' }}">
        <!-- Ikon Peta / Navigasi Pin Lokasi -->
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
        </svg>
    </span>
    <span x-show="sidebarExpanded" class="whitespace-nowrap">Cari Pengepul</span>
</a>

        <a href="{{ route('masyarakat.setoran.create') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all group {{ request()->routeIs('masyarakat.setoran.create') ? 'bg-emerald-600/10 text-emerald-400 border border-emerald-500/20 font-semibold' : 'font-medium hover:bg-slate-800 text-slate-400 hover:text-white' }}">
            <span class="shrink-0 {{ request()->routeIs('masyarakat.setoran.create') ? 'text-emerald-400' : 'text-slate-400 group-hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                </svg>
            </span>
            <span x-show="sidebarExpanded" class="whitespace-nowrap">Penyetoran</span>
        </a>

        <a href="{{ route('masyarakat.riwayat') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all group {{ request()->routeIs('masyarakat.riwayat') ? 'bg-emerald-600/10 text-emerald-400 border border-emerald-500/20 font-semibold' : 'font-medium hover:bg-slate-800 text-slate-400 hover:text-white' }}">
            <span class="shrink-0 {{ request()->routeIs('masyarakat.riwayat') ? 'text-emerald-400' : 'text-slate-400 group-hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </span>
            <span x-show="sidebarExpanded" class="whitespace-nowrap">Riwayat Setoran</span>
        </a>

    </nav>

    <div class="p-3 border-t border-slate-800 bg-slate-950/50 hidden md:block">
        <button @click="sidebarExpanded = !sidebarExpanded" class="w-full flex items-center justify-center p-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white transition-colors">
            <svg class="w-5 h-5 transition-transform duration-300" :class="!sidebarExpanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="m18.75 19.5-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
            </svg>
        </button>
    </div>
</aside>