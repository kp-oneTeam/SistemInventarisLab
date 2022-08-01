<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventarisController extends Controller
{
    //
    public function index(){
        $title = "Inventaris";
        return view('inventaris.index',compact('title'));
    }
    public function form_tambah_inventaris()
    {
        $title = "Tambah Inventaris";
        return view('inventaris.create', compact('title'));
    }
    public function tambah_inventaris(request $request){
        return redirect('/inventaris')->with('message', 'Data Berhasil Disimpan');
    }
    public function form_ubah_inventaris($id){
        $title = "Ubah Inventaris";
        return view('inventaris.edit', compact('title'));
    }
    public function hapus_inventaris($id){
        return redirect('/inventaris')->with('message', 'Data Berhasil Dihapus');
    }
}
