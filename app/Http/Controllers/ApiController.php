<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        $foto = $request->file('foto');
        $filename = 'mhs-'.uniqid().'.'.$foto->getClientOriginalExtension();

        try {
            $mhs = new User();
            $mhs->nim = $request->nim;
            $mhs->nama = $request->nama;
            $mhs->no_hp = "0".$request->no_hp;
            $mhs->password = bcrypt($request->password);
            $mhs->foto = $filename;
            $mhs->id_prodi = $request->id_prodi;
            $mhs->save();

            $foto->move(public_path('f/avatar'), $filename);
            return response()->json([
                'message' => 'Berhasil mendaftar, akun kamu sedang menunggu verifikasi dari admin'
            ], 200);
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return response()->json([
                    'message' => 'Maaf, akun dengan NIM tersebut sudah terdaftar sebelumnya'
                ], 400);
            }
            return response()->json([
                'message' => 'Daftar akun gagal'
            ], 400);
        }

    }

    public function daftarJurusan()
    {
        $data = [
            'daftarJurusan' => Fakultas::orderBy('nama')->get()
        ];

        return response()->json($data, 200);
    }
}
