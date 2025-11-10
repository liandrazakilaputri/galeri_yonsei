<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agendas';
    protected $fillable = ['judul', 'tanggal', 'deskripsi'];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
