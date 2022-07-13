<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function akun($jenis)
    {
        switch ($jenis) {
            case 'dosen':
                return view('admin.akun-dosen');

            case 'mahasiswa':
                return view('admin.akun-mahasiswa');

            default:
                return redirect()->route('admin.dashboard');
        }
    }

    public function akunDelete(Request $request,$jenis)
    {
        switch ($jenis) {
            case 'dosen':
                $dosen = Dosen::find($request->id);
                if ($dosen->foto != 'default.png') {
                    File::delete(public_path('f/avatar/'.$dosen->foto));
                }
                $dosen->delete();

                return redirect()->back()->with('success', 'Akun berhasil dihapus');

            case 'mahasiswa':
                $mhs = User::find($request->id);
                if ($mhs->foto != 'default.png') {
                    File::delete(public_path('f/avatar/'.$mhs->foto));
                }
                $mhs->delete();

                return redirect()->back()->with('success', 'Akun berhasil dihapus');

            default:
                return redirect()->route('admin.dashboard');
        }
    }
}
