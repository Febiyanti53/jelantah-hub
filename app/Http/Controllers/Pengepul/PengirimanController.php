<?php

namespace App\Http\Controllers\Pengepul;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    // Halaman Riwayat Pengiriman / Log Pengiriman
    public function index()
    {
        return view('pengepul.pengiriman.index');
    }

    // Halaman Form Kirim Minyak Baru ke PT HEN
    public function create()
    {
        return view('pengepul.pengiriman.create');
    }
}