<?php

namespace App\Http\Controllers;

use App\Models\Setoran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetoranController extends Controller
{
    /**
     * [READ] Menampilkan Dashboard Utama Masyarakat (Statistik / Ringkasan)
     */
    public function dashboardMasyarakat()
    {
        if (Auth::user()->role !== 'masyarakat') {
            return redirect('/' . Auth::user()->role . '/dashboard');
        }

        // Mengambil data ringkasan untuk widget/kartu statistik di halaman utama dashboard
        $totalPoin = Auth::user()->eco_points ?? 0; 
        
        $totalPengajuan = Setoran::where('masyarakat_id', Auth::id())->count();
        
        $totalMinyakSelesai = Setoran::where('masyarakat_id', Auth::id())
            ->where('status', 'selesai')
            ->sum('liter_estimasi'); // Sesuaikan field volume riil jika ada field liter_bersih

        return view('dashboard.masyarakat', compact('totalPoin', 'totalPengajuan', 'totalMinyakSelesai'));
    }

    /**
     * [READ] Menampilkan Halaman Riwayat Setoran Khusus (Tabel Log Lengkap)
     */
    public function riwayatMasyarakat()
    {
        if (Auth::user()->role !== 'masyarakat') {
            return redirect('/' . Auth::user()->role . '/dashboard');
        }

        $riwayatSetoran = Setoran::with('pengepul')
            ->where('masyarakat_id', Auth::id())
            ->latest()
            ->get();

        return view('dashboard.masyarakat_riwayat', compact('riwayatSetoran'));
    }

    /**
     * [CREATE] Menampilkan Formulir Pengajuan & Daftar Pengepul
     */
    public function createMasyarakat()
    {
        if (Auth::user()->role !== 'masyarakat') {
            return redirect('/' . Auth::user()->role . '/dashboard');
        }

        $user = Auth::user();
        $lat = $user->latitude;
        $lon = $user->longitude;

        if ($lat && $lon) {
            $daftarPengepul = User::where('role', 'pengepul')
                ->selectRaw("*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS jarak", [$lat, $lon, $lat])
                ->orderBy('jarak', 'asc')
                ->orderBy('harga_per_liter', 'desc')
                ->get();
        } else {
            $daftarPengepul = User::where('role', 'pengepul')->orderBy('harga_per_liter', 'desc')->get();
        }

        return view('dashboard.setoran', compact('daftarPengepul'));
    }



    /**
 * [READ - PENGEPUL] Menampilkan Antrean Setoran dari Masyarakat
 */
public function indexPengepul()
{
    // 1. Hitung total stok dari setoran yang sudah tervalidasi ('selesai')
    $totalStok = Setoran::where('pengepul_id', Auth::id())
                        ->where('status', 'selesai')
                        ->sum('liter_bersih');

    // 2. Ambil daftar antrean milik pengepul ini yang statusnya masih 'pending'
    $antreanSetoran = Setoran::with('masyarakat')
                        ->where('pengepul_id', Auth::id())
                        ->where('status', 'pending')
                        ->orderBy('created_at', 'asc')
                        ->get();

    return view('pengepul.setoran.index', compact('totalStok', 'antreanSetoran'));
}
public function storeMasyarakat(Request $request)
{
    $request->validate([
        'pengepul_id'         => 'required|exists:users,id',
        'liter_estimasi'      => 'required|numeric|min:1',
        'tanggal_penjemputan' => 'required|date|after_or_equal:today',
        'jam_penjemputan'     => 'required|date_format:H:i', // Tambahkan validasi jam
    ]);

    Setoran::create([
        'masyarakat_id'       => Auth::id(),
        'pengepul_id'         => $request->pengepul_id,
        'liter_estimasi'      => $request->liter_estimasi,
        'tanggal_penjemputan' => $request->tanggal_penjemputan,
        'jam_penjemputan'     => $request->jam_penjemputan, // Tambahkan field ini
        'status'              => 'pending',
    ]);

    return redirect()->route('masyarakat.riwayat')->with('success', 'Pengajuan setoran berhasil dikirim!');
}
    /**
     * [UPDATE] Menampilkan Halaman Edit Setoran
     */
    public function editMasyarakat($id)
    {
        $setoran = Setoran::where('masyarakat_id', Auth::id())->findOrFail($id);

        if ($setoran->status !== 'pending') {
            return redirect()->route('masyarakat.riwayat')->with('error', 'Pengajuan tidak dapat diubah karena sedang/sudah diproses oleh pengepul.');
        }

        $daftarPengepul = User::where('role', 'pengepul')->get();

        return view('dashboard.setoran_edit', compact('setoran', 'daftarPengepul'));
    }

    /**
     * [UPDATE - PROCESS] Memperbarui Data Setoran di Database
     */
    public function updateMasyarakat(Request $request, $id)
{
    $setoran = Setoran::where('masyarakat_id', Auth::id())->findOrFail($id);

    if ($setoran->status !== 'pending') {
        return redirect()->route('masyarakat.riwayat')->with('error', 'Pengajuan tidak dapat diubah karena sedang/sudah diproses.');
    }

    $request->validate([
        'pengepul_id'         => 'required|exists:users,id',
        'liter_estimasi'      => 'required|numeric|min:1',
        'tanggal_penjemputan' => 'required|date|after_or_equal:today',
        'jam_penjemputan'     => 'required|date_format:H:i', // Tambahkan validasi jam
    ]);

    $setoran->update([
        'pengepul_id'         => $request->pengepul_id,
        'liter_estimasi'      => $request->liter_estimasi,
        'tanggal_penjemputan' => $request->tanggal_penjemputan,
        'jam_penjemputan'     => $request->jam_penjemputan, // Tambahkan field ini
    ]);

    return redirect()->route('masyarakat.riwayat')->with('success', 'Pengajuan setoran berhasil diperbarui!');
}

    /**
     * [DELETE] Membatalkan/Menghapus Pengajuan Setoran
     */
    public function destroyMasyarakat($id)
    {
        $setoran = Setoran::where('masyarakat_id', Auth::id())->findOrFail($id);

        if ($setoran->status !== 'pending') {
            return redirect()->route('masyarakat.riwayat')->with('error', 'Pengajuan tidak dapat dibatalkan karena sedang/sudah diproses.');
        }

        $setoran->delete();

        return redirect()->route('masyarakat.riwayat')->with('success', 'Pengajuan setoran berhasil dibatalkan.');
    }
}