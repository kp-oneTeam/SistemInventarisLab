<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\InventarisKomputerController;
use App\Http\Controllers\InventarisPeralatanKomputer;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\VendorController;
use App\Models\Inventaris;
use App\Models\InventarisKomputer;
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
// Barang
Route::get('/barang',[BarangController::class,'index']);
Route::post('tambah/barang', [BarangController::class, 'tambah_barang']);
Route::put('update/barang/{id}',[BarangController::class,'update_barang']);
Route::delete('hapus/barang/{id}', [BarangController::class, 'hapus_barang']);
Route::get('validasi_barang/{nama}',[BarangController::class,'validasi_nama_barang_tambah']);
Route::get('validasi_edit_barang/{kode}/{nama}', [BarangController::class, 'validasi_edit_nama_barang']);
Route::get('detail/barang/{id}', [BarangController::class, 'detail_barang']);
//Gedung
Route::get('/gedung',[GedungController::class,'index']);
Route::post('tambah/gedung', [GedungController::class, 'tambah_gedung']);
Route::put('update/gedung/{id}', [GedungController::class, 'update_gedung']);
Route::delete('hapus/gedung/{id}',[GedungController::class,'hapus_gedung']);
Route::get('validasi_gedung/{nama}', [GedungController::class, 'validasi_nama_gedung_tambah']);
Route::get('validasi_edit_gedung/{kode}/{nama}', [GedungController::class, 'validasi_edit_nama_gedung']);
// Ruangan
Route::get('/ruangan',[RuanganController::class,'index']);
Route::post('tambah/ruangan', [RuanganController::class, 'tambah_ruangan']);
Route::put('update/ruangan/{id}',[RuanganController::class,'update_ruangan']);
Route::delete('hapus/ruangan/{id}', [RuanganController::class, 'hapus_ruangan']);
Route::post('checked/ruangan', [RuanganController::class, 'checked']);
Route::get('validasi_ruangan/{nama}',[RuanganController::class,'validasi_nama_ruangan_tambah']);
Route::get('validasi_edit_ruangan/{kode}/{nama}', [RuanganController::class, 'validasi_edit_nama_ruangan']);
// Inventaris
Route::get('/inventaris', [InventarisController::class, 'index']);
Route::post('checked/inventaris', [InventarisController::class, 'checked']);
Route::get('tambah/inventaris', [InventarisController::class, 'form_tambah_inventaris']);
Route::post('tambah/inventaris', [InventarisController::class, 'tambah_inventaris']);
Route::get('edit/inventaris/{id}', [InventarisController::class, 'form_ubah_inventaris']);
Route::put('ubah/inventaris/{kodeInventaris}', [InventarisController::class, 'ubah']);
Route::delete('hapus/inventaris/{id}', [InventarisController::class, 'hapus_inventaris']);
Route::get('detail/inventaris/{kode_inventaris}',[InventarisController::class,'detail']);

Route::get('tambah/inventaris_komputer',[InventarisKomputerController::class,'create']);
Route::post('tambah/inventaris_komputer', [InventarisKomputerController::class, 'store']);
//Inventaris Peralatan Komputer
Route::get('tambah/inventaris_peralatan_komputer',[InventarisPeralatanKomputer::class,'index']);
Route::post('tambah/inventaris_peralatan_komputer/motherboard',[InventarisPeralatanKomputer::class,'tambah_inventaris_motherboard']);
Route::post('tambah/inventaris_peralatan_komputer/cpu',[InventarisPeralatanKomputer::class,'cpu']);
Route::post('tambah/inventaris_peralatan_komputer/ram', [InventarisPeralatanKomputer::class, 'ram']);
Route::post('tambah/inventaris_peralatan_komputer/storage', [InventarisPeralatanKomputer::class, 'storage']);
Route::post('tambah/inventaris_peralatan_komputer/gpu', [InventarisPeralatanKomputer::class, 'gpu']);
Route::post('tambah/inventaris_peralatan_komputer/psu', [InventarisPeralatanKomputer::class, 'psu']);
Route::post('tambah/inventaris_peralatan_komputer/casing', [InventarisPeralatanKomputer::class, 'casing']);

// Laporan
Route::get('laporan',[LaporanController::class,'index']);

//Peminjaman
Route::get('peminjaman',[PeminjamanController::class,'index']);
Route::get('pengembalian/{id}', [PeminjamanController::class, 'form_pengembalian']);
Route::get('tambah/peminjaman', [PeminjamanController::class, 'form_tambah_peminjaman']);
Route::post('tambah/peminjaman', [PeminjamanController::class, 'tambah_peminjaman']);

// Vendor
Route::get('/vendor',[VendorController::class,'index']);
Route::post('tambah/vendor', [VendorController::class, 'tambah_vendor']);
Route::put('update/vendor/{id}',[VendorController::class,'update_vendor']);
Route::delete('hapus/vendor/{id}', [VendorController::class, 'hapus_vendor']);
Route::post('checked/vendor', [VendorController::class, 'checked']);
Route::get('validasi_vendor/{nama}',[VendorController::class,'validasi_nama_vendor_tambah']);
Route::get('validasi_edit_vendor/{kode}/{nama}', [VendorController::class, 'validasi_edit_nama_vendor']);
