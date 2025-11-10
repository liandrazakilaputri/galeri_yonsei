<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    // ========================
    // ADMIN CRUD
    // ========================
    public function index()
    {
        $galeri = Foto::with('kategori')->latest()->get();
        return view('admin.galeri.index', compact('galeri'));
    }

    public function create()
    {
        $kategori = Kategori::orderBy('nama')->get();
        return view('admin.galeri.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori,id',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('gambar')->store('galeri', 'public');

        Foto::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'gambar' => $path,
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $foto = Foto::findOrFail($id);
        $kategori = Kategori::orderBy('nama')->get();
        return view('admin.galeri.edit', compact('foto', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $foto = Foto::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($foto->gambar && Storage::disk('public')->exists($foto->gambar)) {
                Storage::disk('public')->delete($foto->gambar);
            }
            $foto->gambar = $request->file('gambar')->store('galeri', 'public');
        }

        $foto->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'gambar' => $foto->gambar,
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $foto = Foto::findOrFail($id);

        if ($foto->gambar && Storage::disk('public')->exists($foto->gambar)) {
            Storage::disk('public')->delete($foto->gambar);
        }

        $foto->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Foto berhasil dihapus!');
    }

    // ========================
    // USER / PUBLIC
    // ========================
    public function userGaleri(Request $request)
    {
        $query = Foto::with('kategori', 'comments');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('judul', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%");
        }

        $fotos = $query->get();

        // Group by kategori & urutkan A-Z
        $groupedFotos = $fotos->groupBy(function ($foto) {
            return $foto->kategori->nama ?? 'Tanpa Kategori';
        })->sortKeys(); // <-- ini bikin urut A-Z

        return view('user.galeri', compact('groupedFotos'));
    }


    // ========================
    // SHOW DETAIL FOTO
    // ========================
    public function show($id)
    {
        $foto = Foto::with('kategori', 'comments')->findOrFail($id);
        return view('user.show', compact('foto')); // ganti ke show.blade.php
    }

    // ========================
    // RATING & KOMENTAR PUBLIC
    // ========================
    public function storeRating(Request $request, $id)
    {
        $foto = Foto::findOrFail($id);

        $request->validate([
            'nama_user' => 'nullable|string|max:255',
            'komentar' => 'nullable|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        if ($request->komentar || $request->rating) {
            $foto->comments()->create([
                'nama_user' => $request->nama_user ?? 'Anonim',
                'komentar' => $request->komentar,
                'rating' => $request->rating,
            ]);
        }

        return back()->with('success', 'Komentar & rating berhasil dikirim!');
    }

    // ========================
    // DOWNLOAD FOTO
    // ========================
    public function download($id)
    {
        $foto = Foto::findOrFail($id);

        if ($foto->gambar && Storage::disk('public')->exists($foto->gambar)) {
            return response()->download(storage_path("app/public/{$foto->gambar}"));
        }

        return back()->with('error', 'File tidak ditemukan.');
    }
}
