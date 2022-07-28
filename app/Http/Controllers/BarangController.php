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
}
