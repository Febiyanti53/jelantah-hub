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
        
        {{-- ==================== MENU ROLE: MASYARAKAT ==================== --}}
        @if(Auth::user()->role === 'masyarakat')
            
            <a href="{{ route('masyarakat.dashboard') }}" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all group {{ request()->routeIs('masyarakat.dashboard') ? 'bg-emerald-600/10 text-emerald-400 border border-emerald-500/20 font-semibold' : 'font-medium hover:bg-slate-800 text-slate-400 hover:text-white' }}">
                <span class="shrink-0 {{ request()->routeIs('masyarakat.dashboard') ? 'text-emerald-400' : 'text-slate-400 group-hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                    </svg>
                </span>
                <span x-show="sidebarExpanded" class="whitespace-nowrap">Dashboard Utama</span>
            </a>

            <a href="{{ route('masyarakat.pengepul.terdekat') }}" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all group {{ request()->routeIs('masyarakat.pengepul.terdekat') ? 'bg-emerald-600/10 text-emerald-400 border border-emerald-500/20 font-semibold' : 'font-medium hover:bg-slate-800 text-slate-400 hover:text-white' }}">
                <span class="shrink-0 {{ request()->routeIs('masyarakat.pengepul.terdekat') ? 'text-emerald-400' : 'text-slate-400 group-hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                </span>
                <span x-show="sidebarExpanded" class="whitespace-nowrap">Cari Pengepul</span>
            </a>

            <!-- <a href="{{ route('masyarakat.setoran.create') }}" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all group {{ request()->routeIs('masyarakat.setoran.create') ? 'bg-emerald-600/10 text-emerald-400 border border-emerald-500/20 font-semibold' : 'font-medium hover:bg-slate-800 text-slate-400 hover:text-white' }}">
                <span class="shrink-0 {{ request()->routeIs('masyarakat.setoran.create') ? 'text-emerald-400' : 'text-slate-400 group-hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                    </svg>
                </span>
                <span x-show="sidebarExpanded" class="whitespace-nowrap">Penyetoran</span>
            </a> -->

            <a href="{{ route('masyarakat.riwayat') }}" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all group {{ request()->routeIs('masyarakat.riwayat') ? 'bg-emerald-600/10 text-emerald-400 border border-emerald-500/20 font-semibold' : 'font-medium hover:bg-slate-800 text-slate-400 hover:text-white' }}">
                <span class="shrink-0 {{ request()->routeIs('masyarakat.riwayat') ? 'text-emerald-400' : 'text-slate-400 group-hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </span>
                <span x-show="sidebarExpanded" class="whitespace-nowrap">Riwayat Setoran</span>
            </a>

       {{-- ==================== MENU ROLE: PENGEPUL ==================== --}}
