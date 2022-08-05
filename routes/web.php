<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\VendorController;
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
Route::put('update/barang/{id}',[BarangController::class,'update_barang']);
Route::delete('hapus/barang/{id}', [BarangController::class, 'hapus_barang']);
Route::get('validasi_barang/{nama}',[BarangController::class,'validasi_nama_barang_tambah']);
Route::get('validasi_edit_barang/{kode}/{nama}', [BarangController::class, 'validasi_edit_nama_barang']);
Route::get('detail/barang/{id}', [BarangController::class, 'detail_barang']);
Route::get('/ruangan',[RuanganController::class,'index']);
Route::post('tambah/ruangan', [RuanganController::class, 'tambah_ruangan']);
Route::put('update/ruangan/{id}',[RuanganController::class,'update_ruangan']);
Route::delete('hapus/ruangan/{id}', [RuanganController::class, 'hapus_ruangan']);
Route::get('validasi_ruangan/{nama}',[RuanganController::class,'validasi_nama_ruangan_tambah']);
Route::get('validasi_edit_ruangan/{kode}/{nama}', [RuanganController::class, 'validasi_edit_nama_ruangan']);
Route::get('/inventaris', [InventarisController::class, 'index']);
Route::post('checked/inventaris', [InventarisController::class, 'checked']);
Route::get('tambah/inventaris', [InventarisController::class, 'form_tambah_inventaris']);
Route::post('tambah/inventaris', [InventarisController::class, 'tambah_inventaris']);
Route::get('edit/inventaris/{id}', [InventarisController::class, 'form_ubah_inventaris']);
Route::put('ubah/inventaris/{kodeInventaris}', [InventarisController::class, 'ubah']);
Route::delete('hapus/inventaris/{id}', [InventarisController::class, 'hapus_inventaris']);
Route::get('laporan',[LaporanController::class,'index']);
Route::get('peminjaman',[PeminjamanController::class,'index']);
Route::get('pengembalian/{id}', [PeminjamanController::class, 'form_pengembalian']);
Route::get('tambah/peminjaman', [PeminjamanController::class, 'form_tambah_peminjaman']);
Route::post('tambah/peminjaman', [PeminjamanController::class, 'tambah_peminjaman']);
Route::get('/vendor',[VendorController::class,'index']);
Route::post('tambah/vendor', [VendorController::class, 'tambah_vendor']);
Route::put('update/vendor/{id}',[VendorController::class,'update_vendor']);
Route::delete('hapus/vendor/{id}', [VendorController::class, 'hapus_vendor']);
Route::get('validasi_vendor/{nama}',[VendorController::class,'validasi_nama_vendor_tambah']);
Route::get('validasi_edit_vendor/{kode}/{nama}', [VendorController::class, 'validasi_edit_nama_vendor']);
