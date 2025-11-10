<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $fillable = ['judul', 'deskripsi', 'kategori_id', 'gambar'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'foto_id');
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }

    public function comments()
    {
        return $this->hasMany(Rating::class, 'foto_id')->whereNotNull('komentar');
    }
}
