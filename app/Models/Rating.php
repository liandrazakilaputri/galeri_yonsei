<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'foto_id',
        'user_id',
        'rating',
        'komentar',
    ];

    // Rating milik 1 foto
    public function foto()
    {
        return $this->belongsTo(Foto::class, 'foto_id');
    }

    // Kalau ada relasi user juga bisa tambahin
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
