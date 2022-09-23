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

class VendorController extends Controller
{
    //
    public function index(){
        $title = "Manajemen Vendor";
        $data = Vendor::get();
        return view('vendor.index',compact('title', 'data'));
    }
    public function tambah_vendor(request $request){
        try {
            //code...
            $saved = Vendor::create([
                // 'kodeVendor' => $request->kode_vendor,
                'namaVendor' => $request->nama_vendor,
                'teleponVendor' => $request->telepon_vendor,
                'alamatVendor' => $request->alamat_vendor
            ]);
            return redirect('/vendor')->with('message', 'Data Vendor Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/vendor')->with('failed', 'Data Vendor Gagal Ditambahkan');
        }
    }
    public function update_vendor($id,request $request){
        try {
            $data = Vendor::where('id', '=', $id)->update([
                'namaVendor' => $request->nama_vendor
            ]);
            return redirect('/vendor')->with('message', 'Data Vendor Berhasil Diubah');
        } catch (\Throwable $th) {
            return redirect('/vendor')->with('failed', 'Data Vendor Gagal Diubah');
        }
    }
    public function hapus_vendor($id)
    {
        try {
            $data = Vendor::where('id','=',$id)->delete();
            return redirect('/vendor')->with('message', 'Vendor Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect('/vendor')->with('failed', 'Data Vendor Gagal Diubah');
        }
    }
    public function validasi_nama_vendor_tambah($nama){
        $data = Vendor::where('namaVendor',$nama)->first();
        if($data != null){
            return response()->json([
                'status' => true,
                'message' => "Nama Vendor Sudah Digunakan"
            ]);
        }else{
            return response()->json([
                'status' => false
            ]);
        }
    }
    public function validasi_edit_nama_vendor($kode,$nama){
        $data = Vendor::where('namaVendor',$nama)->where('id','!=',$kode)->first();
        if ($data != null) {
            return response()->json([
                'status' => true,
                'message' => "Nama Vendor Sudah Digunakan"
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }
    public function detail($id){
        $title = "Detail Data Vendor";
        $data = Vendor::findOrFail($id);
        $inventaris = Inventaris::join('barang', 'barang.id', '=', 'inventaris.idBarang')
        ->join('vendor', 'vendor.id', '=', 'inventaris.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris.idRuangan')
        ->select('kodeInventaris', 'namaBarang', 'spesifikasi', 'namaRuangan', 'kondisi', 'keterangan', 'tgl_pembelian')
        ->where('vendor.id', $id)
        ->get();
        //peralatan komputer
        $motherboard = Motherboard::join('vendor', 'vendor.id', '=', 'inventaris_motherboard.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_motherboard.idRuangan')
        ->select('inventaris_motherboard.id', 'kodeInventaris', 'namaMotherboard', 'chipsetMotherboard', 'socketMotherboard', 'formFactor', 'memoriSlot', 'memoriSupport', 'kodeRuangan', 'namaRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->where('vendor.id', $id)
        ->get();
        $processor = InventarisProcessor::join('vendor', 'vendor.id', '=', 'inventaris_processor.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_processor.idRuangan')
        ->select('inventaris_processor.id', 'kodeInventaris', 'namaProcessor', 'nomorProcessor', 'generasi', 'series', 'kecepatan', 'jumlahCore', 'jumlahThread', 'socket', 'kodeRuangan', 'namaRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->where('vendor.id', $id)
        ->get();
        $ram = InventarisRam::join('vendor', 'vendor.id', '=', 'inventaris_ram.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_ram.idRuangan')
        ->select('inventaris_ram.id', 'kodeInventaris', 'namaMemory', 'jenisMemory', 'tipeMemory', 'kapasitasMemory', 'frekuensiMemory', 'namaRuangan', 'idRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->where('vendor.id', $id)
        ->get();
        $storage = InventarisStorage::join('vendor', 'vendor.id', '=', 'inventaris_storage.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_storage.idRuangan')
        ->select('inventaris_storage.id', 'kodeInventaris', 'namaStorage', 'jenisStorage', 'kapasitasStorage', 'namaRuangan', 'idRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->where('vendor.id', $id)
        ->get();
        $gpu = InventarisGPU::join('vendor', 'vendor.id', '=', 'inventaris_gpu.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_gpu.idRuangan')
        ->select('inventaris_gpu.id', 'kodeInventaris', 'namaGpu', 'ukuranMemori', 'memoriInterface', 'kecepatanMemori', 'tipeMemori', 'namaRuangan', 'idRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->where('vendor.id', $id)
        ->get();
        $psu = InventarisPsu::join('vendor', 'vendor.id', '=', 'inventaris_psu.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_psu.idRuangan')
        ->select('inventaris_psu.id', 'kodeInventaris', 'namaPsu', 'formFactor', 'jenisKabel', 'besarDaya', 'sertifikasiPsu', 'namaRuangan', 'idRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->where('vendor.id', $id)
        ->get();
        $casing = InventarisCasing::join('vendor', 'vendor.id', '=', 'inventaris_casing.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_casing.idRuangan')
        ->select('inventaris_casing.id', 'kodeInventaris', 'namaCasing', 'formFactor', 'namaRuangan', 'idRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->where('vendor.id', $id)
        ->get();
        return view('vendor.detail',compact('data','title','inventaris', 'motherboard', 'processor', 'ram', 'storage', 'gpu', 'psu', 'casing'));
    }
}
