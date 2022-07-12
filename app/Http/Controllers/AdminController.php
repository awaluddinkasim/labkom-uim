<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

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
}
