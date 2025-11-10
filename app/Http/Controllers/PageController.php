<?php

namespace App\Http\Controllers;

use App\Models\Foto;

class PageController extends Controller
{
   public function home()
{
    $komentar = \App\Models\KomentarHome::latest()->take(5)->get();
    return view('user.home', compact('komentar'));
}

    public function tentang()
    {
        return view('user.tentang');
    }
}
