<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-lg text-slate-800 leading-tight">
            Ringkasan Aktivitas Setoran
        </h2>
    </x-slot>


    @if (session('success'))
    <div class="mb-5 p-4 rounded-2xl bg-emerald-100 text-emerald-800 border border-emerald-200 flex items-center justify-between shadow-sm">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="text-sm font-semibold">{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900">
            &times;
        </button>
    </div>
@endif

@if (session('error'))
    <div class="mb-5 p-4 rounded-2xl bg-red-100 text-red-800 border border-red-200 flex items-center justify-between shadow-sm">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="text-sm font-semibold">{{ session('error') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-900">
            &times;
        </button>
    </div>
@endif

    <div class="mb-8 p-6 bg-gradient-to-r from-emerald-600 to-teal-700 rounded-3xl text-white shadow-xl shadow-emerald-100 relative overflow-hidden">
        <div class="absolute right-0 top-0 translate-x-4 -translate-y-4 opacity-10">
            <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H7c0-2.76 2.24-5 5-5s5 2.24 5 5c0 1.04-.42 1.99-1.07 2.75z"/>
            </svg>
        </div>
        <div class="relative z-10 max-w-xl">
            <h1 class="text-2xl font-bold mb-1">Halo, {{ Auth::user()->name }}! 🌱</h1>
            <p class="text-emerald-100 text-sm leading-relaxed">
                Terima kasih telah berkontribusi menjaga kelestarian bumi. Setiap liter minyak jelantah yang Anda setorkan membantu mengurangi emisi karbon penerbangan nasional.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">
        
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="p-3.5 rounded-xl bg-emerald-50 text-emerald-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Kontribusi (Selesai)</p>
                <h3 class="text-2xl font-extrabold text-slate-800 mt-0.5">
                    {{ number_format($riwayatSetoran->where('status', 'selesai')->sum('liter_bersih'), 1, ',', '.') }}
                    <span class="text-sm font-medium text-slate-500">Liter</span>
                </h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="p-3.5 rounded-xl bg-amber-50 text-amber-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5h16.5M3.75 20.25zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Insentif Diterima</p>
                <h3 class="text-2xl font-extrabold text-slate-800 mt-0.5">
                    <span class="text-sm font-semibold text-slate-500">Rp</span> 
                    {{ number_format($riwayatSetoran->where('status', 'selesai')->sum('harga_dibayar'), 0, ',', '.') }}
                </h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4 sm:col-span-2 lg:col-span-1">
            <div class="p-3.5 rounded-xl bg-blue-50 text-blue-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Setoran Terakhir</p>
                <div class="flex items-center gap-2 mt-1">
                    @if($riwayatSetoran->first())
                        @if($riwayatSetoran->first()->status === 'pending')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 uppercase tracking-wide text-[10px]">
                                Menunggu Validasi Pengepul
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 uppercase tracking-wide text-[10px]">
                                Selesai Diproses
                            </span>
                        @endif
                    @else
                        <span class="text-xs text-slate-400 italic">Belum ada aktivitas</span>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden shadow-sm">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between flex-wrap gap-4">
            <div>
                <h3 class="text-base font-bold text-slate-900">Log Riwayat Pengiriman</h3>
                <p class="text-xs text-slate-500 mt-0.5">Daftar transaksi setoran jelantah Anda ke mitra pengepul.</p>
            </div>
            <a href="{{ route('masyarakat.pengepul.terdekat') }}" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold text-white bg-slate-900 hover:bg-slate-800 rounded-xl transition-all shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Setor Minyak Sekarang
            </a>
        </div>
        
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-[11px] font-bold uppercase tracking-wider border-b border-slate-100">
                        <th class="py-3 px-6">Tanggal Penjemputan</th>
                        <th class="py-3 px-6">Tujuan Pengepul</th>
                        <th class="py-3 px-6 text-right">Volume Klaim / Bersih</th>
                        <th class="py-3 px-6 text-right">Insentif Estimasi / Aktual</th>
                        <th class="py-3 px-6 text-center">Status Alur</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse($riwayatSetoran as $setoran)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-4 px-6 font-medium text-slate-900">
                                {{ $setoran->tanggal_penjemputan ? $setoran->tanggal_penjemputan->translatedFormat('d F Y') : '-' }}
                                <span class="block text-[11px] text-slate-400 font-normal mt-0.5">Jam Pengajuan: {{ $setoran->jam_penjemputan ?? '--:--' }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="font-semibold text-slate-800">{{ $setoran->pengepul->name ?? 'Hub Tidak Ditemukan' }}</div>
                                <div class="text-xs text-slate-400 mt-0.5">{{ $setoran->pengepul->alamat ?? '-' }}</div>
                            </td>
                            <td class="py-4 px-6 text-right">
                                @if($setoran->status === 'pending')
                                    <span class="font-semibold text-slate-700">{{ number_format($setoran->liter_estimasi, 1, ',', '.') }} L</span>
                                    <span class="block text-[10px] text-slate-400">(Klaim Warga)</span>
                                @else
                                    <span class="font-bold text-slate-900">{{ number_format($setoran->liter_clean ?? $setoran->liter_bersih, 1, ',', '.') }} L</span>
                                    <span class="block text-[10px] text-emerald-600 font-medium">(Bersih Riil, Endapan: {{ $setoran->endapan }}L)</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right">
                                @if($setoran->status === 'pending')
                                    <span class="font-semibold text-slate-500">Rp {{ number_format($setoran->liter_estimasi * ($setoran->pengepul->harga_per_liter ?? 10000), 0, ',', '.') }}</span>
                                    <span class="block text-[10px] text-amber-500 font-medium">(Estimasi Kas)</span>
                                @else
                                    <span class="font-black text-emerald-600">Rp {{ number_format($setoran->harga_dibayar, 0, ',', '.') }}</span>
                                    <span class="block text-[10px] text-emerald-500">(Sudah Cair)</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                @if($setoran->status === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 border border-amber-200/50 uppercase tracking-wider text-[10px]">
                                        Pending
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200/50 uppercase tracking-wider text-[10px]">
                                        Selesai
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400 italic font-medium bg-slate-50/40">
                                Belum ada riwayat aktivitas pengiriman logistik jelantah.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>