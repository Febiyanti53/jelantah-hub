<?php

namespace App\Http\Controllers\Pengepul;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HargaController extends Controller
{
    public function index()
    {
        // Hubungkan ke view tempat pengepul mengubah harga literan minyak
        return view('pengepul.harga.index'); 
    }
}