<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login-mahasiswa');
    }

    public function loginPageDosen()
    {
        return view('auth.login-dosen');
    }

    public function loginPageAdmin()
    {
        return view('auth.login-admin');
    }

    public function loginAdmin(Request $request)
    {
        if ($request->remember) {
            $remember = true;
        } else {
            $remember = false;
        }
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->with('Email atau Password salah!');
    }
}
