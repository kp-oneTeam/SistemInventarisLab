<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    //
    public function index(){
        $title = "Manajemen Peminjaman";
        return view('peminjaman.index',compact('title'));
    }
    public function tambah_peminjaman(request $request){
        return redirect('/peminjaman')->with('message', 'Data Peminjaman Berhasil Disimpan');
    }
    public function form_tambah_peminjaman()
    {
        $title = "Tambah Peminjaman";
        return view('peminjaman.create', compact('title'));
    }
    public function form_pengembalian($id){
        $title = "Pengembalian Barang";
        return view('peminjaman.return',compact('title'));
    }
}
