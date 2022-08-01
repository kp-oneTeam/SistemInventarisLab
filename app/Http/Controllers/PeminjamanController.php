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
}
