<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <h2 class="font-bold text-xl text-slate-800 leading-tight flex items-center gap-2">
                <span class="p-1.5 bg-indigo-100 text-indigo-700 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z" />
                    </svg>
                </span>
                Dashboard Eksekutif PT HEN
            </h2>
            <div class="text-xs bg-slate-100 text-slate-600 px-3 py-1.5 rounded-xl font-medium border border-slate-200">
                Aktor: <span class="text-indigo-700 font-bold uppercase">Stakeholder</span>
            </div>
        </div>
    </x-slot>

    @if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3 text-sm font-medium">
        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.656 48.656 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3M3 12a9 9 0 1118 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Volume Bersih SAF</p>
                <h3 class="text-xl font-extrabold text-slate-800 mt-0.5">{{ number_format($totalMinyakSelesai, 1) }} L</h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="p-3 bg-amber-50 text-amber-600 rounded-xl shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Butuh Uji Lab</p>
                <h3 class="text-xl font-extrabold text-slate-800 mt-0.5">{{ $antreanKendaliMutu }} Batch</h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-xl shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.214.122a6.409 6.409 0 002.507.642c.16 0 .321-.004.478-.013A6.431 6.431 0 0015 14.978c0-2.434-2.197-2.308-4.22-2.544C8.75 12.182 6.75 12.03 6.75 10.02c0-1.819 1.636-2.923 3.75-3.13V4.5m4.22 13.82V18.75m3.75-14.25v14.25" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Dana Cair</p>
                <h3 class="text-xl font-extrabold text-slate-800 mt-0.5">Rp {{ number_format($totalPengeluaranInsentif, 0, ',', '.') }}</h3>
            </div>
        </div>

        <div class="bg-gradient-to-br from-indigo-900 to-indigo-950 p-5 rounded-2xl text-white shadow-md flex items-center gap-4 border border-indigo-800">
            <div class="p-3 bg-indigo-500/20 text-indigo-300 rounded-xl shrink-0 border border-indigo-500/30">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 21l8.954-8.955M21 12h0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <div class="flex items-center gap-1">
                    <p class="text-[10px] font-bold text-indigo-300 uppercase tracking-wider">Prediksi AI Kebutuhan Dana</p>
                    <span class="bg-indigo-500 text-[8px] font-extrabold px-1 rounded text-white">ML</span>
                </div>
                <h3 class="text-base font-black text-white mt-0.5">Rp {{ number_format($prediksiDanaBulanDepan, 0, ',', '.') }}</h3>
                <p class="text-[9px] text-indigo-300/70 italic">*Periode Depan (Regresi Linier)</p>
            </div>
        </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-sm mb-8">
        <h3 class="text-sm font-bold mb-3 uppercase tracking-wider flex items-center gap-1.5 text-slate-500">
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            Akses Cepat Fitur Ruang Kerja Stakeholder
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            
            <a href="#tabel-kendali-mutu" class="group p-4 bg-slate-50 hover:bg-indigo-50 border border-slate-200 hover:border-indigo-200 rounded-2xl transition-all flex items-start gap-3">
                <div class="p-2.5 bg-white group-hover:bg-indigo-100 text-slate-600 group-hover:text-indigo-700 rounded-xl border border-slate-200 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-800 group-hover:text-indigo-900">Kendali Mutu (Uji Lab)</h4>
                    <p class="text-xs text-slate-500 mt-0.5">Periksa kadar air, FFA, dan tentukan grade penerimaan avtur.</p>
                </div>
            </a>

            <a href="{{ route('stakeholder.audit') }}" class="group p-4 bg-slate-50 hover:bg-blue-50 border border-slate-200 hover:border-blue-200 rounded-2xl transition-all flex items-start gap-3">
                <div class="p-2.5 bg-white group-hover:bg-blue-100 text-slate-600 group-hover:text-blue-700 rounded-xl border border-slate-200 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2Z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-800 group-hover:text-blue-900">Laporan Audit Pasokan</h4>
                    <p class="text-xs text-slate-500 mt-0.5">Rekap log volume bersih sirkular minyak untuk pelaporan juri.</p>
                </div>
            </a>
        </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden shadow-sm mb-8">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between flex-wrap gap-2">
            <div>
                <h3 class="text-base font-bold text-slate-900">Peta Penyebaran Rantai Pasok Wilayah</h3>
                <p class="text-xs text-slate-500 mt-0.5">Monitoring visual lokasi sebaran Pengepul dan Penyetor menggunakan sistem penanda berkode warna.</p>
            </div>
            <div class="flex items-center gap-3 text-xs bg-slate-50 px-3 py-1.5 rounded-xl border border-slate-200">
                <div class="flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-indigo-600 inline-block"></span>
                    <span class="font-medium text-slate-600">Hub Pengepul</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500 inline-block"></span>
                    <span class="font-medium text-slate-600">Masyarakat/Penyetor</span>
                </div>
            </div>
        </div>
        <div class="p-4">
            <div id="petaSirkularMinyak" class="w-full rounded-2xl border border-slate-200 shadow-inner" style="height: 380px; z-index: 1;"></div>
        </div>
    </div>

    <div id="tabel-kendali-mutu" class="bg-white border border-slate-200 rounded-3xl overflow-hidden shadow-sm">
        <div class="p-6 border-b border-slate-100">
            <h3 class="text-base font-bold text-slate-900">Arus Verifikasi Batch & Kelayakan Mutu</h3>
            <p class="text-xs text-slate-500 mt-0.5">Daftar transaksi masuk yang dikirim oleh pengepul untuk divalidasi kualitas laboratoriumnya sebelum dicairkan menjadi SAF.</p>
        </div>
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-[11px] font-bold uppercase tracking-wider border-b border-slate-100">
                        <th class="py-3 px-6">Pelaku Rantai Pasok</th>
                        <th class="py-3 px-6">Tanggal Ambil</th>
                        <th class="py-3 px-6 text-right">Volume / Nominal</th>
                        <th class="py-3 px-6 text-center">Hasil Uji Lab SAF (Kadar Air | FFA | Kotoran)</th>
                        <th class="py-3 px-6 text-center">Status Mutu</th>
                        <th class="py-3 px-6 text-center">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse($semuaSetoran as $row)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex flex-col">
                                <span class="font-bold text-slate-900">{{ $row->pengepul->name ?? 'Pengepul Lapangan' }}</span>
                                <span class="text-xs text-slate-400">Penyetor asal: {{ $row->masyarakat->name ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-slate-500 text-xs">
                            {{ $row->tanggal_penjemputan ? $row->tanggal_penjemputan->translatedFormat('d M Y') : '-' }}
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="font-bold text-slate-900">{{ number_format($row->liter_bersih ?? $row->liter_estimasi, 1) }} L</div>
                            <div class="text-[11px] text-slate-400 font-medium">Rp {{ number_format($row->harga_dibayar, 0, ',', '.') }}</div>
                        </td>
                        <td class="py-4 px-6 text-center">
                            @if(is_null($row->kadar_air))
                                <span class="text-xs text-slate-400 italic bg-slate-100 px-2 py-0.5 rounded">Belum Diuji</span>
                            @else
                                <div class="inline-flex gap-1.5 text-[11px] font-mono">
                                    <span class="bg-blue-50 text-blue-700 px-1.5 rounded border border-blue-100">H2O: {{ $row->kadar_air }}%</span>
                                    <span class="bg-purple-50 text-purple-700 px-1.5 rounded border border-purple-100">FFA: {{ $row->ffa }}%</span>
                                    <span class="bg-amber-50 text-amber-700 px-1.5 rounded border border-amber-100">Imp: {{ $row->kotoran }}%</span>
                                </div>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-center">
                            @if($row->status === 'proses')
                                <span class="px-2.5 py-0.5 text-[11px] font-bold rounded-full bg-amber-100 text-amber-800 animate-pulse">Butuh Uji Lab</span>
                            @elseif($row->status === 'selesai')
                                <div class="flex flex-col items-center">
                                    <span class="px-2.5 py-0.5 text-[11px] font-bold rounded-full bg-emerald-100 text-emerald-800">Lolos</span>
                                    <span class="text-[10px] text-slate-500 font-bold mt-0.5">{{ $row->grade }}</span>
                                </div>
                            @elseif($row->status === 'ditolak')
                                <span class="px-2.5 py-0.5 text-[11px] font-bold rounded-full bg-rose-100 text-rose-800">Ditolak</span>
                            @else
                                <span class="px-2.5 py-0.5 text-[11px] font-medium rounded-full bg-slate-100 text-slate-500">Pending</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-center">
                            @if($row->status === 'proses')
                                <a href="{{ route('stakeholder.lab.edit', $row->id) }}" class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-all shadow-sm">
                                    Uji Lab
                                </a>
                            @else
                                <span class="text-xs text-slate-400 italic">Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-xs text-slate-400 italic">Belum ada rekaman sirkular pasokan minyak masuk ke sistem.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var mapSirkular = L.map('petaSirkularMinyak').setView([-7.5666, 110.8166], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(mapSirkular);

        var penandaPengepul = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-indigo.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34], shadowSize: [41, 41]
        });

        var penandaPenyetor = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-orange.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34], shadowSize: [41, 41]
        });

        var penandaRekomendasiAI = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34], shadowSize: [41, 41]
        });

        var dataPengepul = @json($titikPetaPengepul);
        dataPengepul.forEach(function (hub) {
            if(hub.latitude && hub.longitude) {
                L.marker([hub.latitude, hub.longitude], {icon: penandaPengepul})
                 .addTo(mapSirkular)
                 .bindPopup("<div class='font-sans'><b class='text-slate-900 text-sm'>" + hub.name + "</b><br><span class='text-[10px] text-indigo-600 font-bold uppercase'>📍 HUB PENGEPUL AGEN</span></div>");
            }
        });

        var dataMasyarakat = @json($titikPetaMasyarakat);
        dataMasyarakat.forEach(function (warga) {
            if(warga.latitude && warga.longitude) {
                L.marker([warga.latitude, warga.longitude], {icon: penandaPenyetor})
                 .addTo(mapSirkular)
                 .bindPopup("<div class='font-sans'><b class='text-slate-900 text-sm'>" + warga.name + "</b><br><span class='text-[10px] text-amber-600 font-bold uppercase'>🏠 PENYETOR / WARGA</span></div>");
            }
        });

        var rekomendasiAI = @json($titikRekomendasiHub);
        if(rekomendasiAI && rekomendasiAI.latitude && rekomendasiAI.longitude) {
            L.marker([rekomendasiAI.latitude, rekomendasiAI.longitude], {icon: penandaRekomendasiAI})
             .addTo(mapSirkular)
             .bindPopup("<div class='font-sans text-center'><span class='bg-rose-100 text-rose-700 px-2 py-0.5 rounded text-[10px] font-black tracking-wider uppercase'>💡 REKOMENDASI EKSPANSI AI</span>" +
                        "<p class='text-xs text-slate-700 font-bold mt-1.5'>Titik Tengah Centroid Strategis</p>" +
                        "<p class='text-[11px] text-slate-500 mt-0.5'>Mencakup " + rekomendasiAI.total_penyetor_sekitar + " penyetor aktif sekitar.</p></div>");
        }
    });
</script>