<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Inventaris;
use App\Models\InventarisKomputer;
use App\Models\Ruangan;
use App\Models\SpesifikasiKomputer;
use App\Models\Vendor;
use App\Models\Motherboard;
use App\Models\InventarisCasing;
use App\Models\InventarisGPU;
use App\Models\InventarisProcessor;
use App\Models\InventarisPsu;
use App\Models\InventarisRam;
use App\Models\InventarisStorage;
use App\Models\KodeInv;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(){
        $title = 'Dashboard';
        $data = Inventaris::join('barang', 'barang.id', '=', 'inventaris.idBarang')
        ->join('vendor', 'vendor.id', '=', 'inventaris.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris.idRuangan')
        ->select('kodeInventaris', 'namaBarang', 'spesifikasi', 'kodeRuangan', 'namaRuangan', 'kondisi', 'keterangan', 'tgl_pembelian')
        ->get();
        //Peralatan Komputer
        $motherboard = Motherboard::join('vendor', 'vendor.id', '=', 'inventaris_motherboard.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_motherboard.idRuangan')
        ->select('inventaris_motherboard.id', 'kodeInventaris', 'namaMotherboard', 'chipsetMotherboard', 'socketMotherboard', 'formFactor', 'memoriSlot', 'memoriSupport', 'kodeRuangan', 'namaRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->get();
        $processor = InventarisProcessor::join('vendor', 'vendor.id', '=', 'inventaris_processor.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_processor.idRuangan')
        ->select('inventaris_processor.id', 'kodeInventaris', 'namaProcessor', 'nomorProcessor', 'generasi', 'series', 'kecepatan', 'jumlahCore', 'jumlahThread', 'socket', 'kodeRuangan', 'namaRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->get();
        $ram = InventarisRam::join('vendor', 'vendor.id', '=', 'inventaris_ram.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_ram.idRuangan')
        ->select('inventaris_ram.id', 'kodeInventaris', 'namaMemory', 'jenisMemory', 'tipeMemory', 'kapasitasMemory', 'frekuensiMemory', 'namaRuangan', 'idRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->get();
        $storage = InventarisStorage::join('vendor', 'vendor.id', '=', 'inventaris_storage.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_storage.idRuangan')
        ->select('inventaris_storage.id', 'kodeInventaris', 'namaStorage', 'jenisStorage', 'kapasitasStorage', 'namaRuangan', 'idRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->get();
        $gpu = InventarisGPU::join('vendor', 'vendor.id', '=', 'inventaris_gpu.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_gpu.idRuangan')
        ->select('inventaris_gpu.id', 'kodeInventaris', 'namaGpu', 'ukuranMemori', 'memoriInterface', 'kecepatanMemori', 'tipeMemori', 'namaRuangan', 'idRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->get();
        $psu = InventarisPsu::join('vendor', 'vendor.id', '=', 'inventaris_psu.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_psu.idRuangan')
        ->select('inventaris_psu.id', 'kodeInventaris', 'namaPsu', 'formFactor', 'jenisKabel', 'besarDaya', 'sertifikasiPsu', 'namaRuangan', 'idRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->get();
        $casing = InventarisCasing::join('vendor', 'vendor.id', '=', 'inventaris_casing.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_casing.idRuangan')
        ->select('inventaris_casing.id', 'kodeInventaris', 'namaCasing', 'formFactor', 'namaRuangan', 'idRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->get();

        $komputer = InventarisKomputer::get();
        $inv_non_komputer = [];
        $inv_komputer = [];
        $ruangan = Ruangan::get();
        foreach ($ruangan as $r) {
            $temp = Inventaris::where('idRuangan', $r->id)->count();
            $temp2 = InventarisKomputer::where('idRuangan', $r->id)->count();
            array_push($inv_non_komputer, [
                "idRuangan" => $r->id,
                "namaRuangan" => $r->namaRuangan,
                "jumlah" => $temp
            ]);
            array_push($inv_komputer, [
                "idRuangan" => $r->id,
                "namaRuangan" => $r->namaRuangan,
                "jumlah" => $temp2
            ]);
        }
        // foreach ($inv_non_komputer as $key) {
        //     # code...
        //     dd($key['namaRuangan']);
        // }
        return view('dashboard.index', compact('title','inv_komputer','inv_non_komputer', 'data', 'motherboard', 'processor', 'ram', 'storage', 'gpu', 'psu', 'casing', 'komputer'));
    }
}
