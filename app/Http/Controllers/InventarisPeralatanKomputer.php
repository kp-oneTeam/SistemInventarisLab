<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Vendor;
use Illuminate\Http\Request;

class InventarisPeralatanKomputer extends Controller
{
    //
    public function index(){
        $lokasi = Ruangan::get();
        $vendor = Vendor::get();
        return view('inventaris.peralatan_komputer.create',compact('lokasi','vendor'));
    }
}
