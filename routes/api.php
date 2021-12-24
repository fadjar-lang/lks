<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PesananController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name('login');

//home
Route::get('index/barang', [HomeController::class, 'index']);
Route::get('detail/barang/{id}', [HomeController::class, 'show']);


Route::middleware(['auth:api', 'role:user'])->group(function () {
    Route::post('barang/pesan/{id}', [PesananController::class, 'pesan']);
    Route::get('pesanan', [CartController::class, 'index']);
    Route::get('pesanan/detail', [CartController::class, 'pesanan']);
    Route::get('pesanan/jumlah', [CartController::class, 'sum']);
    Route::delete('pesanan/hapus/{id}', [CartController::class, 'delete']);
});

Route::middleware(['auth:api', 'role:admin'])->group(function () {
    //barang
    Route::get('barang', [BarangController::class, 'index']);
    Route::get('barang/show/{id}', [BarangController::class, 'show']);
    Route::post('barang/store', [BarangController::class, 'store']);
    Route::post('barang/edit/{id}', [BarangController::class, 'update']);
    Route::delete('barang/delete/{id}', [BarangController::class, 'destroy']);

    Route::post('logout', [AuthController::class, 'logout']);
});