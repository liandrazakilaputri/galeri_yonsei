<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;
use App\Models\Kategori;
use App\Models\User;
use App\Models\KomentarHome;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Statistik
        $totalFoto = Foto::count();
        $totalKategori = Kategori::count();
        $totalAdmin = User::count();
        $totalKomentar = KomentarHome::count();

        // Ambil semua foto
        $allFotos = Foto::with('kategori')->get();

        // Komentar terbaru (masih dibatasi 5)
        $recentComments = KomentarHome::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalFoto',
            'totalKategori',
            'totalAdmin',
            'totalKomentar',
            'allFotos',
            'recentComments'
        ));
    }
}
