<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\InventarisKomputerController;
use App\Http\Controllers\InventarisPeralatanKomputer;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\UsersController;
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
Route::group(['middleware' => ['role:laboran','auth']],function () {
    // Barang
    Route::get('/barang', [BarangController::class, 'index']);
    Route::post('tambah/barang', [BarangController::class, 'tambah_barang']);
    Route::put('update/barang/{id}', [BarangController::class, 'update_barang']);
    Route::delete('hapus/barang/{id}', [BarangController::class, 'hapus_barang']);
    Route::get('validasi_barang/{nama}', [BarangController::class, 'validasi_nama_barang_tambah']);
    Route::get('validasi_edit_barang/{kode}/{nama}', [BarangController::class, 'validasi_edit_nama_barang']);
    Route::get('detail/barang/{id}', [BarangController::class, 'detail_barang']);
    //Gedung
    Route::get('/gedung', [GedungController::class, 'index']);
    Route::post('tambah/gedung', [GedungController::class, 'tambah_gedung']);
    Route::put('update/gedung/{id}', [GedungController::class, 'update_gedung']);
    Route::delete('hapus/gedung/{id}', [GedungController::class, 'hapus_gedung']);
    Route::get('validasi_gedung/{nama}', [GedungController::class, 'validasi_nama_gedung_tambah']);
    Route::get('validasi_edit_gedung/{kode}/{nama}', [GedungController::class, 'validasi_edit_nama_gedung']);
    // Ruangan
    Route::get('/ruangan', [RuanganController::class, 'index']);
    Route::post('tambah/ruangan', [RuanganController::class, 'tambah_ruangan']);
    Route::put('update/ruangan/{id}', [RuanganController::class, 'update_ruangan']);
    Route::delete('hapus/ruangan/{id}', [RuanganController::class, 'hapus_ruangan']);
    Route::post('checked/ruangan', [RuanganController::class, 'checked']);
    Route::get('validasi_ruangan/{nama}', [RuanganController::class, 'validasi_nama_ruangan_tambah']);
    Route::get('validasi_kode_ruangan/{kode}', [RuanganController::class, 'validasi_kode_ruangan_tambah']);
    Route::get('validasi_edit_ruangan/{kode}/{nama}', [RuanganController::class, 'validasi_edit_nama_ruangan']);
    Route::get('get_gedung/{id}', [RuanganController::class, 'get_gedung']);
    Route::get('detail/ruangan/{id}', [RuanganController::class, 'detail']);
    // Inventaris
    Route::get('/inventaris', [InventarisController::class, 'index']);
    Route::post('checked/inventaris', [InventarisController::class, 'checked']);
    Route::get('tambah/inventaris', [InventarisController::class, 'form_tambah_inventaris']);
    Route::post('tambah/inventaris', [InventarisController::class, 'tambah_inventaris']);
    Route::get('edit/inventaris/{id}', [InventarisController::class, 'form_ubah_inventaris']);
    Route::put('ubah/inventaris/{kodeInventaris}', [InventarisController::class, 'ubah']);
    Route::delete('hapus/inventaris/{id}', [InventarisController::class, 'hapus_inventaris']);
    Route::get('detail/inventaris/{kode_inventaris}', [InventarisController::class, 'detail']);
    Route::get('mobile/inventaris/non-komputer/{id}', [InventarisController::class, 'mobile']);
});
Route::group(['middleware' => ['role:kepala lab','auth']],function () {
    Route::resource('/users', UsersController::class);
    // Laporan
    Route::get('laporan', [LaporanController::class, 'index']);
});
Route::group(['middleware' =>'auth'], function () {
    Route::post('laporan/print', [LaporanController::class, 'cetak']);
    // Inventaris
    Route::get('/inventaris', [InventarisController::class, 'index']);
    Route::post('checked/inventaris', [InventarisController::class, 'checked']);
    Route::get('tambah/inventaris', [InventarisController::class, 'form_tambah_inventaris']);
    Route::post('tambah/inventaris', [InventarisController::class, 'tambah_inventaris']);
    Route::get('edit/inventaris/{id}', [InventarisController::class, 'form_ubah_inventaris']);
    Route::put('ubah/inventaris/{kodeInventaris}', [InventarisController::class, 'ubah']);
    Route::delete('hapus/inventaris/{id}', [InventarisController::class, 'hapus_inventaris']);
    Route::get('detail/inventaris/{kode_inventaris}', [InventarisController::class, 'detail']);
    Route::get('mobile/inventaris/non-komputer/{id}', [InventarisController::class, 'mobile']);
    //Inventaris Komputer
    Route::get('tambah/inventaris_komputer', [InventarisKomputerController::class, 'create']);
    Route::post('tambah/inventaris_komputer', [InventarisKomputerController::class, 'store']);
    Route::get('getRam/{id}', [InventarisKomputerController::class, 'getRam']);
    Route::get('detail/inventaris_komputer/{id}', [InventarisKomputerController::class, 'detail']);
    Route::get('edit/inventaris_komputer/{id}', [InventarisKomputerController::class, 'edit']);
    Route::post('update/inventaris_komputer/{id}', [InventarisKomputerController::class, 'update']);
    Route::delete('hapus/inventaris_komputer/{id}', [InventarisKomputerController::class, 'destroy']);
    Route::post('hapus/inventaris_komputer/ram/{id_inventaris}/{id_ram}', [InventarisKomputerController::class, 'hapus_ram']);
    Route::post('tambah/inventaris_komputer/ram/{id_inventaris}', [InventarisKomputerController::class, 'tambah_ram']);
    Route::post('hapus/inventaris_komputer/storage/{id_inventaris}/{id_storage}', [InventarisKomputerController::class, 'hapus_storage']);
    Route::post('tambah/inventaris_komputer/storage/{id_inventaris}', [InventarisKomputerController::class, 'tambah_storage']);
    Route::get('mobile/inventaris/komputer/{id}', [InventarisKomputerController::class, 'mobile']);
    //Inventaris Tab route
    Route::get('/inventaris/non-komputer', [InventarisController::class, 'index']);
    Route::get('/inventaris/peralatan-komputer', [InventarisController::class, 'index']);
    Route::get('/inventaris/komputer', [InventarisController::class, 'index']);
    //Inventaris Motherboard
    Route::get('inventaris/peralatan-komputer/tambah/motherboard', [InventarisPeralatanKomputer::class, 'index']);
    Route::post('tambah/inventaris_peralatan_komputer/motherboard', [InventarisPeralatanKomputer::class, 'tambah_inventaris_motherboard']);
    Route::post('tambah/inventaris_peralatan_komputer/motherboard', [InventarisPeralatanKomputer::class, 'tambah_inventaris_motherboard']);
    Route::delete('hapus/inventaris/peralatan-komputer/motherboard/{id}', [InventarisPeralatanKomputer::class, 'hapus_inv_motherboard']);
    Route::get('detail/inventaris-peralatan-komputer/motherboard/{id}', [InventarisPeralatanKomputer::class, 'detail_motherboard']);
    Route::get('edit/inventaris-peralatan-komputer/motherboard/{id}', [InventarisPeralatanKomputer::class, 'form_ubah_motherboard']);
    Route::put('ubah/inventaris-peralatan-komputer/motherboard/{id}', [InventarisPeralatanKomputer::class, 'action_update_motherboard']);
    //Inventaris Processor
    Route::post('tambah/inventaris_peralatan_komputer/cpu', [InventarisPeralatanKomputer::class, 'cpu']);
    Route::delete('hapus/inventaris/peralatan-komputer/processor/{id}', [InventarisPeralatanKomputer::class, 'hapus_inv_processor']);
    Route::get('detail/inventaris-peralatan-komputer/processor/{id}', [InventarisPeralatanKomputer::class, 'detail_processor']);
    Route::get('edit/inventaris-peralatan-komputer/processor/{id}', [InventarisPeralatanKomputer::class, 'form_ubah_processor']);
    Route::put('ubah/inventaris-peralatan-komputer/processor/{id}', [InventarisPeralatanKomputer::class, 'action_update_processor']);

    //Inventaris Ram
    Route::post('tambah/inventaris_peralatan_komputer/ram', [InventarisPeralatanKomputer::class, 'ram']);
    Route::delete('hapus/inventaris/peralatan-komputer/ram/{id}', [InventarisPeralatanKomputer::class, 'hapus_inv_ram']);
    Route::get('detail/inventaris-peralatan-komputer/ram/{id}', [InventarisPeralatanKomputer::class, 'detail_ram']);
    Route::get('edit/inventaris-peralatan-komputer/ram/{id}', [InventarisPeralatanKomputer::class, 'form_ubah_ram']);
    Route::put('ubah/inventaris-peralatan-komputer/ram/{id}', [InventarisPeralatanKomputer::class, 'action_update_ram']);

    //Inventaris Storage
    Route::post('tambah/inventaris_peralatan_komputer/storage', [InventarisPeralatanKomputer::class, 'storage']);
    Route::delete('hapus/inventaris-peralatan-komputer/storage/{id}', [InventarisPeralatanKomputer::class, 'hapus_inv_storage']);
    Route::get('detail/inventaris-peralatan-komputer/storage/{id}', [InventarisPeralatanKomputer::class, 'detail_storage']);
    Route::get('edit/inventaris-peralatan-komputer/storage/{id}', [InventarisPeralatanKomputer::class, 'form_ubah_storage']);
    Route::put('ubah/inventaris-peralatan-komputer/storage/{id}', [InventarisPeralatanKomputer::class, 'action_update_storage']);

    //Inventaris GPU
    Route::post('tambah/inventaris_peralatan_komputer/gpu', [InventarisPeralatanKomputer::class, 'gpu']);
    Route::delete('hapus/inventaris-peralatan-komputer/gpu/{id}', [InventarisPeralatanKomputer::class, 'hapus_inv_gpu']);
    Route::get('detail/inventaris-peralatan-komputer/gpu/{id}', [InventarisPeralatanKomputer::class, 'detail_gpu']);
    Route::get('edit/inventaris-peralatan-komputer/gpu/{id}', [InventarisPeralatanKomputer::class, 'form_ubah_gpu']);
    Route::put('ubah/inventaris-peralatan-komputer/gpu/{id}', [InventarisPeralatanKomputer::class, 'action_update_gpu']);
    //Inventaris PSU
    Route::post('tambah/inventaris_peralatan_komputer/psu', [InventarisPeralatanKomputer::class, 'psu']);
    Route::delete('hapus/inventaris-peralatan-komputer/psu/{id}', [InventarisPeralatanKomputer::class, 'hapus_inv_psu']);
    Route::get('detail/inventaris-peralatan-komputer/psu/{id}', [InventarisPeralatanKomputer::class, 'detail_psu']);
    Route::get('edit/inventaris-peralatan-komputer/psu/{id}', [InventarisPeralatanKomputer::class, 'form_ubah_psu']);
    Route::put('ubah/inventaris-peralatan-komputer/psu/{id}', [InventarisPeralatanKomputer::class, 'action_update_psu']);
    //Inventaris Casing
    Route::post('tambah/inventaris_peralatan_komputer/casing', [InventarisPeralatanKomputer::class, 'casing']);
    Route::delete('hapus/inventaris-peralatan-komputer/casing/{id}', [InventarisPeralatanKomputer::class, 'hapus_inv_casing']);
    Route::get('detail/inventaris-peralatan-komputer/casing/{id}', [InventarisPeralatanKomputer::class, 'detail_casing']);
    Route::get('edit/inventaris-peralatan-komputer/casing/{id}', [InventarisPeralatanKomputer::class, 'form_ubah_casing']);
    Route::put('ubah/inventaris-peralatan-komputer/casing/{id}', [InventarisPeralatanKomputer::class, 'action_update_casing']);

    Route::get('mobile/inventaris/peralatan_komputer/{nama}/{id}', [InventarisPeralatanKomputer::class, 'mobile']);
    //Inventaris Peralatan Komputer Cetak QR Code
    Route::post('checked/inventaris/peralatan-komputer/motherboard', [InventarisPeralatanKomputer::class, 'checked_motherboard']);
    Route::post('checked/inventaris/peralatan-komputer/processor', [InventarisPeralatanKomputer::class, 'checked_processor']);
    Route::post('checked/inventaris/peralatan-komputer/ram', [InventarisPeralatanKomputer::class, 'checked_ram']);
    Route::post('checked/inventaris/peralatan-komputer/storage', [InventarisPeralatanKomputer::class, 'checked_storage']);
    Route::post('checked/inventaris/peralatan-komputer/gpu', [InventarisPeralatanKomputer::class, 'checked_gpu']);
    Route::post('checked/inventaris/peralatan-komputer/psu', [InventarisPeralatanKomputer::class, 'checked_psu']);
    Route::post('checked/inventaris/peralatan-komputer/casing', [InventarisPeralatanKomputer::class, 'checked_casing']);
    //Inventaris Komputer Cetak Qr Code
    Route::post('checked/inventaris/komputer', [InventarisKomputerController::class, 'checked']);
    // inventaris Peralatan komputer tambah route
    Route::get('inventaris/peralatan-komputer/tambah/motherboard', [InventarisPeralatanKomputer::class, 'index']);
    Route::get('inventaris/peralatan-komputer/tambah/processor', [InventarisPeralatanKomputer::class, 'index']);
    Route::get('inventaris/peralatan-komputer/tambah/ram', [InventarisPeralatanKomputer::class, 'index']);
    Route::get('inventaris/peralatan-komputer/tambah/storage', [InventarisPeralatanKomputer::class, 'index']);
    Route::get('inventaris/peralatan-komputer/tambah/gpu', [InventarisPeralatanKomputer::class, 'index']);
    Route::get('inventaris/peralatan-komputer/tambah/psu', [InventarisPeralatanKomputer::class, 'index']);
    Route::get('inventaris/peralatan-komputer/tambah/casing', [InventarisPeralatanKomputer::class, 'index']);
    //inventaris Peralatan Komputer Tab Route
    Route::get('inventaris/inventaris-peralatan-komputer/motherboard', [InventarisController::class, 'index']);
    Route::get('inventaris/inventaris-peralatan-komputer/processor', [InventarisController::class, 'index']);
    Route::get('inventaris/inventaris-peralatan-komputer/ram', [InventarisController::class, 'index']);
    Route::get('inventaris/inventaris-peralatan-komputer/storage', [InventarisController::class, 'index']);
    Route::get('inventaris/inventaris-peralatan-komputer/gpu', [InventarisController::class, 'index']);
    Route::get('inventaris/inventaris-peralatan-komputer/psu', [InventarisController::class, 'index']);
    Route::get('inventaris/inventaris-peralatan-komputer/casing', [InventarisController::class, 'index']);

    //users
    // Route::resource('users', [UsersController::class, 'index']);
    // Route::get('users/create', [UsersController::class, 'create']);
    // Route::post('users', [UsersController::class, 'store']);


    //Peminjaman
    Route::get('peminjaman', [PeminjamanController::class, 'index']);
    Route::get('pengembalian/{id}', [PeminjamanController::class, 'form_pengembalian']);
    Route::get('tambah/peminjaman', [PeminjamanController::class, 'form_tambah_peminjaman']);
    Route::post('tambah/peminjaman', [PeminjamanController::class, 'tambah_peminjaman']);
    Route::post('proses/pengembalian/{id}', [PeminjamanController::class, 'pengembalian']);
    Route::delete('hapus/peminjaman/{id}', [PeminjamanController::class, 'hapus']);
    // Vendor
    Route::get('/vendor', [VendorController::class, 'index']);
    Route::post('tambah/vendor', [VendorController::class, 'tambah_vendor']);
    Route::put('update/vendor/{id}', [VendorController::class, 'update_vendor']);
    Route::delete('hapus/vendor/{id}', [VendorController::class, 'hapus_vendor']);
    Route::get('detail/vendor/{id}', [VendorController::class, 'detail']);
    Route::post('checked/vendor', [VendorController::class, 'checked']);
    Route::get('validasi_vendor/{nama}', [VendorController::class, 'validasi_nama_vendor_tambah']);
    Route::get('validasi_edit_vendor/{kode}/{nama}', [VendorController::class, 'validasi_edit_nama_vendor']);

    //Dashboard
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


Auth::routes();

