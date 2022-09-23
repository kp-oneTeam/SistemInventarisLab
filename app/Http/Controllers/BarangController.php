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
        try {
            $saved = Barang::create([
                // 'kodeBarang' => $request->kode_barang,
                'namaBarang' => $request->nama_barang
            ]);
            return redirect('/barang')->with('message','Data Barang Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/barang')->with('failed', 'Data Barang Gagal Ditambahkan');
        }
    }
    public function update_barang($id,request $request){
        try {
            $data = Barang::findOrFail($id)->update([
                'namaBarang' => $request->nama_barang
            ]);
            return redirect('/barang')->with('message', 'Data Barang Berhasil Diubah');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/barang')->with('failed', 'Data Barang Gagal Diubah');
        }
    }
    public function hapus_barang($id)
    {
        try {
            $data = Barang::where('id','=',$id)->delete();
            return redirect('/barang')->with('message', 'Data Barang Berhasil Dihapus');
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/barang')->with('failed', 'Data Barang Gagal Dihapus');
        }
    }
    public function detail_barang($id){
        $title = "Detail Data Barang";
        $barang = Barang::where('id',$id)->first();
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
        $data = Barang::where('namaBarang',$nama)->where('id','!=',$kode)->first();
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
