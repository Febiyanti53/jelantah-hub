<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 

class PengepulController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil koordinat posisi masyarakat dari request (jika dikirim oleh JavaScript browser)
        // Jika browser belum mendeteksi lokasi, set default ke titik koordinat kantor/pusat kota
        $userLat = $request->get('lat', -7.5661); // Default contoh: Surakarta/Solo
        $userLng = $request->get('lng', 110.8243);

        // 2. Ambil semua user yang memiliki role 'pengepul'
        $pengepulList = User::where('role', 'pengepul')->get();

        // 3. Hitung jarak tiap pengepul menggunakan Rumus Jarak Bumi (Haversine Formula)
        $hasilPencarian = $pengepulList->map(function ($pengepul) use ($userLat, $userLng) {
            $earthRadius = 6371; // Radius bumi dalam satuan Kilometer

            // Konversi derajat ke radian
            $dLat = deg2rad($pengepul->latitude - $userLat);
            $dLng = deg2rad($pengepul->longitude - $userLng);

            $a = sin($dLat / 2) * sin($dLat / 2) +
                 cos(deg2rad($userLat)) * cos(deg2rad($pengepul->latitude)) *
                 sin($dLng / 2) * sin($dLng / 2);
            
            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
            $jarak = $earthRadius * $c; // Hasil akhir dalam Kilometer

            // Tempelkan data jarak hasil hitungan ke object pengepul
            $pengepul->jarak = round($jarak, 2); 
            return $pengepul;
        })->sortBy('jarak'); // Urutkan langsung dari jarak yang paling dekat dekat

        // 4. Lempar data hasil sortir ke halaman Blade view
        return view('masyarakat.pengepul.index', compact('hasilPencarian', 'userLat', 'userLng'));
    }
}