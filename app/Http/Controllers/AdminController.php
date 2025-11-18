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

        // Render view dengan header anti-back
        $response = response()->view('admin.dashboard', compact(
            'totalFoto',
            'totalKategori',
            'totalAdmin',
            'totalKomentar',
            'allFotos',
            'recentComments'
        ));

        return $response->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')
                        ->header('Pragma','no-cache')
                        ->header('Expires','Sat, 01 Jan 1990 00:00:00 GMT');
    }
}
