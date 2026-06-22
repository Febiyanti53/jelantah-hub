<?php

namespace App\Http\Controllers;

use App\Models\Setoran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StakeholderController extends Controller
{
    /**
     * Dashboard Utama Stakeholder + Logika Prediksi AI Dana Pembelian + Overlay Lokasi Jaringan
     */
    public function index()
    {
        if (Auth::user()->role !== 'stakeholder') {
            return redirect('/' . Auth::user()->role . '/dashboard');
        }

        // 1. Ambil Statistik Makro Berdasarkan Atribut Database Anda
        $totalMinyakSelesai = Setoran::where('status', 'selesai')->sum('liter_bersih') ?? 0; 
        $antreanKendaliMutu = Setoran::where('status', 'proses')->count();
        $totalPengeluaranInsentif = Setoran::where('status', 'selesai')->sum('harga_dibayar') ?? 0;

        // 2. Logika Utama AI/ML: Prediksi Dana Pembelian Bulan Depan (Linear Regression)
        $historiBulanan = Setoran::where('status', 'selesai')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%m') as bulan_angka"),
                DB::raw("SUM(harga_dibayar) as total_biaya")
            )
            ->groupBy('bulan_angka')
            ->orderBy('bulan_angka', 'asc')
            ->take(6)
            ->get();

        $prediksiDanaBulanDepan = $this->hitungLinearRegression($historiBulanan);

        // 3. Ambil Log Transaksi Gabungan (Masyarakat -> Pengepul) untuk Audit Kendali Mutu
        $semuaSetoran = Setoran::with(['masyarakat', 'pengepul'])
            ->latest()
            ->paginate(10);

        // 4. KORDINAT JARINGAN (OVERLAY DUA AKTOR) UNTUK PETA LEAFLET
        // Ambil Hub Pengepul (Aman tanpa 'address')
        $titikPetaPengepul = User::where('role', 'pengepul')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get(['id', 'name', 'latitude', 'longitude']);

        // Ambil Titik Penyetor Masyarakat Aktif (Aman tanpa 'address')
        $titikPetaMasyarakat = User::where('role', 'masyarakat')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get(['id', 'name', 'latitude', 'longitude']);

        // 5. [FITUR PEMBEDA JURI] Hitung Titik Rekomendasi Hub Baru Menggunakan Konsep K-Means (1-Centroid)
        $titikRekomendasiHub = $this->hitungCentroidRekomendasi($titikPetaMasyarakat);

        return view('dashboard.stakeholder', compact(
            'totalMinyakSelesai',
            'antreanKendaliMutu',
            'totalPengeluaranInsentif',
            'prediksiDanaBulanDepan',
            'semuaSetoran',
            'titikPetaPengepul',
            'titikPetaMasyarakat',
            'titikRekomendasiHub'
        ));
    }

    /**
     * Mesin Algoritma Regresi Linier Sederhana (Y = a + bX)
     */
    private function hitungLinearRegression($data)
    {
        $n = $data->count();
        if ($n < 2) {
            return Setoran::where('status', 'selesai')->avg('harga_dibayar') * 1.15 ?? 500000;
        }

        $sumX = 0; $sumY = 0; $sumXY = 0; $sumX2 = 0;
        
        foreach ($data as $index => $row) {
            $x = $index + 1; 
            $y = $row->total_biaya;

            $sumX += $x;
            $sumY += $y;
            $sumXY += ($x * $y);
            $sumX2 += ($x * $x);
        }

        $b = (($n * $sumXY) - ($sumX * $sumY)) / (($n * $sumX2) - ($sumX * $sumX));
        $a = ($sumY - ($b * $sumX)) / $n;

        $xBerikutnya = $n + 1;
        $hasilPrediksi = $a + ($b * $xBerikutnya);

        return max($hasilPrediksi, 200000); 
    }

    /**
     * Algoritma Mencari Centroid (Titik Tengah) K-Means Kluster Penyetor
     * Untuk Memberikan Rekomendasi Lokasi Ekspansi Bisnis PT HEN
     */
    private function hitungCentroidRekomendasi($masyarakatCollection)
    {
        if ($masyarakatCollection->isEmpty()) {
            return null;
        }

        $totalLat = 0;
        $totalLng = 0;
        $count = $masyarakatCollection->count();

        foreach ($masyarakatCollection as $user) {
            $totalLat += $user->latitude;
            $totalLng += $user->longitude;
        }

        // Rumus Dasar Mean Centroid K-Means
        return [
            'latitude' => $totalLat / $count,
            'longitude' => $totalLng / $count,
            'total_penyetor_sekitar' => $count
        ];
    }

    /**
     * [KENDALI MUTU] Form Input Uji Laboratorium Spesifikasi Avtur/SAF
     */
    public function editLab($id)
    {
        $setoran = Setoran::findOrFail($id);
        return view('dashboard.stakeholder_lab', compact('setoran'));
    }

    /**
     * [KENDALI MUTU - PROCESS] Simpan Hasil Uji Lab & Penentuan Grade
     */
    public function updateLab(Request $request, $id)
    {
        $request->validate([
            'kadar_air' => 'required|numeric|min:0|max:100',
            'ffa' => 'required|numeric|min:0|max:100',
            'kotoran' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:selesai,ditolak',
        ]);

        $setoran = Setoran::findOrFail($id);
        
        $grade = 'Reject';
        if ($request->kadar_air <= 0.15 && $request->ffa <= 1.5 && $request->kotoran <= 0.02) {
            $grade = 'Grade A (Premium SAF)';
        } elseif ($request->kadar_air <= 0.50 && $request->ffa <= 3.0 && $request->kotoran <= 0.05) {
            $grade = 'Grade B (Standar)';
        } else {
            $grade = 'Grade C (Butuh Olah Ulang)';
        }

        $setoran->update([
            'kadar_air' => $request->kadar_air,
            'ffa' => $request->ffa,
            'kotoran' => $request->kotoran,
            'grade' => $grade,
            'status' => $request->status,
        ]);

        return redirect()->route('stakeholder.dashboard')->with('success', 'Hasil uji laboratorium dan kendali mutu berhasil disimpan!');
    }




    public function auditLog()
    {
        if (Auth::user()->role !== 'stakeholder') {
            return redirect('/' . Auth::user()->role . '/dashboard');
        }

        // Mengambil log transaksi dengan paginasi rapi
        $semuaSetoran = Setoran::with(['masyarakat', 'pengepul'])
            ->latest()
            ->paginate(10);

        return view('dashboard.stakeholder_audit', compact('semuaSetoran'));
    }
}