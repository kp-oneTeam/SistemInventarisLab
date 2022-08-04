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
            'namaVendor' => $request->nama_vendor,
            'teleponVendor' => $request->telepon_vendor,
            'alamatVendor' => $request->alamat_vendor
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
    public function validasi_nama_vendor_tambah($nama){
        $data = Vendor::where('namaVendor',$nama)->first();
        if($data != null){
            return response()->json([
                'status' => true,
                'message' => "Nama Vendor Sudah Digunakan"
            ]);
        }else{
            return response()->json([
                'status' => false
            ]);
        }
    }
    public function validasi_edit_nama_vendor($kode,$nama){
        $data = Vendor::where('namaVendor',$nama)->where('kodeVendor','!=',$kode)->first();
        if ($data != null) {
            return response()->json([
                'status' => true,
                'message' => "Nama Vendor Sudah Digunakan"
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }
}
