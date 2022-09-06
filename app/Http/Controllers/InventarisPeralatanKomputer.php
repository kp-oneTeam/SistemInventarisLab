<?php

namespace App\Http\Controllers;

use App\Models\Motherboard;
use App\Models\Inventaris;
use App\Models\InventarisCasing;
use App\Models\InventarisGPU;
use App\Models\InventarisProcessor;
use App\Models\InventarisPsu;
use App\Models\InventarisRam;
use App\Models\InventarisStorage;
use App\Models\Ruangan;
use App\Models\Vendor;
use App\Models\KodeInv;
use Illuminate\Http\Request;

class InventarisPeralatanKomputer extends Controller
{
    //
    public function index(){
        $lokasi = Ruangan::get();
        $vendor = Vendor::get();
        return view('inventaris.peralatan_komputer.create', compact('lokasi','vendor'));
    }
    public function tambah_inventaris_motherboard(request $request){
        $harga = $request->harga_mb;
        $harga = preg_replace('/[^0-9]/', '', $harga);
        $kodeinv = KodeInv::create(['kodeInventaris' => KodeInv::kode_inventaris()]);
        $saved = Motherboard::create([
            'kodeInventaris' =>$kodeinv->kodeInventaris,
            'namaMotherboard' => $request->nama_motherboard,
            'chipsetMotherboard' => $request->chipset_mb,
            'socketMotherboard' => $request->socket_mb,
            'formFactor' => $request->form_factor,
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
            return redirect('inventaris/peralatan-komputer')->with('message','Inventaris Berhasil Ditambahkan');
        }else{
            return redirect('inventaris/peralatan-komputer')->with('message','Inventaris Gagal Ditambahkan');
        }
    }
    public function cpu(request $request){
        $harga = $request->harga;
        $harga = preg_replace('/[^0-9]/', '', $harga);
        $kodeinv = KodeInv::create(['kodeInventaris' => KodeInv::kode_inventaris()]);
        $saved = InventarisProcessor::create([
            'kodeInventaris' => $kodeinv->kodeInventaris,
            'idRuangan' => $request->lokasi,
            'idVendor' => $request->vendor,
            'nomorProcessor' => $request->nomor_processor,
            'namaProcessor' => $request->nama_processor,
            'generasi' => $request->generasi,
            'series' => $request->series,
            'kecepatan' => $request->kecepatan_processor,
            'jumlahCore' => $request->jumlah_core,
            'jumlahThread' => $request->jumlah_thread,
            'socket' => $request->socket,
            'harga' => $harga,
            'tglPembelian' => $request->tanggal,
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan
        ]);

        if ($saved) {
            return redirect('inventaris/peralatan-komputer')->with('message','data berhasil disimpan!');
        }
    }
    public function ram(request $request)
    {
        $harga = $request->harga;
        $harga = preg_replace('/[^0-9]/', '', $harga);
        $kodeinv = KodeInv::create(['kodeInventaris' => KodeInv::kode_inventaris()]);
        $saved = InventarisRam::create([
            'kodeInventaris' => $kodeinv->kodeInventaris,
            'idRuangan' => $request->lokasi,
            'idVendor' => $request->vendor,
            'namaMemory' => $request->nama_memory,
            'jenisMemory' => $request->jenis_memory,
            'tipeMemory' => $request->tipe_memory,
            'frekuensiMemory' => $request->frekuensi_memory,
            'kapasitasMemory' => $request->kapasitas_memory,
            'harga' => $harga,
            'tglPembelian' => $request->tanggal,
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan
        ]);

        if ($saved) {
            return redirect('inventaris/peralatan-komputer')->with('message', 'data berhasil disimpan!');
        }
    }
    public function storage(request $request)
    {
        $harga = $request->harga;
        $harga = preg_replace('/[^0-9]/', '', $harga);
        $kodeinv = KodeInv::create(['kodeInventaris' => KodeInv::kode_inventaris()]);
        $saved = InventarisStorage::create([
            'kodeInventaris' => $kodeinv->kodeInventaris,
            'idRuangan' => $request->lokasi,
            'idVendor' => $request->vendor,
            'namaStorage' => $request->nama_storage,
            'jenisStorage' => $request->jenis_storage,
            'kapasitasStorage' => $request->kapasitas_storage,
            'harga' => $harga,
            'tglPembelian' => $request->tanggal,
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan
        ]);

        if ($saved) {
            return redirect('inventaris/peralatan-komputer')->with('message', 'data berhasil disimpan!');
        }
    }

    public function gpu(request $request){
        $harga = $request->harga_gpu;
        $harga = preg_replace('/[^0-9]/', '', $harga);
        $kodeinv = KodeInv::create(['kodeInventaris' => KodeInv::kode_inventaris()]);
        $saved = InventarisGPU::create([
            'kodeInventaris' => $kodeinv->kodeInventaris,
            'namaGpu' => $request->nama_gpu,
            'ukuranMemori' => $request->ukuran_memori_gpu,
            'memoriInterface' => $request->memori_interface_gpu,
            'kecepatanMemori' => $request->kecepatan_memori_gpu,
            'tipeMemori' => $request->tipe_memori_gpu,
            'idRuangan' => $request->lokasi_gpu,
            'idVendor' => $request->vendor_gpu,
            'harga' => $harga,
            'tglPembelian' => $request->tgl_pembelian_gpu,
            'kondisi' => $request->kondisi_gpu,
            'keterangan' => $request->keterangan_gpu
        ]);
        if ($saved) {
            return redirect('inventaris/peralatan-komputer')->with('message','Inventaris Berhasil Ditambahkan');
        }else{
            return redirect('inventaris/peralatan-komputer')->with('message','Inventaris Gagal Ditambahkan');
        }
    }

    public function psu(request $request){
        $harga = $request->harga_psu;
        $harga = preg_replace('/[^0-9]/', '', $harga);
        $kodeinv = KodeInv::create(['kodeInventaris' => KodeInv::kode_inventaris()]);
        $saved = InventarisPsu::create([
            'kodeInventaris' => $kodeinv->kodeInventaris,
            'namaPsu' => $request->nama_psu,
            'formFactor' => $request->form_factor_psu,
            'jenisKabel' => $request->jenis_kabel_psu,
            'besarDaya' => $request->besar_daya_psu,
            'sertifikasiPsu' => $request->sertifikasi_psu,
            'idRuangan' => $request->lokasi_psu,
            'idVendor' => $request->vendor_psu,
            'harga' => $harga,
            'tglPembelian' => $request->tgl_pembelian_psu,
            'kondisi' => $request->kondisi_psu,
            'keterangan' => $request->keterangan_psu
        ]);
        if ($saved) {
            return redirect('inventaris/peralatan-komputer')->with('message','Inventaris Berhasil Ditambahkan');
        }else{
            return redirect('inventaris/peralatan-komputer')->with('message','Inventaris Gagal Ditambahkan');
        }
    }

    public function casing(request $request){
        $harga = $request->harga_casing;
        $harga = preg_replace('/[^0-9]/', '', $harga);
        $kodeinv = KodeInv::create(['kodeInventaris' => KodeInv::kode_inventaris()]);
        $saved = InventarisCasing::create([
            'kodeInventaris' => $kodeinv->kodeInventaris,
            'namaCasing' => $request->nama_casing,
            'formFactor' => $request->form_factor_casing,
            'idRuangan' => $request->lokasi_casing,
            'idVendor' => $request->vendor_casing,
            'harga' => $harga,
            'tglPembelian' => $request->tgl_pembelian_casing,
            'kondisi' => $request->kondisi_casing,
            'keterangan' => $request->keterangan_casing
        ]);
        if ($saved) {
            return redirect('inventaris/peralatan-komputer')->with('message','Inventaris Berhasil Ditambahkan');
        }else{
            return redirect('inventaris/peralatan-komputer')->with('message','Inventaris Gagal Ditambahkan');
        }
    }
}
