<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomentarHome extends Model
{
    protected $table = 'komentar_homes'; // sesuai migration
    protected $fillable = ['nama', 'komentar'];
}
