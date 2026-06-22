<?php

namespace App\Http\Controllers\Pengepul;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HargaController extends Controller
{
    public function index()
    {
        // Mengambil data user pengepul yang sedang login
        return view('pengepul.harga.index', [
            'pengepul' => auth()->user()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'harga_beli' => 'required|numeric|min:1000|max:11000',
        ]);

        $user = auth()->user();
        $user->update([
            'harga_per_liter' => $request->harga_beli
        ]);

        return back()->with('success', 'Harga beli berhasil diperbarui!');
    }
}