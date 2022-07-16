<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPraktikan extends Model
{
    use HasFactory;

    protected $table = 'data_praktikan';

    public function praktikan()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function praktikum()
    {
        return $this->belongsTo(Praktikum::class, 'id_praktikum');
    }
}
