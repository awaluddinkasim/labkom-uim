<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Informasi;
use App\Models\Praktikum;
use App\Models\Rejected;
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

            $rejected = Rejected::where('nim', $mhs->nim)->first();
            if ($rejected) {
                $rejected->delete();
            }

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
            'daftarJurusan' => Fakultas::has('prodi')->orderBy('nama')->get()
        ];

        return response()->json($data, 200);
    }

    public function daftarInformasi()
    {
        $data = [
            'daftarInformasi' => Informasi::whereYear('created_at', date('Y'))->orderBy('created_at', 'DESC')->get()
        ];

        return response()->json($data, 200);
    }

    public function daftarPraktikum(Request $request)
    {
        $data = [
            'daftarPraktikum' => Praktikum::where('id_prodi', $request->user()->id_prodi)->get()
        ];

        return response()->json($data, 200);
    }
}
