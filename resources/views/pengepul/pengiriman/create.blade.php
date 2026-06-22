<x-app-layout>
    <div class="p-6 sm:p-8 bg-slate-900 text-slate-100 min-h-screen">
        <div class="max-w-4xl mx-auto space-y-6">
            
            <div>
                <h2 class="text-2xl font-bold text-white tracking-tight">Kirim Minyak ke PT HEN</h2>
                <p class="text-sm text-slate-400 mt-1">Daftarkan muatan jeriken/tangki curah yang akan disetor ke laboratorium industri.</p>
            </div>

            <hr class="border-slate-800">

            <div class="bg-slate-950 border border-slate-800 rounded-2xl p-6 shadow-xl">
                <form action="{{ route('pengepul.pengiriman.store') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="volume" class="block text-sm font-medium text-slate-300 mb-2">Total Volume Kirim</label>
                            <div class="relative rounded-xl shadow-sm">
                                <input type="number" name="volume" id="volume" class="block w-full rounded-xl border-slate-800 bg-slate-900 pr-12 text-white focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Contoh: 200" required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-500 text-sm font-semibold">Liter</div>
                            </div>
                        </div>

                        <div>
                            <label for="no_kendaraan" class="block text-sm font-medium text-slate-300 mb-2">No. Kendaraan Pengirim</label>
                            <input type="text" name="no_kendaraan" id="no_kendaraan" class="block w-full rounded-xl border-slate-800 bg-slate-900 text-white placeholder-slate-600 focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Contoh: AD 1234 AB" required>
                        </div>
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-sm shadow-md transition-all">
                            Konfirmasi Pengiriman Gudang
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>