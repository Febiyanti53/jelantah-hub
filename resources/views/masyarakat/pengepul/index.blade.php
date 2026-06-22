<x-app-layout>
    <div class="p-6 max-w-7xl mx-auto space-y-6 bg-gray-50 min-h-screen text-gray-800">
        
        <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b border-gray-200 pb-5 gap-4">
            <div>
                <h2 class="text-xl font-bold text-gray-900 tracking-tight flex items-center gap-2">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    Zonasi Pengepul Terdekat
                </h2>
                <p class="text-xs text-gray-500 mt-1">Sistem otomatis mendeteksi lokasi Anda dan mengurutkan Hub Pengepul PT HEN dengan jarak terpendek.</p>
            </div>
            
            <div id="gps-status" class="flex items-center gap-2 px-3 py-1.5 bg-amber-50 border border-amber-200 text-amber-700 text-xs rounded-xl font-medium animate-pulse">
                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                Meminta Akses GPS Lokasi Anda...
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($hasilPencarian as $pengepul)
                <div class="bg-white border border-gray-200 hover:border-emerald-500/50 rounded-2xl p-5 transition-all duration-300 shadow-sm flex flex-col justify-between group">
                    <div>
                        <div class="flex items-start justify-between gap-2">
                            <div class="p-2 bg-gray-50 group-hover:bg-emerald-50 text-gray-500 group-hover:text-emerald-600 rounded-xl border border-gray-200 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h18v3.75H3V3Z" />
                                </svg>
                            </div>
                            <span class="px-2.5 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-lg border border-emerald-200">
                                {{ $pengepul->jarak }} Km dari Anda
                            </span>
                        </div>

                        <div class="mt-4">
                            <h3 class="text-base font-bold text-gray-900 group-hover:text-emerald-600 transition-colors">{{ $pengepul->name }}</h3>
                            <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                                {{ $pengepul->alamat ?? 'Lokasi Hub Pengepul Terdaftar' }}
                            </p>
                        </div>

                        <div class="mt-5 p-3 bg-gray-50 border border-gray-100 rounded-xl flex items-center justify-between">
                            <span class="text-[10px] uppercase font-bold tracking-wider text-gray-400">Harga Beli Agen</span>
                            <span class="text-sm font-black text-emerald-600">Rp {{ number_format($pengepul->harga_beli ?? 7500, 0, ',', '.') }}<span class="text-[10px] text-gray-400 font-normal">/L</span></span>
                        </div>
                    </div>

                    <div class="mt-5 pt-4 border-t border-gray-100">
                        <a href="{{ route('masyarakat.setoran.create', ['pengepul_id' => $pengepul->id]) }}" 
                           class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-xs font-bold text-gray-700 hover:text-white bg-white hover:bg-emerald-600 rounded-xl border border-gray-200 hover:border-emerald-600 transition-all shadow-sm">
                            Pilih & Setor ke Hub Ini
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white border border-gray-200 p-12 text-center rounded-2xl">
                    <p class="text-sm text-gray-400 italic">Tidak ada agen pengepul terdaftar yang aktif dalam jangkauan radar.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- JAVASCRIPT DETEKSI GPS INTEGRASI DENGAN CONTROLLER --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;

                        // Mengubah status notifikasi visual ke emerald (sukses)
                        const statusGps = document.getElementById('gps-status');
                        statusGps.className = "flex items-center gap-2 px-3 py-1.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs rounded-xl font-medium";
                        statusGps.innerHTML = '<span class="w-2 h-2 rounded-full bg-emerald-500"></span> GPS Terkunci Akurat';

                        const urlParams = new URLSearchParams(window.location.search);
                        if (!urlParams.has('lat') || !urlParams.has('lng')) {
                            window.location.href = `?lat=${lat}&lng=${lng}`;
                        }
                    },
                    function (error) {
                        const statusGps = document.getElementById('gps-status');
                        statusGps.className = "flex items-center gap-2 px-3 py-1.5 bg-gray-100 border border-gray-200 text-gray-500 text-xs rounded-xl font-medium";
                        statusGps.innerHTML = '<span class="w-2 h-2 rounded-full bg-gray-400"></span> Menggunakan Lokasi Default';
                    }
                );
            }
        });
    </script>
</x-app-layout>