@elseif(Auth::user()->role === 'pengepul')

    <a href="{{ route('pengepul.dashboard') }}" 
       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all group {{ request()->routeIs('pengepul.dashboard') ? 'bg-emerald-600/10 text-emerald-400 border border-emerald-500/20 font-semibold' : 'font-medium hover:bg-slate-800 text-slate-400 hover:text-white' }}">
        <span class="shrink-0 {{ request()->routeIs('pengepul.dashboard') ? 'text-emerald-400' : 'text-slate-400 group-hover:text-white' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
            </svg>
        </span>
        <span x-show="sidebarExpanded" class="whitespace-nowrap">Dashboard Pengepul</span>
    </a>

    <a href="{{ route('pengepul.harga.index') }}" 
       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all group {{ request()->routeIs('pengepul.harga.*') ? 'bg-emerald-600/10 text-emerald-400 border border-emerald-500/20 font-semibold' : 'font-medium hover:bg-slate-800 text-slate-400 hover:text-white' }}">
        <span class="shrink-0 {{ request()->routeIs('pengepul.harga.*') ? 'text-emerald-400' : 'text-slate-400 group-hover:text-white' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </span>
        <span x-show="sidebarExpanded" class="whitespace-nowrap">Atur Harga Beli</span>
    </a>

    <a href="{{ route('pengepul.setoran.index') }}" 
       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all group {{ request()->routeIs('pengepul.setoran.*') ? 'bg-emerald-600/10 text-emerald-400 border border-emerald-500/20 font-semibold' : 'font-medium hover:bg-slate-800 text-slate-400 hover:text-white' }}">
        <span class="shrink-0 {{ request()->routeIs('pengepul.setoran.*') ? 'text-emerald-400' : 'text-slate-400 group-hover:text-white' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2Z" />
            </svg>
        </span>
        <span x-show="sidebarExpanded" class="flex-1 flex items-center justify-between whitespace-nowrap">
            <span>Setoran Masyarakat</span>
        </span>
    </a>

    <a href="{{ route('pengepul.pengiriman.create') }}" 
       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all group {{ request()->routeIs('pengepul.pengiriman.create') ? 'bg-emerald-600/10 text-emerald-400 border border-emerald-500/20 font-semibold' : 'font-medium hover:bg-slate-800 text-slate-400 hover:text-white' }}">
        <span class="shrink-0 {{ request()->routeIs('pengepul.pengiriman.create') ? 'text-emerald-400' : 'text-slate-400 group-hover:text-white' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0ZM19.5 18.75a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m-7.408-3.75a3 3 0 0 0-5.592 0M13.5 10.5H21V14.25M13.5 10.5V7.5H4.5v11.25m11.25-1.125h.008v.008h-.008V17.25Zm3.75 0h.008v.008h-.008V17.25Z" />
            </svg>
        </span>
        <span x-show="sidebarExpanded" class="whitespace-nowrap">Kirim ke PT HEN</span>
    </a>

    <a href="{{ route('pengepul.pengiriman.index') }}" 
       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all group {{ request()->routeIs('pengepul.pengiriman.index') ? 'bg-emerald-600/10 text-emerald-400 border border-emerald-500/20 font-semibold' : 'font-medium hover:bg-slate-800 text-slate-400 hover:text-white' }}">
        <span class="shrink-0 {{ request()->routeIs('pengepul.pengiriman.index') ? 'text-emerald-400' : 'text-slate-400 group-hover:text-white' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v1.243m4.5-1.243v1.243M3.878 19.122A12.04 12.04 0 0 1 12 18c2.907 0 5.56.1.037.3l.972.1-.215 1.132A10.5 10.5 0 1 0 12 3a10.5 10.5 0 0 0-8.122 16.122Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5v4.5m0 0 3 3m-3-3-3 3" />
            </svg>
        </span>
        <span x-show="sidebarExpanded" class="whitespace-nowrap">Riwayat & Hasil Lab</span>
    </a>

        {{-- ==================== MENU ROLE: ADMIN ==================== --}}
        @else

            <a href="#" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all group font-medium hover:bg-slate-800 text-slate-400 hover:text-white">
                <span class="shrink-0 text-slate-400 group-hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                    </svg>
                </span>
                <span x-show="sidebarExpanded" class="whitespace-nowrap">Panel Admin</span>
            </a>

            <a href="#" 
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all group font-medium hover:bg-slate-800 text-slate-400 hover:text-white">
                <span class="shrink-0 text-slate-400 group-hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                </span>
                <span x-show="sidebarExpanded" class="whitespace-nowrap">Kelola Pengguna</span>
            </a>

        @endif

    </nav>

    <div class="p-3 border-t border-slate-800 bg-slate-950/50 hidden md:block">
        <button @click="sidebarExpanded = !sidebarExpanded" class="w-full flex items-center justify-center p-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white transition-colors">
            <svg class="w-5 h-5 transition-transform duration-300" :class="!sidebarExpanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="m18.75 19.5-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
            </svg>
        </button>
    </div>
</aside>