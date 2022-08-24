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
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    //
    public function index(){
        $title = "Inventaris";
        $data = Inventaris::join('barang','barang.id','=','inventaris.idBarang')
            ->join('vendor', 'vendor.id', '=', 'inventaris.idVendor')
            ->join('ruangan', 'ruangan.id', '=', 'inventaris.idRuangan')
            ->select('kodeInventaris','namaBarang','spesifikasi','namaRuangan','kondisi','keterangan','tgl_pembelian')
            ->get();
        $data2 = SpesifikasiKomputer::join('inventaris','inventaris.id','=', 'spesifikasi_komputer.idInventaris')
            ->join('inventaris_komputer', 'inventaris_komputer.id', '=', 'spesifikasi_komputer.idInventarisKomputer')
                ->join('barang', 'barang.id', '=', 'inventaris.idBarang')
                ->join('vendor', 'vendor.id', '=', 'inventaris.idVendor')
                ->join('ruangan', 'ruangan.id', '=', 'inventaris.idRuangan')
                ->select('kodeInventarisKomputer','kodeInventaris', 'namaBarang', 'spesifikasi', 'namaRuangan', 'inventaris_komputer.kondisi', 'inventaris_komputer.keterangan', 'tgl_pembelian')
                ->get();
        //Peralatan Komputer
        $motherboard = Motherboard::join('vendor', 'vendor.id', '=', 'inventaris_motherboard.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_motherboard.idRuangan')
        ->select('kodeInventaris','namaMotherboard','chipsetMotherboard','socketMotherboard','formFactor','memoriSlot','memoriSupport','namaRuangan','namaVendor','harga','tglPembelian','kondisi','keterangan')
        ->get();
        $processor = InventarisProcessor::join('vendor', 'vendor.id', '=', 'inventaris_processor.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_processor.idRuangan')
        ->select('kodeInventaris','nama_processor','nomor_processor','generasi','series','kecepatan','jumlah_core','jumlah_thread','socket','namaRuangan','namaVendor','harga','tgl_pembelian','kondisi','keterangan')
        ->get();
        $ram = InventarisRam::get();
        $storage = InventarisStorage::get();
        $gpu = InventarisGPU::get();
        $psu = InventarisPsu::get();
        $casing = InventarisCasing::get();
        return view('inventaris.index',compact('title','data','data2','motherboard','processor','ram','storage','gpu','psu','casing'));
    }
    public function form_tambah_inventaris()
    {
        $title = "Tambah Inventaris";
        $barang = Barang::get();
        $lokasi = Ruangan::get();
        $vendor = Vendor::get();
        return view('inventaris.create', compact('title','barang','lokasi','vendor'));
    }
    public function tambah_inventaris(request $request){
        $harga = $request->harga;
        $harga = preg_replace('/[^0-9]/', '', $harga);
        $saved = Inventaris::create([
            'kodeInventaris' =>Inventaris::kode_inventaris(),
            'idBarang' => $request->nama_barang,
            'idRuangan' => $request->lokasi,
            'idVendor' => $request->vendor,
            'spesifikasi' => $request->spek,
            'harga' => $harga,
            'tgl_pembelian' => $request->tanggal,
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan
        ]);
        return redirect('/inventaris')->with('message', 'Data Berhasil Disimpan');
    }
    public function form_ubah_inventaris($id){
        $title = "Ubah Inventaris";
        $barang = Barang::get();
        $lokasi = Ruangan::get();
        $vendor = Vendor::get();
        $data = Inventaris::where('kodeInventaris',$id)->first();
        return view('inventaris.edit', compact('title', 'barang', 'lokasi', 'vendor','data'));
    }
    public function ubah($kodeInventaris,request $request){
        $harga = $request->harga;
        $harga = preg_replace('/[^0-9]/', '', $harga);
        $data = Inventaris::where('kodeInventaris', $kodeInventaris)->update([
            'idBarang' => $request->nama_barang,
            'idRuangan' => $request->lokasi,
            'idVendor' => $request->vendor,
            'spesifikasi' => $request->spek,
            'harga' => $harga,
            'tgl_pembelian' => $request->tanggal,
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan
        ]);
        return redirect('/inventaris')->with('message', 'Data Berhasil Diubah');
    }
    public function hapus_inventaris($id){
        $data = Inventaris::where('kodeInventaris', $id)->delete();
        return redirect('/inventaris')->with('message', 'Data Berhasil Dihapus');
    }
    //berfungsi untuk mencetak atau menghapus data yang di ceklis
    public function checked(request $request){
        $kode_inventaris = [];
        for ($i=0; $i < count($request->kode_inventaris) ; $i++) {
            $kode_inventaris[] = $request->kode_inventaris[$i];
        }
        if ($request->button == "hapus") {
            $data = Inventaris::whereIn('kodeInventaris', $kode_inventaris)
                ->delete();
            return redirect('inventaris')->with('message','Data Berhasil Dihapus!');
        }else{
            $data = Inventaris::join('barang', 'barang.id', '=', 'inventaris.idBarang')
            ->join('vendor', 'vendor.id', '=', 'inventaris.idVendor')
            ->join('ruangan', 'ruangan.id', '=', 'inventaris.idRuangan')
            ->select('kodeInventaris', 'namaBarang', 'tgl_pembelian')
            ->whereIn('kodeInventaris',$kode_inventaris)
            ->get();
            return view('inventaris.cetak',compact('data'));
        }
    }

    //Detail Inventaris
    public function detail($kode_inventaris){
        $data = Inventaris::where('kodeInventaris',$kode_inventaris)->first();
        return view('inventaris.detail',compact('data'));
    }
}
