<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $remember = $request->remember? true : false;
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->with('failed', 'Email atau Password salah!');
    }

    public function logoutAdmin()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function loginAPI(Request $request)
    {
        $mahasiswa = User::where('nim', $request->nim)->first();

        if ($mahasiswa->active) {
            if ($mahasiswa && Hash::check($request->password, $mahasiswa->password)) {
                $token = $mahasiswa->createToken('auth-user')->plainTextToken;

                return response()->json([
                    'message' => 'berhasil',
                    'token' => $token,
                    'user' => $mahasiswa
                ], 200);
            }
        } else {
            return response()->json([
                'message' => 'Akun belum aktif',
                'data' => $request->all()
            ], 401);
        }

        return response()->json([
            'message' => 'Username atau Password salah',
            'data' => $request->all()
        ], 401);
    }

    public function logoutAPI(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'berhasil'
        ], 200);
    }
}
