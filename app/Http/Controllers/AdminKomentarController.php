<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KomentarHome;
use App\Models\Rating;
use App\Models\Foto;

class AdminKomentarController extends Controller
{
    // Tampilkan semua komentar + rating
    public function index()
    {
        $komentarHome = KomentarHome::latest()->get();
        $ratings = Rating::with('foto')->latest()->get();

        return view('admin.komentar.index', compact('komentarHome', 'ratings'));
    }

    // Hapus komentar home
    public function destroyKomentarHome($id)
    {
        $komentar = KomentarHome::findOrFail($id);
        $komentar->delete();

        return back()->with('success', 'Komentar berhasil dihapus.');
    }

    // Hapus rating
    public function destroyRating($id)
    {
        $rating = Rating::findOrFail($id);
        $rating->delete();

        return back()->with('success', 'Rating berhasil dihapus.');
    }
}
