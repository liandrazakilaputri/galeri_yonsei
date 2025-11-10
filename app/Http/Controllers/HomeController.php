<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;
use App\Models\KomentarHome;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman utama
     */
    public function index()
    {
        // Ambil 6 foto terbaru
        $foto = Foto::with('kategori')->latest()->take(6)->get();

        // Ambil 5 komentar terbaru
        $komentar = KomentarHome::latest()->take(5)->get();

        return view('user.home', compact('foto', 'komentar'));
    }

    /**
     * Fungsi untuk load more foto via AJAX
     */
    public function loadMore(Request $request)
    {
        $offset = $request->get('offset', 0);

        // Ambil 6 foto lagi dari offset tertentu
        $foto = Foto::with('kategori')
                    ->latest()
                    ->skip($offset)
                    ->take(6)
                    ->get();

        // Render tampilan partial untuk setiap foto
        $html = '';
        foreach ($foto as $f) {
            $html .= view('user.partials.foto-card', compact('f'))->render();
        }

        return response()->json([
            'html' => $html,
            'count' => $foto->count()
        ]);
    }

    /**
     * Simpan atau update rating
     */
    public function updateRating(Request $request, Foto $foto)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5'
        ]);

        $user_id = Auth::id() ?? 0;

        // Cek apakah user sudah pernah kasih rating
        $existing = $foto->ratings()->where('user_id', $user_id)->first();
        if ($existing) {
            $existing->update(['rating' => $request->rating]);
        } else {
            $foto->ratings()->create([
                'user_id' => $user_id,
                'rating' => $request->rating
            ]);
        }

        // Hitung rata-rata rating terbaru
        $average = round($foto->ratings()->avg('rating'), 2);

        return response()->json(['average' => $average]);
    }

    /**
     * Simpan komentar dari user
     */
    public function storeKomentar(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'komentar' => 'required|string|max:500',
        ]);

        KomentarHome::create($request->only('nama', 'komentar'));

        return back()->with('success', 'Komentar berhasil dikirim!');
    }

    /**
     * Halaman Tentang
     */
    public function tentang()
    {
        return view('user.tentang');
    }
}
