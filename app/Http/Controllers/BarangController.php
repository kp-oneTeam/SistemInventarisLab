<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    //
    public function index(){
        $title = "Manajemen Barang";
        return view('barang.index',compact('title'));
    }
    public function tambah_barang(request $request){
        return redirect('/barang')->with('message','Barang Berhasil Ditambahkan');
    }
    public function hapus_barang($id)
    {
        return redirect('/barang')->with('message', 'Barang Berhasil Dihapus');
    }
    public function detail_barang($id){
        $title = "Detail Data Barang";
        return view('barang.detail',compact('title'));
    }
}
