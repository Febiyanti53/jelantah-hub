<x-app-layout>
    <div class="p-6 sm:p-8 bg-slate-900 text-slate-100 min-h-screen">
        <div class="max-w-6xl mx-auto space-y-6">
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-white tracking-tight">Riwayat Pengiriman Pabrik</h2>
                    <p class="text-sm text-slate-400 mt-1">Pantau status pengiriman tangki curah dan hasil uji mutu laboratorium dari PT HEN.</p>
                </div>
                <div>
                    <a href="{{ route('pengepul.pengiriman.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-semibold rounded-xl transition-all shadow-md shadow-emerald-900/20">
                        + Kirim Minyak Baru
                    </a>
                </div>
            </div>

            <hr class="border-slate-800">

            <div class="bg-slate-950 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-300">
                        <thead class="bg-slate-900 text-[11px] uppercase tracking-wider font-bold text-slate-400 border-b border-slate-800">
                            <tr>
                                <th class="px-6 py-3.5">ID Pengiriman / Kendaraan</th>
                                <th class="px-6 py-3.5">Tanggal Kirim</th>
                                <th class="px-6 py-3.5">Volume</th>
                                <th class="px-6 py-3.5">Hasil Uji Lab PT HEN</th>
                                <th class="px-6 py-3.5">Status Logistik</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60">
                            
                            <tr class="hover:bg-slate-900/40 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-white">TRX-HEN-9921</div>
                                    <div class="text-xs text-slate-500">Nopol: AD 8821 OA</div>
                                </td>
                                <td class="px-6 py-4 text-slate-400">22 Juni 2026</td>
                                <td class="px-6 py-4 font-medium text-white">450.00 Liter</td>
                                <td class="px-6 py-4">
                                    <div class="text-xs space-y-0.5">
                                        <div><span class="text-slate-500">FFA:</span> <span class="text-emerald-400 font-medium">1.2%</span> (Lolos)</div>
                                        <div><span class="text-slate-500">Air:</span> <span class="text-emerald-400 font-medium">0.1%</span> (Lolos)</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                        Diterima Industri
                                    </span>
                                </td>
                            </tr>

                            <tr class="hover:bg-slate-900/40 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-white">TRX-HEN-9954</div>
                                    <div class="text-xs text-slate-500">Nopol: B 9012 CXX</div>
                                </td>
                                <td class="px-6 py-4 text-slate-400">22 Juni 2026</td>
                                <td class="px-6 py-4 font-medium text-white">200.00 Liter</td>
                                <td class="px-6 py-4 text-xs text-slate-500 italic">
                                    Sampel sedang diuji...
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-500/10 text-amber-400 border border-amber-500/20 animate-pulse">
                                        Pengecekan Mutu
                                    </span>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>