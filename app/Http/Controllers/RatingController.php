<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function store(Request $request, $fotoId)
    {
        $request->validate([
            'rating'   => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string',
        ]);

        Rating::create([
            'foto_id'   => $fotoId,
            'user_id'   => auth()->id(),
            'rating'    => $request->rating,
            'komentar'  => $request->komentar,
        ]);

        return back()->with('success', 'Terima kasih sudah memberikan rating & komentar!');
    }
}
