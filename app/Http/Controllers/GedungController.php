<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class GedungController extends Controller
{
    //
    public function index(){
        $data = Gedung::get();
        $title = "Data Gedung";
        return view('gedung.index',compact('data','title'));
    }
    public function tambah_gedung(request $request){
        $saved = Gedung::create([
            'namaGedung' => $request->nama_gedung
        ]);
        try {
            return redirect('gedung')->with('message','Data Berhasil Disimpan!');
        } catch (\Throwable $th) {
            return redirect('gedung')->with('failed', 'Data Berhasil Disimpan!');
        }
    }
    public function update_gedung($id,request $request)
    {
        $gedung = Gedung::findOrFail($id);
        $saved = $gedung->update([
            'namaGedung' => $request->nama_gedung
        ]);
        try {
            return redirect('gedung')->with('message', 'Data Berhasil Diubah!');
        } catch (\Throwable $th) {
            return redirect('gedung')->with('failed', 'Data Berhasil Diubah!');
        }
    }
    public function hapus_gedung($id)
    {
        try {
            $gedung = Gedung::findOrFail($id);
            $gedung->delete();
            return redirect('gedung')->with('message', 'Data Berhasil Dihapus!');
        } catch (\Throwable $th) {
            return redirect('gedung')->with('failed', 'Data Gagal Dihapus!');
        }
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
