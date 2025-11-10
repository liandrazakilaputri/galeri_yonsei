<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index() { return response()->json(Kategori::all(), 200); }

    public function store(Request $request)
    {
        $request->validate(['name'=>'required|string|max:255']);
        $kategori = Kategori::create(['name'=>$request->name]);
        return response()->json($kategori, 201);
    }

    public function show(Kategori $kategori) { return response()->json($kategori, 200); }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate(['name'=>'required|string|max:255']);
        $kategori->name = $request->name;
        $kategori->save();
        return response()->json($kategori, 200);
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return response()->json(['message'=>'Kategori berhasil dihapus'], 200);
    }
}
