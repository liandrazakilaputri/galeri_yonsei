<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;
use App\Models\KomentarHome; // ✅ pakai KomentarHome sesuai keinginan kamu
use App\Models\Agenda;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * 🏠 Tampilkan halaman utama
     */
    public function index()
    {
        $foto = Foto::latest()->take(6)->get();
        $komentar = KomentarHome::latest()->take(5)->get(); // ✅ pakai KomentarHome
        $agendas = Agenda::latest()->take(3)->get();

        // Tambahan statistik biar home lebih hidup (opsional)
        $totalFoto = Foto::count();
        $totalAgenda = Agenda::count();
        $totalKomentar = KomentarHome::count();

        return view('user.home', compact('foto', 'komentar', 'agendas', 'totalFoto', 'totalAgenda', 'totalKomentar'));
    }

    /**
     * 🔄 Load more foto via AJAX
     */
    public function loadMore(Request $request)
    {
        $offset = $request->get('offset', 0);

        $foto = Foto::with('kategori')
                    ->latest()
                    ->skip($offset)
                    ->take(6)
                    ->get();

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
     * ⭐ Update rating foto
     */
    public function updateRating(Request $request, Foto $foto)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5'
        ]);

        $user_id = Auth::id() ?? 0;

        $existing = $foto->ratings()->where('user_id', $user_id)->first();
        if ($existing) {
            $existing->update(['rating' => $request->rating]);
        } else {
            $foto->ratings()->create([
                'user_id' => $user_id,
                'rating' => $request->rating
            ]);
        }

        $average = round($foto->ratings()->avg('rating'), 2);

        return response()->json(['average' => $average]);
    }

    /**
     * 💬 Simpan komentar dari user
     */
    public function storeKomentar(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'komentar' => 'required|string|max:500',
        ]);

        KomentarHome::create($request->only('nama', 'komentar')); // ✅ tetap pakai KomentarHome

        return back()->with('success', 'Komentar berhasil dikirim!');
    }

    /**
     * ℹ️ Halaman Tentang
     */
    public function tentang()
    {
        return view('user.tentang');
    }
}
