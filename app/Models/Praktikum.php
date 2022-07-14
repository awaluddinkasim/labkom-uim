<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Praktikum extends Model
{
    use HasFactory;

    protected $table = 'praktikum';

    public function praktikan()
    {
        return $this->hasMany(DataPraktikan::class, 'id_praktikum');
    }
}
