<x-app-layout>
    <div class="bg-gray-50 text-gray-800 w-full" x-data="{ sidebarExpanded: true }">
        
            <main class="space-y-6">
                
                <!-- Card Total Transaksi -->
                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex items-center justify-between shadow-sm">
                    <div class="space-y-1">
                        <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Total Transaksi Masuk</h2>
                        <p class="text-3xl font-black text-gray-900 tracking-tight">{{ $semuaSetoran->total() }} <span class="text-sm font-normal text-gray-400">berkas</span></p>
                    </div>
                    <div class="p-3 bg-indigo-50 rounded-xl text-indigo-600 border border-indigo-100/50 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2Z" />
                        </svg>
                    </div>
                </div>

                <!-- Card Tabel Transaksi -->
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50/50 flex items-center justify-between">
                        <h3 class="font-bold text-gray-800">Riwayat Setoran & Validasi Laboratorium</h3>
                        <span class="text-xs text-gray-400">Data Real-Time Jaringan JelantahHub</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-600">
                            <thead class="bg-gray-50 text-[11px] font-bold uppercase tracking-wider text-gray-500 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3.5">Kode / Tanggal</th>
                                    <th class="px-6 py-3.5">Penyetor (Masyarakat)</th>
                                    <th class="px-6 py-3.5">Hub Pengumpul</th>
                                    <th class="px-6 py-3.5 text-right">Volume Bersih</th>
                                    <th class="px-6 py-3.5 text-center">Hasil Grade</th>
                                    <th class="px-6 py-3.5 text-center">Status</th>
                                    <th class="px-6 py-3.5 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($semuaSetoran as $setoran)
                                <tr class="hover:bg-gray-50/80 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-900">#TRX-{{ str_pad($setoran->id, 5, '0', STR_PAD_LEFT) }}</div>
                                        <div class="text-[11px] text-gray-400 mt-0.5">{{ $setoran->created_at->format('d M Y H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-700">{{ $setoran->masyarakat->name ?? 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-700">{{ $setoran->pengepul->name ?? 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-right font-semibold text-indigo-600">
                                        {{ number_format($setoran->liter_bersih, 1) }} L
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($setoran->grade)
                                            <span class="px-2.5 py-0.5 text-xs font-semibold rounded-md border 
                                                {{ str_contains($setoran->grade, 'Grade A') ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : '' }}
                                                {{ str_contains($setoran->grade, 'Grade B') ? 'bg-amber-50 text-amber-700 border-amber-200' : '' }}
                                                {{ str_contains($setoran->grade, 'Grade C') ? 'bg-orange-50 text-orange-700 border-orange-200' : '' }}
                                                {{ str_contains($setoran->grade, 'Reject') ? 'bg-rose-50 text-rose-700 border-rose-200' : '' }}
                                            ">
                                                {{ $setoran->grade }}
                                            </span>
                                        @else
                                            <span class="text-xs text-gray-400 italic">Belum Diuji</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-2.5 py-0.5 text-xs font-bold rounded-full border
                                            {{ $setoran->status === 'selesai' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : '' }}
                                            {{ $setoran->status === 'proses' ? 'bg-amber-50 text-amber-700 border-amber-200' : '' }}
                                            {{ $setoran->status === 'ditolak' ? 'bg-rose-50 text-rose-700 border-rose-200' : '' }}
                                        ">
                                            {{ ucfirst($setoran->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('stakeholder.lab.edit', $setoran->id) }}" 
                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold bg-white hover:bg-gray-50 text-indigo-600 rounded-lg border border-gray-200 shadow-sm transition-all">
                                            Uji Lab
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center text-gray-400 italic">
                                        Belum ada transaksi log logistik terkumpul.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($semuaSetoran->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50/30">
                        {{ $semuaSetoran->links() }}
                    </div>
                    @endif
                </div>

            </main>
        </div>
    </div>
</x-app-layout>