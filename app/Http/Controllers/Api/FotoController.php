<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    // GET /api/fotos → list semua foto
    public function index()
    {
        $fotos = Foto::with('kategori')->latest()->get();
        return response()->json($fotos);
    }

    // GET /api/fotos/{id} → detail foto
    public function show($id)
    {
        $foto = Foto::with('kategori')->findOrFail($id);
        return response()->json($foto);
    }

    // POST /api/fotos → tambah foto (butuh token)
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori,id',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('gambar')->store('galeri', 'public');

        $foto = Foto::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'gambar' => $path,
        ]);

        return response()->json([
            'message' => 'Foto berhasil ditambahkan',
            'data' => $foto
        ], 201);
    }

    // PUT /api/fotos/{id} → update foto (butuh token)
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
            $path = $request->file('gambar')->store('galeri', 'public');
            $foto->gambar = $path;
        }

        $foto->judul = $request->judul;
        $foto->deskripsi = $request->deskripsi;
        $foto->kategori_id = $request->kategori_id;
        $foto->save();

        return response()->json([
            'message' => 'Foto berhasil diperbarui',
            'data' => $foto
        ]);
    }

    // DELETE /api/fotos/{id} → hapus foto (butuh token)
    public function destroy($id)
    {
        $foto = Foto::findOrFail($id);

        if ($foto->gambar && Storage::disk('public')->exists($foto->gambar)) {
            Storage::disk('public')->delete($foto->gambar);
        }

        $foto->delete();

        return response()->json(['message' => 'Foto berhasil dihapus']);
    }
}
