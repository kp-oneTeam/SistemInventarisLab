<?php

namespace App\Http\Controllers;

use App\Models\Motherboard;
use App\Models\Inventaris;
use App\Models\InventarisProcessor;
use App\Models\InventarisRam;
use App\Models\InventarisStorage;
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
    public function cpu(request $request){
        $harga = $request->harga;
        $harga = preg_replace('/[^0-9]/', '', $harga);
        $saved = InventarisProcessor::create([
            'kodeInventaris' => Inventaris::kode_inventaris(),
            'idRuangan' => $request->lokasi,
            'idVendor' => $request->vendor,
            'nomor_processor' => $request->nomor_processor,
            'nama' => $request->nama_processor,
            'generasi' => $request->generasi,
            'series' => $request->series,
            'kecepatan' => $request->kecepatan_processor,
            'jumlah_core' => $request->jumlah_core,
            'jumlah_thread' => $request->jumlah_thread,
            'socket' => $request->socket,
            'harga' => $harga,
            'tgl_pembelian' => $request->tanggal,
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan
        ]);

        if ($saved) {
            return redirect('inventaris')->with('message','data berhasil disimpan!');
        }
    }
    public function ram(request $request)
    {
        $harga = $request->harga;
        $harga = preg_replace('/[^0-9]/', '', $harga);
        $saved = InventarisRam::create([
            'kodeInventaris' => Inventaris::kode_inventaris(),
            'idRuangan' => $request->lokasi,
            'idVendor' => $request->vendor,
            'nama' => $request->nama_memory,
            'jenis_memory' => $request->jenis_memory,
            'tipe_memory' => $request->tipe_memory,
            'frekuensi_memory' => $request->frekuensi_memory,
            'kapasitas_memory' => $request->kapasitas_memory,
            'harga' => $harga,
            'tgl_pembelian' => $request->tanggal,
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan
        ]);

        if ($saved) {
            return redirect('inventaris')->with('message', 'data berhasil disimpan!');
        }
    }
    public function storage(request $request)
    {
        $harga = $request->harga;
        $harga = preg_replace('/[^0-9]/', '', $harga);
        $saved = InventarisStorage::create([
            'kodeInventaris' => Inventaris::kode_inventaris(),
            'idRuangan' => $request->lokasi,
            'idVendor' => $request->vendor,
            'nama_storage' => $request->nama_storage,
            'jenis_storage' => $request->jenis_storage,
            'kapasitas_storage' => $request->kapasitas_storage,
            'harga' => $harga,
            'tgl_pembelian' => $request->tanggal,
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan
        ]);

        if ($saved) {
            return redirect('inventaris')->with('message', 'data berhasil disimpan!');
        }
    }
}
