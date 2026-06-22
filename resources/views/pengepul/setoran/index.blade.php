<x-app-layout>
    <div x-data="{ openModal: false, actionUrl: '', namaWarga: '', estimasi: 0, tglJemput: '' }" class="p-6 sm:p-8 bg-slate-900 text-slate-100 min-h-screen">
        <div class="max-w-6xl mx-auto space-y-6">
            
            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 p-4 rounded-xl text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-white tracking-tight">Setoran Minyak Masyarakat</h2>
                    <p class="text-sm text-slate-400 mt-1">Validasi kuantitas bersih, kadar endapan, dan konfirmasi pembayaran langsung di sini.</p>
                </div>
                <div class="bg-slate-950 border border-slate-800 px-5 py-2.5 rounded-xl text-center min-w-[150px]">
                    <span class="block text-[10px] uppercase font-bold text-slate-500 tracking-wider">Total Stok Siap Kirim</span>
                    <span class="text-lg font-bold text-emerald-400 block mt-0.5">
                        {{ number_format($totalStok, 2, ',', '.') }} L
                    </span>
                </div>
            </div>

            <hr class="border-slate-800">

            <div class="bg-slate-950 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
                <div class="px-6 py-4 border-b border-slate-800 bg-slate-950">
                    <h3 class="font-semibold text-white text-sm flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-amber-500 {{ $antreanSetoran->count() > 0 ? 'animate-pulse' : '' }}"></span>
                        Antrean Masuk ({{ $antreanSetoran->count() }})
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-300">
                        <thead class="bg-slate-900 text-[11px] uppercase tracking-wider font-bold text-slate-400 border-b border-slate-800">
                            <tr>
                                <th class="px-6 py-3.5">Nama Penyetor</th>
                                <th class="px-6 py-3.5">Rencana Penjemputan</th>
                                <th class="px-6 py-3.5">Estimasi Awal</th>
                                <th class="px-6 py-3.5">Status Sistem</th>
                                <th class="px-6 py-3.5 text-center">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60">
                            @forelse($antreanSetoran as $setoran)
                                <tr class="hover:bg-slate-900/40 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-white">{{ $setoran->masyarakat->name ?? 'Warga Anonim' }}</div>
                                        <div class="text-xs text-slate-500">{{ $setoran->masyarakat->email ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-400">
                                        {{ $setoran->tanggal_penjemputan ? $setoran->tanggal_penjemputan->translatedFormat('d M Y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-white">
                                        {{ number_format($setoran->liter_estimasi, 2, ',', '.') }} Liter
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/20 uppercase tracking-wide">
                                            {{ $setoran->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <button 
                                            @click="
                                                openModal = true; 
                                                actionUrl = '{{ route('pengepul.setoran.simpan-uji', $setoran->id) }}';
                                                namaWarga = '{{ $setoran->masyarakat->name }}';
                                                estimasi = {{ $setoran->liter_estimasi }};
                                                tglJemput = '{{ $setoran->tanggal_penjemputan ? $setoran->tanggal_penjemputan->translatedFormat('d F Y') : '-' }}';
                                            "
                                            class="inline-flex items-center justify-center px-4 py-1.5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white text-xs font-bold rounded-lg transition-all shadow-sm"
                                        >
                                            Uji & Validasi
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-500 italic">
                                        Gudang bersih! Belum ada permintaan setoran baru dari masyarakat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div 
            x-show="openModal" 
            class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            x-cloak
        >
            <div @click.away="openModal = false" class="bg-slate-950 border border-slate-800 w-full max-w-xl rounded-2xl overflow-hidden shadow-2xl space-y-6 p-6 relative">
                
                <button @click="openModal = false" class="absolute top-4 right-4 text-slate-400 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                <div>
                    <h3 class="text-xl font-bold text-white tracking-tight">Form Uji Fisik & Lab Minyak</h3>
                    <p class="text-xs text-slate-400 mt-1">Mengukur kuantitas riil setoran milik: <span class="text-emerald-400 font-semibold" x-text="namaWarga"></span></p>
                </div>

                <div class="grid grid-cols-2 gap-4 bg-slate-900/60 p-4 rounded-xl border border-slate-800/80 text-sm">
                    <div>
                        <span class="text-[10px] block uppercase text-slate-500 font-bold tracking-wider">Klaim Awal Warga</span>
                        <span class="text-base font-bold text-white" x-text="estimasi + ' Liter'"></span>
                    </div>
                    <div>
                        <span class="text-[10px] block uppercase text-slate-500 font-bold tracking-wider">Rencana Penjemputan</span>
                        <span class="text-slate-300 font-medium text-xs pt-1 block" x-text="tglJemput"></span>
                    </div>
                </div>

                <form :action="actionUrl" method="POST" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label for="liter_bersih" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Volume Bersih Hasil Timbangan (Liter)</label>
                        <input type="number" step="0.01" name="liter_bersih" id="liter_bersih" :max="estimasi" required
                            class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500 transition-colors placeholder-slate-600"
                            placeholder="Contoh: 24.50">
                        <p class="text-[10px] text-slate-500 mt-1.5">*Volume bersih maksimal tidak boleh melebihi klaim awal warga.</p>
                    </div>

                    <div>
                        <label for="endapan" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Kadar Endapan / Ampas Kotoran (Liter)</label>
                        <input type="number" step="0.01" name="endapan" id="endapan" required
                            class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500 transition-colors placeholder-slate-600"
                            placeholder="Contoh: 0.35">
                    </div>

                    <div class="flex items-center gap-3 pt-4">
                        <button type="button" @click="openModal = false" class="w-1/3 bg-slate-900 hover:bg-slate-800 border border-slate-800 text-slate-300 text-sm font-semibold py-3 rounded-xl transition-all">
                            Batal
                        </button>
                        <button type="submit" class="w-2/3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white text-sm font-bold py-3 rounded-xl transition-all shadow-md">
                            Simpan & Selesaikan
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</x-app-layout>