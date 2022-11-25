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

class InventarisController extends Controller
{
    //
    public function index(){
        $title = "Data Inventaris";
        $data = Inventaris::join('barang','barang.id','=','inventaris.idBarang')
            ->join('vendor', 'vendor.id', '=', 'inventaris.idVendor')
            ->join('ruangan', 'ruangan.id', '=', 'inventaris.idRuangan')
            ->select('kodeInventaris','namaBarang','spesifikasi','merk','kodeRuangan','namaRuangan','kondisi','keterangan','tgl_pembelian')
            ->get();
        //Peralatan Komputer
        $motherboard = Motherboard::join('vendor', 'vendor.id', '=', 'inventaris_motherboard.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_motherboard.idRuangan')
        ->select('inventaris_motherboard.id','kodeInventaris','namaMotherboard','chipsetMotherboard','socketMotherboard','formFactor','memoriSlot','memoriSupport','kodeRuangan','namaRuangan','namaVendor','harga','tglPembelian','kondisi','keterangan')
        ->get();
        $processor = InventarisProcessor::join('vendor', 'vendor.id', '=', 'inventaris_processor.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_processor.idRuangan')
        ->select('inventaris_processor.id','kodeInventaris','namaProcessor','nomorProcessor','generasi','series','kecepatan','jumlahCore','jumlahThread','socket','kodeRuangan','namaRuangan','namaVendor','harga','tglPembelian','kondisi','keterangan')
        ->get();
        $ram = InventarisRam::join('vendor', 'vendor.id', '=', 'inventaris_ram.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_ram.idRuangan')
        ->select('inventaris_ram.id','kodeInventaris','namaMemory','jenisMemory','tipeMemory','kapasitasMemory','frekuensiMemory','namaRuangan','idRuangan','namaVendor','harga','tglPembelian','kondisi','keterangan')
        ->get();
        $storage = InventarisStorage::join('vendor', 'vendor.id', '=', 'inventaris_storage.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_storage.idRuangan')
        ->select('inventaris_storage.id','kodeInventaris','namaStorage','jenisStorage','kapasitasStorage','namaRuangan','idRuangan','namaVendor','harga','tglPembelian','kondisi','keterangan')
        ->get();
        $gpu = InventarisGPU::join('vendor', 'vendor.id', '=', 'inventaris_gpu.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_gpu.idRuangan')
        ->select('inventaris_gpu.id','kodeInventaris','namaGpu','ukuranMemori','memoriInterface','kecepatanMemori','tipeMemori','namaRuangan','idRuangan','namaVendor','harga','tglPembelian','kondisi','keterangan')
        ->get();
        $psu = InventarisPsu::join('vendor', 'vendor.id', '=', 'inventaris_psu.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_psu.idRuangan')
        ->select('inventaris_psu.id','kodeInventaris','namaPsu','formFactor','jenisKabel','besarDaya','sertifikasiPsu','namaRuangan','idRuangan','namaVendor','harga','tglPembelian','kondisi','keterangan')
        ->get();
        $casing = InventarisCasing::join('vendor', 'vendor.id', '=', 'inventaris_casing.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_casing.idRuangan')
        ->select('inventaris_casing.id','kodeInventaris','namaCasing','formFactor','namaRuangan','idRuangan','namaVendor','harga','tglPembelian','kondisi','keterangan')
        ->get();

        $komputer = InventarisKomputer::get();
        return view('inventaris.index',compact('title','data','motherboard','processor','ram','storage','gpu','psu','casing','komputer'));
    }
    public function form_tambah_inventaris()
    {
        $title = "Tambah Data Inventaris";
        $barang = Barang::get();
        $lokasi = Ruangan::get();
        $vendor = Vendor::get();
        return view('inventaris.create', compact('title','barang','lokasi','vendor'));
    }
    public function tambah_inventaris(request $request){
        $harga = $request->harga;
        $harga = preg_replace('/[^0-9]/', '', $harga);
        $kodeinv = KodeInv::create(['kodeInventaris' => KodeInv::kode_inventaris()]);
        $saved = Inventaris::create([
            'kodeInventaris' =>$kodeinv->kodeInventaris,
            'idBarang' => $request->nama_barang,
            'idRuangan' => $request->lokasi,
            'idVendor' => $request->vendor,
            'spesifikasi' => $request->spek,
            'merk' => $request->merk,
            'harga' => $harga,
            'tgl_pembelian' => $request->tanggal,
            'kondisi' => $request->kondisi,
            'keterangan' => (empty($request->keterangan) ? "-" : $request->keterangan)
        ]);
        return redirect('/inventaris/non-komputer')->with('message', 'Data Berhasil Disimpan');
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
            'merk' => $request->merk,
            'harga' => $harga,
            'tgl_pembelian' => $request->tanggal,
            'kondisi' => $request->kondisi,
            'keterangan' => ($request->keterangan ?? "-")
        ]);
        return redirect('/inventaris/non-komputer')->with('message', 'Data Berhasil Diubah');
    }
    public function hapus_inventaris($id){
        $data = Inventaris::where('kodeInventaris', $id)->delete();
        return redirect('/inventaris/non-komputer')->with('message', 'Data Berhasil Dihapus');
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
            return redirect('inventaris/non-komputer')->with('message','Data Berhasil Dihapus!');
        }else{
            $data = Inventaris::join('barang', 'barang.id', '=', 'inventaris.idBarang')
            ->join('vendor', 'vendor.id', '=', 'inventaris.idVendor')
            ->join('ruangan', 'ruangan.id', '=', 'inventaris.idRuangan')
            ->select('inventaris.id','kodeInventaris', 'namaBarang', 'tgl_pembelian')
            ->whereIn('kodeInventaris',$kode_inventaris)
            ->get();
            $namaBarang = "non-komputer";
            return view('inventaris.cetak',compact('data','namaBarang'));
        }
    }

    //Detail Inventaris
    public function detail($kode_inventaris){
        $data = Inventaris::where('kodeInventaris',$kode_inventaris)->first();
        return view('inventaris.detail',compact('data'));
    }

    //Mobile
    public function mobile($id){
        $data = Inventaris::where('id', $id)->first();
        return view('inventaris.mobile', compact('data'));
    }
}
