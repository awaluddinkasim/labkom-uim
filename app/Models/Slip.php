<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slip extends Model
{
    use HasFactory;

    protected $table = 'slip';

    public function praktikum()
    {
        return $this->belongsTo(Praktikum::class, 'id_praktikum');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'nim', 'nim');
    }
}
