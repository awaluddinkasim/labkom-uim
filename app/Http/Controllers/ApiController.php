<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function daftarJurusan()
    {
        $data = [
            'daftarJurusan' => Fakultas::orderBy('nama')->get()
        ];

        return response()->json($data, 200);
    }
}
