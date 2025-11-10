<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KomentarHome;

class KomentarHomeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'komentar' => 'required|string|max:500',
        ]);

        KomentarHome::create($request->all());

        return redirect()->route('home')->with('success', 'Komentar berhasil dikirim!');
    }
}
