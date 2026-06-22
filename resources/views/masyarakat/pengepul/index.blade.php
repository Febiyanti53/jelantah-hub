<x-app-layout>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <div class="p-6 max-w-7xl mx-auto space-y-6 bg-gray-50 min-h-screen text-gray-800">
        
        <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b border-gray-200 pb-5 gap-4">
            <div>
                <h2 class="text-xl font-bold text-gray-900 tracking-tight flex items-center gap-2">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    Radar & Zonasi Pengepul Terdekat
                </h2>
                <p class="text-xs text-gray-500 mt-1">Sistem otomatis memetakan koordinat Anda dan mengurutkan Hub Pengepul dengan jarak terpendek.</p>
            </div>
            
            <div id="gps-status" class="flex items-center gap-2 px-3 py-1.5 bg-amber-50 border border-amber-200 text-amber-700 text-xs rounded-xl font-medium">
                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                Memeriksa Parameter Lokasi...
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            <div class="lg:col-span-5 sticky top-24">
                <div class="bg-white p-3 rounded-2xl border border-gray-200 shadow-sm space-y-3">
                    <div class="flex items-center justify-between px-1">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-400 flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 inline-block"></span> Live Radar View
                        </span>
                        <span class="text-[10px] text-gray-400">Leaflet OpenStreetMap</span>
                    </div>
                    {{-- Perbaikan: Definisikan inline style tinggi & z-index dengan aman --}}
                    <div id="map" class="w-full rounded-xl border border-gray-100 shadow-inner" style="height: 450px; min-height: 450px; position: relative; z-index: 1;"></div>
                </div>
            </div>

            <div class="lg:col-span-7 space-y-4 max-h-[510px] overflow-y-auto pr-2 custom-scrollbar">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($hasilPencarian as $pengepul)
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
                            <p class="text-sm text-gray-400 italic">Tidak ada agen pengepul terdaftar dalam jangkauan radar GPS.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    {{-- INTERAKTIF MAPS & GPS SCRIPT --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const urlParams = new URLSearchParams(window.location.search);
            const statusGps = document.getElementById('gps-status');

            // Ambil dari URL secara langsung, jika tidak ada baru gunakan default Solo/Jogja
            const hasLatParam = urlParams.has('lat');
            const hasLngParam = urlParams.has('lng');

            const userLat = parseFloat(urlParams.get('lat')) || -7.5666; 
            const userLng = parseFloat(urlParams.get('lng')) || 110.8166;

            // 1. Inisialisasi Objek Peta Leaflet
            const map = L.map('map').setView([userLat, userLng], 13);

            // 2. Load ubin OpenStreetMap standar
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(map);

            // Perbaikan CSS Sizing Leaflet Real-time
            setTimeout(() => {
                map.invalidateSize();
            }, 300);

            // Custom Icons setup
            const userIcon = L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            const pengepulIcon = L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            // Tambahkan Pin Utama Pengguna jika parameter URL valid
            if (hasLatParam && hasLngParam) {
                L.marker([userLat, userLng], {icon: userIcon}).addTo(map)
                    .bindPopup("<b class='text-xs font-sans'>📍 Lokasi Anda (Radar Terkunci)</b>").openPopup();
                
                if (statusGps) {
                    statusGps.className = "flex items-center gap-2 px-3 py-1.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs rounded-xl font-medium";
                    statusGps.innerHTML = '<span class="w-2 h-2 rounded-full bg-emerald-500"></span> Koordinat URL Aktif';
                }
            }

            // 3. Looping Data Pengepul ke Map Markers
            const markers = [];
            @foreach($hasilPencarian as $p)
                @if($p->latitude && $p->longitude)
                    (function() {
                        const pLat = {{ $p->latitude }};
                        const pLng = {{ $p->longitude }};
                        const pName = "{{ $p->name }}";
                        const pJarak = "{{ $p->jarak }}";

                        const marker = L.marker([pLat, pLng], {icon: pengepulIcon}).addTo(map)
                            .bindPopup(`<div class='font-sans text-xs'><b class='text-emerald-600'>${pName}</b><br>Jarak: ${pJarak} Km dari Anda</div>`);
                        
                        markers.push({ lat: pLat, lng: pLng, marker: marker });
                    })();
                @endif
            @endforeach

            // Interaksi Klik Kartu List
            document.querySelectorAll('.evaluation-card').forEach(card => {
                card.addEventListener('click', function() {
                    const lat = parseFloat(this.getAttribute('data-lat'));
                    const lng = parseFloat(this.getAttribute('data-lng'));
                    if(lat && lng) {
                        map.setView([lat, lng], 15, { animate: true, duration: 1 });
                        const target = markers.find(m => m.lat === lat && m.lng === lng);
                        if(target) target.marker.openPopup();
                    }
                });
            });

            // 4. LOGIKA GPS BARU: Hanya redirect jika URL benar-benar bersih / kosong dari parameter lat-lng
            if (!hasLatParam || !hasLngParam) {
                if (navigator.geolocation) {
                    if (statusGps) statusGps.innerHTML = '<span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span> Mencari GPS Browser...';
                    
                    navigator.geolocation.getCurrentPosition(
                        function (position) {
                            const lat = position.coords.latitude;
                            const lng = position.coords.longitude;
                            // Redirect sekali saja karena parameter sebelumnya kosong
                            window.location.href = `?lat=${lat}&lng=${lng}`;
                        },
                        function (error) {
                            if (statusGps) {
                                statusGps.className = "flex items-center gap-2 px-3 py-1.5 bg-gray-100 border border-gray-200 text-gray-500 text-xs rounded-xl font-medium";
                                statusGps.innerHTML = '<span class="w-2 h-2 rounded-full bg-gray-400"></span> Menggunakan Lokasi Default';
                            }
                        }
                    );
                }
            }
        });
    </script>

    <style>
        /* Mengatasi konflik reset CSS Tailwind global */
        .leaflet-container img {
            max-width: none !important;
            height: auto !important;
        }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</x-app-layout>