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

Route::group(['middleware' => 'auth:admin','prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/akun/{jenis}', [AdminController::class, 'akun'])->name('akun');

    Route::get('/logout', [AuthController::class, 'logoutAdmin'])->name('logout');
});
