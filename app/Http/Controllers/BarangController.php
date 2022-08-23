<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Inventaris;

class BarangController extends Controller
{
    //
    public function index(){
        $title = "Manajemen Barang";
        $data = Barang::get();
        return view('barang.index',compact('title','data'));
    }
    public function tambah_barang(request $request){
        $saved = Barang::create([
            'kodeBarang' => $request->kode_barang,
            'namaBarang' => $request->nama_barang
        ]);
        if ($saved) {
            return redirect('/barang')->with('message','Barang Berhasil Ditambahkan');
        }else{
            return redirect('/barang')->with('message', 'Barang Gagal Ditambahkan');
        }
    }
    public function update_barang($id,request $request){
        $data = Barang::where('kodeBarang', '=', $id)->update([
            'namaBarang' => $request->nama_barang
        ]);
        return redirect('/barang')->with('message', 'Barang Berhasil Diubah');
    }
    public function hapus_barang($id)
    {
        $data = Barang::where('kodeBarang','=',$id)->delete();
        return redirect('/barang')->with('message', 'Barang Berhasil Dihapus');
    }
    public function detail_barang($id){
        $title = "Detail Data Barang";
        $barang = Barang::where('kodeBarang',$id)->first();
        $data = Inventaris::join('barang', 'barang.id', '=', 'inventaris.idBarang')
        ->join('vendor', 'vendor.id', '=', 'inventaris.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris.idRuangan')
        ->select('kodeInventaris', 'namaBarang', 'spesifikasi', 'namaRuangan', 'kondisi', 'keterangan', 'tgl_pembelian')
        ->where('barang.id',$barang->id)
        ->get();
        return view('barang.detail',compact('title','data','barang'));
    }
    public function validasi_nama_barang_tambah($nama){
        $data = Barang::where('namaBarang',$nama)->first();
        if($data != null){
            return response()->json([
                'status' => true,
                'message' => "Nama Barang Sudah Digunakan"
            ]);
        }else{
            return response()->json([
                'status' => false
            ]);
        }
    }
    public function validasi_edit_nama_barang($kode,$nama){
        $data = Barang::where('namaBarang',$nama)->where('kodeBarang','!=',$kode)->first();
        if ($data != null) {
            return response()->json([
                'status' => true,
                'message' => "Nama Barang Sudah Digunakan"
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }
}
