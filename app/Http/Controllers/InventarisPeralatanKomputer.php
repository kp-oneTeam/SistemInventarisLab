<?php

namespace App\Http\Controllers;

use App\Models\Motherboard;
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
    public function tambah_inventaris_motherboard(request $request){
        $harga = $request->harga_mb;
        $harga = preg_replace('/[^0-9]/', '', $harga);
        $saved = Motherboard::create([
            'kodeInventaris' => Motherboard::kode_inventaris(),
            'namaMotherboard' => $request->nama_motherboard,
            'chipsetMotherboard' => $request->chipset_mb,
            'socketMotherboard' => $request->socket_mb,
            'memoriSlot' => $request->memori_slot,
            'memoriSupport' => $request->memori_support,
            'idRuangan' => $request->lokasi_mb,
            'idVendor' => $request->vendor_mb,
            'harga' => $harga,
            'tglPembelian' => $request->tanggal_pembelian_mb,
            'kondisi' => $request->kondisi_mb,
            'keterangan' => $request->keterangan_mb
        ]);
        if ($saved) {
            return redirect('/inventaris')->with('message','Inventaris Berhasil Ditambahkan');
        }else{
            return redirect('/inventaris')->with('message','Inventaris Gagal Ditambahkan');
        }
    }
}
