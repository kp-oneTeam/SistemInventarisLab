<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Inventaris;
use App\Models\Ruangan;
use App\Models\Vendor;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    //
    public function index(){
        $title = "Inventaris";
        $data = Inventaris::join('barang','barang.kodeBarang','=','inventaris.kodeBarang')
            ->join('vendor', 'vendor.kodeVendor', '=', 'inventaris.kodeVendor')
            ->join('ruangan', 'ruangan.kodeRuangan', '=', 'inventaris.kodeRuangan')
            ->select('kodeInventaris','namaBarang','spesifikasi','namaRuangan','kondisi','keterangan','tgl_pembelian')
            ->get();
        return view('inventaris.index',compact('title','data'));
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
            'kodeBarang' => $request->nama_barang,
            'kodeRuangan' => $request->lokasi,
            'kodeVendor' => $request->vendor,
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
        return view('inventaris.edit', compact('title'));
    }
    public function hapus_inventaris($id){
        return redirect('/inventaris')->with('message', 'Data Berhasil Dihapus');
    }
    public function cetak(request $request){
        $kode_inventaris = [];
        for ($i=0; $i < count($request->kode_inventaris) ; $i++) {
            $kode_inventaris[] = $request->kode_inventaris[$i];
        }

        $data = Inventaris::join('barang', 'barang.kodeBarang', '=', 'inventaris.kodeBarang')
        ->join('vendor', 'vendor.kodeVendor', '=', 'inventaris.kodeVendor')
        ->join('ruangan', 'ruangan.kodeRuangan', '=', 'inventaris.kodeRuangan')
        ->select('kodeInventaris', 'namaBarang', 'tgl_pembelian')
        ->whereIn('kodeInventaris',$kode_inventaris)
        ->get();
        return view('inventaris.cetak',compact('data'));
    }
}
