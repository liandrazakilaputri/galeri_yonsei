<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Tambahkan baris ini supaya Laravel tahu tabelnya "kategori"
    protected $table = 'kategori';

    protected $fillable = ['nama'];

    public function fotos()
    {
        return $this->hasMany(\App\Models\Foto::class, 'kategori_id');
    }
}
