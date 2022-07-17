<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return view('pages.index');
})->name('index');

Route::middleware(['guest', 'guest:admin', 'guest:dosen'])->group(function() {
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::get('/dosen/login', [AuthController::class, 'loginPageDosen'])->name('dosen.login');
    Route::get('/admin/login', [AuthController::class, 'loginPageAdmin'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'loginAdmin'])->name('admin.authenticate');
});

Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/master/{jenis}', [AdminController::class, 'masterData'])->name('master');
    Route::post('/master/{jenis}', [AdminController::class, 'masterDataStore'])->name('master-store');
    Route::delete('/master/{jenis}', [AdminController::class, 'masterDataDelete'])->name('master-delete');

    Route::get('/master/{jenis}/edit', [AdminController::class, 'masterDataEdit'])->name('master-edit');
    Route::put('/master/{jenis}/update', [AdminController::class, 'masterDataUpdate'])->name('master-update');

    Route::get('/akun/{jenis}', [AdminController::class, 'akun'])->name('akun');
    Route::delete('/akun/{jenis}', [AdminController::class, 'akunDelete'])->name('akun-delete');
    Route::post('/akun/dosen', [AdminController::class, 'akunDosenStore'])->name('akun-dosen-store');

    Route::get('/akun/dosen/{id}', [AdminController::class, 'akunDosenDetail'])->name('dosen-detail');
    Route::get('/akun/dosen/{id}/edit', [AdminController::class, 'akunDosenEdit'])->name('dosen-edit');
    Route::put('/akun/dosen/{id}/edit', [AdminController::class, 'akunDosenUpdate'])->name('dosen-update');
    Route::post('/akun/dosen/{id}', [AdminController::class, 'akunDosenPraktikum'])->name('dosen-praktikum');
    Route::delete('/akun/dosen/{id}', [AdminController::class, 'akunDosenPraktikumDelete'])->name('dosen-praktikum-delete');

    Route::get('/akun/mahasiswa/{id}', [AdminController::class, 'akunMahasiswaDetail'])->name('mhs-detail');
    Route::get('/akun/mahasiswa/{id}/edit', [AdminController::class, 'akunMahasiswaEdit'])->name('mhs-edit');
    Route::put('/akun/mahasiswa/{id}/update', [AdminController::class, 'akunMahasiswaUpdate'])->name('mhs-update');
    Route::post('/akun/mahasiswa/{action}', [AdminController::class, 'akunMahasiswaAction'])->name('mhs-action');

    Route::get('/slip', [AdminController::class, 'slipPraktikum'])->name('slip');

    Route::get('/pengaturan', [AdminController::class, 'pengaturan'])->name('pengaturan');
    Route::post('/pengaturan', [AdminController::class, 'pengaturanSave'])->name('pengaturan-save');

    Route::get('/profil', [AdminController::class, 'profil'])->name('profil');
    Route::put('/profil', [AdminController::class, 'profilUpdate'])->name('profil-update');

    Route::get('/logout', [AuthController::class, 'logoutAdmin'])->name('logout');
});
