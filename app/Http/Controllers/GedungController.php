<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use Illuminate\Http\Request;

class GedungController extends Controller
{
    //
    public function index(){
        $data = Gedung::get();
        $title = "Data Gedung";
        return view('gedung.index',compact('data'));
    }
    public function tambah_gedung(request $request){
        $saved = Gedung::create([
            'namaGedung' => $request->nama_gedung
        ]);
        if ($saved) {
            return redirect('gedung')->with('message','Data Berhasil Disimpan!');
        }
    }
    public function update_gedung($id,request $request)
    {
        $gedung = Gedung::findOrFail($id);
        $saved = $gedung->update([
            'namaGedung' => $request->nama_gedung
        ]);
        return redirect('gedung')->with('message', 'Data Berhasil Diupdate!');
    }
    public function hapus_gedung($id)
    {
        $gedung = Gedung::findOrFail($id);
        $gedung->delete();
        return redirect('gedung')->with('message', 'Data Berhasil Dihapus!');
    }
    public function validasi_nama_gedung_tambah($nama)
    {
        $data = Gedung::where('namaGedung', $nama)->first();
        if ($data != null) {
            return response()->json([
                'status' => true,
                'message' => "Nama Gedung Sudah Digunakan"
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }
    public function validasi_edit_nama_gedung($id, $nama)
    {
        $data = Gedung::where('namaGedung', $nama)->where('id', '!=', $id)->first();
        if ($data != null) {
            return response()->json([
                'status' => true,
                'message' => "Nama Gedung Sudah Digunakan"
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }
}
