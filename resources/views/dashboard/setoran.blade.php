<x-app-layout>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    
    <div x-data="{ openFormModal: false, selectedPengepulId: '', selectedPengepulName: '', selectedHarga: '' }" 
         class="p-6 max-w-7xl mx-auto space-y-6 bg-gray-50 min-h-screen text-gray-800 relative overflow-x-hidden">
        
        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-emerald-700 bg-emerald-50 rounded-xl border border-emerald-200 flex items-center gap-2 animate-fade-in">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between border-b border-gray-200 pb-5 gap-4">
            <div class="flex-1 min-w-0">
                <h2 class="text-xl font-bold text-gray-900 tracking-tight flex items-center gap-2">
                    <svg class="w-6 h-6 text-emerald-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    <span class="truncate">Radar Pengepul & Pengajuan Penyetoran</span>
                </h2>
                <p class="text-xs text-gray-500 mt-1 break-words">Cari mitra hub terdekat, pantau harga acuan, dan lakukan reservasi pengiriman langsung dari satu panel terintegrasi.</p>
            </div>
            
            <div class="flex flex-wrap sm:flex-nowrap items-center gap-2.5 w-full lg:w-auto justify-start sm:justify-end shrink-0">
                <div id="gps-status" class="flex items-center gap-2 px-3 py-1.5 bg-amber-50 border border-amber-200 text-amber-700 text-xs rounded-xl font-medium shadow-sm whitespace-nowrap">
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse shrink-0"></span>
                    Memeriksa Parameter Lokasi...
                </div>

                <a href="{{ route('masyarakat.riwayat') }}" 
                   class="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 bg-white border border-gray-200 hover:border-gray-300 text-gray-600 hover:text-gray-900 text-xs rounded-xl font-medium shadow-sm transition-all whitespace-nowrap hover:bg-gray-50 active:scale-95">
                    <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Riwayat Saya
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            <div class="lg:col-span-5 sticky top-24">
                <div class="bg-white p-3 rounded-2xl border border-gray-200 shadow-sm space-y-3">
                    <div class="flex items-center justify-between px-1">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-400 flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 inline-block"></span> Live Radar View
                        </span>
                    </div>
                    <div id="map" class="w-full rounded-xl border border-gray-100 shadow-inner" style="height: 480px; position: relative; z-index: 1;"></div>
                </div>
            </div>

            <div class="lg:col-span-7 space-y-4 max-h-[540px] overflow-y-auto pr-2 custom-scrollbar">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($daftarPengepul as $pengepul)
                        <div class="bg-white border border-gray-200 hover:border-emerald-500/50 rounded-2xl p-5 transition-all duration-300 shadow-sm flex flex-col justify-between group cursor-pointer evaluation-card"
                             data-lat="{{ $pengepul->latitude ?? 0 }}" 
                             data-lng="{{ $pengepul->longitude ?? 0 }}"
                             data-name="{{ $pengepul->name }}">
                            <div>
                                <div class="flex items-start justify-between gap-2">
                                    <div class="p-2 bg-gray-50 group-hover:bg-emerald-50 text-gray-500 group-hover:text-emerald-600 rounded-xl border border-gray-200 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h18v3.75H3V3Z" />
                                        </svg>
                                    </div>
                                    <span class="px-2.5 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-lg border border-emerald-200">
                                        {{ number_format($pengepul->jarak, 2) }} Km
                                    </span>
                                </div>

                                <div class="mt-4">
                                    <h3 class="text-base font-bold text-gray-900 group-hover:text-emerald-600 transition-colors">{{ $pengepul->name }}</h3>
                                    <p class="text-xs text-gray-500 mt-1 truncate">
                                        {{ $pengepul->alamat ?? 'Alamat Hub Terdaftar' }}
                                    </p>
                                </div>

                                <div class="mt-5 p-3 bg-gray-50 border border-gray-100 rounded-xl flex items-center justify-between">
                                    <span class="text-[10px] uppercase font-bold tracking-wider text-gray-400">Harga Beli Hub</span>
                                    <span class="text-sm font-black text-emerald-600">Rp {{ number_format($pengepul->harga_per_liter ?? 10000, 0, ',', '.') }}<span class="text-[10px] text-gray-400 font-normal">/L</span></span>
                                </div>
                            </div>

                            <div class="mt-5 pt-4 border-t border-gray-100">
                                <button type="button"
                                        @click.stop="
                                            openFormModal = true;
                                            selectedPengepulId = '{{ $pengepul->id }}';
                                            selectedPengepulName = '{{ $pengepul->name }}';
                                            selectedHarga = '{{ number_format($pengepul->harga_per_liter ?? 10000, 0, ',', '.') }}';
                                        "
                                        class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-all shadow-sm">
                                    Setor ke Hub Ini
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full bg-white border border-gray-200 p-12 text-center rounded-2xl">
                            <p class="text-sm text-gray-400 italic">Tidak ada agen pengepul terdaftar dalam jangkauan radar GPS.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div x-show="openFormModal" 
             class="fixed inset-0 z-50 flex justify-end" 
             style="display: none;"
             x-transition:enter="transition ease-in-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in-out duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="openFormModal = false"></div>

            <div class="relative w-full max-w-md bg-white h-full shadow-2xl p-6 flex flex-col justify-between z-10 transform"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full">
                
                <div>
                    <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Formulir Pengajuan Setoran</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Lengkapi volume estimasi logistik pengumpulan.</p>
                        </div>
                        <button @click="openFormModal = false" class="p-1.5 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <div class="mt-4 p-4 bg-emerald-50/50 border border-emerald-100 rounded-xl space-y-1">
                        <span class="text-[10px] uppercase font-bold text-emerald-700 tracking-wider">Hub Target Terpilih</span>
                        <h4 class="text-sm font-bold text-gray-900" x-text="selectedPengepulName"></h4>
                        <p class="text-xs text-emerald-600 font-semibold">Tarif Kontrak Aktif: Rp <span x-text="selectedHarga"></span>/Liter</p>
                    </div>

                    <form id="form-setoran" action="{{ route('masyarakat.setoran.store') }}" method="POST" class="mt-5 space-y-4">
                        @csrf
                        <input type="hidden" name="pengepul_id" :value="selectedPengepulId">

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Estimasi Volume (Liter)</label>
                            <div class="relative rounded-xl shadow-sm">
                                <input type="number" min="1" step="any" name="liter_estimasi" required
                                       class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:border-emerald-500 focus:bg-white focus:ring-0 transition-all" 
                                       placeholder="Contoh: 15">
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <span class="text-xs text-gray-400 font-bold">LITER</span>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Tanggal Drop/Jemput</label>
                                <input type="date" name="tanggal_penjemputan" id="tgl_input" required
                                       class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:border-emerald-500 focus:bg-white focus:ring-0 transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5">Jam Operasional (Time)</label>
                                <input type="time" name="jam_penjemputan" required
                                       class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:border-emerald-500 focus:bg-white focus:ring-0 transition-all">
                            </div>
                        </div>
                        <p class="text-[10px] text-gray-400">Pilih jam kedatangan agar alur antrean filtrasi di tangki pengepul teralokasi transparan.</p>
                    </form>
                </div>

                <div class="border-t border-gray-100 pt-4 flex gap-3">
                    <button type="button" @click="openFormModal = false"
                            class="flex-1 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition-colors">
                        Batal
                    </button>
                    <button type="submit" form="form-setoran"
                            class="flex-1 px-4 py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white text-xs font-bold rounded-xl shadow-md transition-all">
                        Kirim Pengajuan
                    </button>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tgl_input').setAttribute('min', today);

            const urlParams = new URLSearchParams(window.location.search);
            const statusGps = document.getElementById('gps-status');

            const hasLatParam = urlParams.has('lat');
            const hasLngParam = urlParams.has('lng');

            const userLat = parseFloat(urlParams.get('lat')) || -7.5666; 
            const userLng = parseFloat(urlParams.get('lng')) || 110.8166;

            const map = L.map('map').setView([userLat, userLng], 12);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(map);

            setTimeout(() => { map.invalidateSize(); }, 300);

            const userIcon = L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34], shadowSize: [41, 41]
            });

            const pengepulIcon = L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34], shadowSize: [41, 41]
            });

            if (hasLatParam && hasLngParam) {
                L.marker([userLat, userLng], {icon: userIcon}).addTo(map)
                    .bindPopup("<b class='text-xs font-sans'>📍 Posisi Anda Terkunci</b>").openPopup();
                
                if (statusGps) {
                    statusGps.className = "flex items-center gap-2 px-3 py-1.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs rounded-xl font-medium shadow-sm whitespace-nowrap";
                    statusGps.innerHTML = '<span class="w-2 h-2 rounded-full bg-emerald-500 shrink-0"></span> Koordinat Terpetakan';
                }
            }

            const markers = [];
            @foreach($daftarPengepul as $p)
                @if($p->latitude && $p->longitude)
                    (function() {
                        const pLat = {{ $p->latitude }};
                        const pLng = {{ $p->longitude }};
                        const pName = "{{ $p->name }}";
                        const pJarak = "{{ number_format($p->jarak, 2) }}";

                        const marker = L.marker([pLat, pLng], {icon: pengepulIcon}).addTo(map)
                            .bindPopup(`<div class='font-sans text-xs'><b class='text-emerald-600'>${pName}</b><br>Jarak: ${pJarak} Km</div>`);
                        
                        markers.push({ lat: pLat, lng: pLng, marker: marker });
                    })();
                @endif
            @endforeach

            document.querySelectorAll('.evaluation-card').forEach(card => {
                card.addEventListener('click', function() {
                    const lat = parseFloat(this.getAttribute('data-lat'));
                    const lng = parseFloat(this.getAttribute('data-lng'));
                    if(lat && lng) {
                        map.setView([lat, lng], 14, { animate: true, duration: 1 });
                        const target = markers.find(m => m.lat === lat && m.lng === lng);
                        if(target) target.marker.openPopup();
                    }
                });
            });

            if (!hasLatParam || !hasLngParam) {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function (position) {
                            window.location.href = `?lat=${position.coords.latitude}&lng=${position.coords.longitude}`;
                        },
                        function (error) {
                            if (statusGps) {
                                statusGps.className = "flex items-center gap-2 px-3 py-1.5 bg-gray-100 border border-gray-200 text-gray-500 text-xs rounded-xl font-medium shadow-sm whitespace-nowrap";
                                statusGps.innerHTML = '<span class="w-2 h-2 rounded-full bg-gray-400 shrink-0"></span> Lokasi Default (GPS Off)';
                            }
                        }
                    );
                }
            }
        });
    </script>

    <style>
        .leaflet-container img { max-width: none !important; height: auto !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</x-app-layout>