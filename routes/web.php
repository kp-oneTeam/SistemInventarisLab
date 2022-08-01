<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\RuanganController;
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

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/barang',[BarangController::class,'index']);
Route::post('tambah/barang', [BarangController::class, 'tambah_barang']);
Route::delete('hapus/barang/{id}', [BarangController::class, 'hapus_barang']);
Route::get('detail/barang/{id}', [BarangController::class, 'detail_barang']);
Route::get('/ruangan',[RuanganController::class,'index']);
Route::get('/inventaris', [InventarisController::class, 'index']);
Route::get('tambah/inventaris', [InventarisController::class, 'form_tambah_inventaris']);
Route::post('tambah/inventaris', [InventarisController::class, 'tambah_inventaris']);
Route::get('edit/inventaris/{id}', [InventarisController::class, 'form_ubah_inventaris']);
Route::delete('hapus/inventaris/{id}', [InventarisController::class, 'hapus_inventaris']);
Route::get('laporan',[LaporanController::class,'index']);
Route::get('peminjaman',[PeminjamanController::class,'index']);
