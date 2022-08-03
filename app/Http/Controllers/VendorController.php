<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    //
    public function index(){
        $title = "Manajemen Vendor";
        $data = Vendor::get();
        return view('vendor.index',compact('title', 'data'));
    }
    public function tambah_vendor(request $request){
        $saved = Vendor::create([
            'kodeVendor' => $request->kode_vendor,
            'namaVendor' => $request->nama_vendor
        ]);
        if ($saved) {
            return redirect('/vendor')->with('message','Vendor Berhasil Ditambahkan');
        }else{
            return redirect('/vendor')->with('message','Vendor Gagal Ditambahkan');
        }
    }
    public function update_vendor($id,request $request){
        $data = Vendor::where('kodeVendor', '=', $id)->update([
            'namaVendor' => $request->nama_vendor
        ]);
        return redirect('/vendor')->with('message', 'Ruangan Berhasil Diubah');
    }
    public function hapus_vendor($id)
    {
        $data = Vendor::where('kodeVendor','=',$id)->delete();
        return redirect('/vendor')->with('message', 'Vendor Berhasil Dihapus');
    }
}
