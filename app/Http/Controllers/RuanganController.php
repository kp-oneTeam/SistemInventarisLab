<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Gedung;
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

class RuanganController extends Controller
{
    //
    public function index(){
        $title = "Manajemen Ruangan";
        $data = Ruangan::get();
        $gedung = Gedung::get();
        return view('ruangan.index',compact('title', 'data','gedung'));
    }
    public function tambah_ruangan(request $request){
        try {
            $saved = Ruangan::create([
                'kodeRuangan' => $request->kode_ruangan,
                'namaRuangan' => $request->nama_ruangan,
                'idGedung' => $request->gedung
            ]);
            return redirect('/ruangan')->with('message','Data Ruangan Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/ruangan')->with('failed','Data Ruangan Gagal Ditambahkan');
        }
    }
    public function update_ruangan($id,request $request){
        try {
            $data = Ruangan::where('id', '=', $id)->update([
                'namaRuangan' => $request->nama_ruangan,
                'namaGedung' => $request->nama_gedung
            ]);
            return redirect('/ruangan')->with('message', 'Data Ruangan Berhasil Diubah');
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/ruangan')->with('failed', 'Data Ruangan Berhasil Diubah');
        }
    }
    public function hapus_ruangan($id)
    {
        try {
            $data = Ruangan::where('id','=',$id)->delete();
            return redirect('/ruangan')->with('message', 'Data Ruangan Berhasil Dihapus');
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/ruangan')->with('failed', 'Data Ruangan Gagal Dihapus');
        }
    }
    public function detail($id){
        $title = "Detail Ruangan";
        $data = Ruangan::findOrFail($id);
        $inventaris = Inventaris::join('barang', 'barang.id', '=', 'inventaris.idBarang')
        ->join('vendor', 'vendor.id', '=', 'inventaris.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris.idRuangan')
        ->select('kodeInventaris', 'namaBarang', 'spesifikasi', 'kodeRuangan', 'namaRuangan', 'kondisi', 'keterangan', 'tgl_pembelian')
        ->where('ruangan.id',$id)
        ->get();
        //Peralatan Komputer
        $motherboard = Motherboard::join('vendor', 'vendor.id', '=', 'inventaris_motherboard.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_motherboard.idRuangan')
        ->select('inventaris_motherboard.id', 'kodeInventaris', 'namaMotherboard', 'chipsetMotherboard', 'socketMotherboard', 'formFactor', 'memoriSlot', 'memoriSupport', 'kodeRuangan', 'namaRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->where('ruangan.id',$id)
        ->get();
        $processor = InventarisProcessor::join('vendor', 'vendor.id', '=', 'inventaris_processor.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_processor.idRuangan')
        ->select('inventaris_processor.id', 'kodeInventaris', 'namaProcessor', 'nomorProcessor', 'generasi', 'series', 'kecepatan', 'jumlahCore', 'jumlahThread', 'socket', 'kodeRuangan', 'namaRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->where('ruangan.id',$id)
        ->get();
        $ram = InventarisRam::join('vendor', 'vendor.id', '=', 'inventaris_ram.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_ram.idRuangan')
        ->select('inventaris_ram.id', 'kodeInventaris', 'namaMemory', 'jenisMemory', 'tipeMemory', 'kapasitasMemory', 'frekuensiMemory', 'namaRuangan', 'idRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->where('ruangan.id',$id)
        ->get();
        $storage = InventarisStorage::join('vendor', 'vendor.id', '=', 'inventaris_storage.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_storage.idRuangan')
        ->select('inventaris_storage.id', 'kodeInventaris', 'namaStorage', 'jenisStorage', 'kapasitasStorage', 'namaRuangan', 'idRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->where('ruangan.id',$id)
        ->get();
        $gpu = InventarisGPU::join('vendor', 'vendor.id', '=', 'inventaris_gpu.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_gpu.idRuangan')
        ->select('inventaris_gpu.id', 'kodeInventaris', 'namaGpu', 'ukuranMemori', 'memoriInterface', 'kecepatanMemori', 'tipeMemori', 'namaRuangan', 'idRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->where('ruangan.id',$id)
        ->get();
        $psu = InventarisPsu::join('vendor', 'vendor.id', '=', 'inventaris_psu.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_psu.idRuangan')
        ->select('inventaris_psu.id', 'kodeInventaris', 'namaPsu', 'formFactor', 'jenisKabel', 'besarDaya', 'sertifikasiPsu', 'namaRuangan', 'idRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->where('ruangan.id',$id)
        ->get();
        $casing = InventarisCasing::join('vendor', 'vendor.id', '=', 'inventaris_casing.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_casing.idRuangan')
        ->select('inventaris_casing.id', 'kodeInventaris', 'namaCasing', 'formFactor', 'namaRuangan', 'idRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->where('ruangan.id',$id)
        ->get();

        $komputer = InventarisKomputer::where('idRuangan',$id)->get();
        return view('ruangan.detail', compact('title', 'data','inventaris', 'motherboard', 'processor', 'ram', 'storage', 'gpu', 'psu', 'casing', 'komputer'));
    }
    public function validasi_nama_ruangan_tambah($nama){
        $data = Ruangan::where('namaRuangan',$nama)->first();
        if($data != null){
            return response()->json([
                'status' => true,
                'message' => "Nama Ruangan Sudah Digunakan"
            ]);
        }else{
            return response()->json([
                'status' => false
            ]);
        }
    }
    public function validasi_kode_ruangan_tambah($kode)
    {
        $data = Ruangan::where('kodeRuangan', $kode)->first();
        if ($data != null) {
            return response()->json([
                'status' => true,
                'message' => "Kode Ruangan Sudah Digunakan"
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }
    public function validasi_edit_nama_ruangan($kode,$nama){
        $data = Ruangan::where('namaRuangan',$nama)->where('kodeRuangan','!=',$kode)->first();
        if ($data != null) {
            return response()->json([
                'status' => true,
                'message' => "Nama Ruangan Sudah Digunakan"
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }
    public function checked(request $request){
        $kode_ruangan = [];
        for ($i=0; $i < count($request->kode_ruangan) ; $i++) {
            $kode_ruangan[] = $request->kode_ruangan[$i];
        }
        if ($request->button == "hapus") {
            $data = Ruangan::whereIn('kodeRuangan', $kode_ruangan)
                ->delete();
            return redirect('/ruangan')->with('message','Ruangan Berhasil Dihapus!');
        }
    }
    public function get_gedung($id){
        $data = Gedung::where('id','!=',$id)->pluck('namaGedung','id');
        return $data;
    }
}
