<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorController extends Controller
{
    //
    public function index(){
        $title = "Manajemen Vendor";
        return view('vendor.index',compact('title'));
    }
    public function tambah_vendor(request $request){
        return redirect('/vendor')->with('message','Vendor Berhasil Ditambahkan');
    }
}
