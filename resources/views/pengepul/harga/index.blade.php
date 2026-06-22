<x-app-layout>
    <div class="p-6 sm:p-10 bg-slate-950 text-slate-100 min-h-screen selection:bg-emerald-500 selection:text-slate-900">
        <div class="max-w-4xl mx-auto space-y-8">
            
            <div class="relative py-2">
                <div class="absolute -left-4 top-0 bottom-0 w-1 bg-gradient-to-b from-emerald-500 to-teal-500 rounded-full"></div>
                <h2 class="text-3xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-200 to-slate-400">
                    Atur Harga Beli Minyak
                </h2>
                <p class="text-sm text-slate-400 mt-1.5 max-w-xl">
                    Sesuaikan nominal harga beli per liter secara real-time untuk menarik minat masyarakat menyetor ke depo Anda.
                </p>
            </div>

            <div class="relative overflow-hidden bg-slate-900/40 border border-slate-800 rounded-2xl p-6 backdrop-blur-md">
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-emerald-500/5 blur-3xl rounded-full pointer-events-none"></div>
                
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="space-y-2 max-w-md">
                        <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                            Acuan Kaskade Aktif
                        </div>
                        <h4 class="font-bold text-base text-white tracking-wide">Kebijakan Margin PT HEN</h4>
                        <p class="text-xs text-slate-400 leading-relaxed">
                            Batas atas pembelian dikunci otomatis oleh sistem pusat. Pastikan harga beli Anda menyisakan margin operasional yang ideal.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-4 bg-slate-950/60 p-4 rounded-xl border border-slate-800/80">
                        <div class="text-center px-2">
                            <span class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider">Maksimum (PT HEN)</span>
                            <span class="text-sm font-extrabold text-slate-300 block mt-0.5">Rp 11.000</span>
                        </div>
                        <div class="text-center px-2 border-l border-slate-800">
                            <span class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider">Rekomendasi Depo</span>
                            <span class="text-sm font-extrabold text-emerald-400 block mt-0.5">Rp 9.000 - 9.500</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative group rounded-3xl p-[1px] bg-gradient-to-b from-slate-800 via-slate-900 to-slate-950 shadow-2xl transition-all duration-300">
                <div class="absolute inset-0 bg-gradient-to-b from-emerald-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-3xl pointer-events-none"></div>
                
                <div class="relative bg-slate-950 rounded-[23px] p-6 sm:p-8">
                    <form action="{{ route('pengepul.harga.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="space-y-2">
                            <label for="harga_beli" class="block text-xs font-bold uppercase tracking-widest text-slate-400">
                                Harga Beli ke Masyarakat <span class="text-slate-600">(Per Liter)</span>
                            </label>
                            
                            <div class="relative group/input">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 border-r border-slate-800/80 my-3 pr-3">
                                    <span class="text-slate-400 text-sm font-bold tracking-tight group-focus-within/input:text-emerald-400 transition-colors">
                                        IDR
                                    </span>
                                </div>
                                
                                <input type="number" name="harga_beli" id="harga_beli" 
                                    class="block w-full rounded-2xl border-slate-800 bg-slate-900/60 pl-20 pr-16 py-4 text-xl font-bold text-white placeholder-slate-700 focus:border-emerald-500/80 focus:ring-4 focus:ring-emerald-500/10 sm:text-lg transition-all duration-300 backdrop-blur-sm" 
                                    placeholder="9500" required>

                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4">
                                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">/ Liter</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-2 text-[11px] text-slate-500 pt-1">
                                <svg class="w-3.5 h-3.5 text-slate-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                Sistem otomatis memvalidasi nominal angka saat tombol simpan ditekan.
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-slate-900">
                            <span class="text-xs text-slate-500 italic hidden sm:inline">Perubahan harga langsung aktif di aplikasi penilai warga.</span>
                            
                            <button type="submit" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-bold text-sm tracking-wide shadow-lg shadow-emerald-950/50 hover:shadow-emerald-500/20 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-150">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>