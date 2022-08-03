<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    //
    public function index(){
        $title = "Manajemen Ruangan";
        $data = Ruangan::get();
        return view('ruangan.index',compact('title', 'data'));
    }
    public function tambah_ruangan(request $request){
        $saved = Ruangan::create([
            'kodeRuangan' => $request->kode_ruangan,
            'namaRuangan' => $request->nama_ruangan,
            'namaGedung' => $request->nama_gedung
        ]);
        if ($saved) {
            return redirect('/ruangan')->with('message','Ruangan Berhasil Ditambahkan');
        }else{
            return redirect('/ruangan')->with('message','Ruangan Gagal Ditambahkan');
        }
    }
    public function update_ruangan($id,request $request){
        $data = Ruangan::where('kodeRuangan', '=', $id)->update([
            'namaRuangan' => $request->nama_ruangan,
            'namaGedung' => $request->nama_gedung
        ]);
        return redirect('/ruangan')->with('message', 'Ruangan Berhasil Diubah');
    }
    public function hapus_ruangan($id)
    {
        $data = Ruangan::where('kodeRuangan','=',$id)->delete();
        return redirect('/ruangan')->with('message', 'Ruangan Berhasil Dihapus');
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
}
