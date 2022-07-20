<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/jurusan', [ApiController::class, 'daftarJurusan']);

Route::post('/register', [ApiController::class, 'register']);

Route::post('/login', [AuthController::class, 'loginAPI']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/me', function(Request $request) {
        return response()->json([
            'user' => $request->user()
        ]);
    });

    Route::get('/logout', [AuthController::class, 'logoutAPI']);
});
