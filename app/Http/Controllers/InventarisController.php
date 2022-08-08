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
        $data = Inventaris::join('barang','barang.id','=','inventaris.idBarang')
            ->join('vendor', 'vendor.id', '=', 'inventaris.idVendor')
            ->join('ruangan', 'ruangan.id', '=', 'inventaris.idRuangan')
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
            $data = Inventaris::join('barang', 'barang.kodeBarang', '=', 'inventaris.kodeBarang')
            ->join('vendor', 'vendor.kodeVendor', '=', 'inventaris.kodeVendor')
            ->join('ruangan', 'ruangan.kodeRuangan', '=', 'inventaris.kodeRuangan')
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
