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
use Exception;
use Illuminate\Http\Request;

class InventarisPeralatanKomputer extends Controller
{
    //
    public function index(){
        $lokasi = Ruangan::get();
        $vendor = Vendor::get();
        return view('inventaris.peralatan_komputer.create', compact('lokasi','vendor'));
    }
    //Inventaris Motherboard
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
    public function hapus_inv_motherboard($id){
        try {
            //code...
            Motherboard::findOrFail($id)->delete();
            return redirect('inventaris/peralatan-komputer')->with('message','Data Berhasil dihapus');
        } catch (Exception $e) {
            //throw $th;
            return redirect('inventaris/peralatan-komputer')->with('message', 'Data Gagal dihapus');
        }
    }
    public function form_ubah_motherboard($id){
        $lokasi = Ruangan::get();
        $vendor = Vendor::get();
        $data = Motherboard::findOrFail($id);
        return view('inventaris.peralatan_komputer.motherboard.edit',compact('data','lokasi','vendor'));
    }
    public function ubah($id,request $request)
    {
        if (!$request->has('lokasi_mb') && !$request->has('keterangan_mb')) {
            $harga = $request->harga_mb;
            $harga = preg_replace('/[^0-9]/', '', $harga);
            $data = Motherboard::findOrFail($id);
            $saved = $data->update([
                'namaMotherboard' => $request->nama_motherboard,
                'chipsetMotherboard' => $request->chipset_mb,
                'socketMotherboard' => $request->socket_mb,
                'formFactor' => $request->form_factor,
                'memoriSlot' => $request->memori_slot,
                'memoriSupport' => $request->memori_support,
                'idVendor' => $request->vendor_mb,
                'harga' => $harga,
                'tglPembelian' => $request->tanggal_pembelian_mb,
                'kondisi' => $request->kondisi_mb
            ]);
            if ($saved) {
                return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris Berhasil Diubah');
            } else {
                return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris Gagal Diubah');
            }
            dd($request->all());
        }
        // $title = "Detail Inventaris Motherboard";
        // $lokasi = Ruangan::get();
        // $vendor = Vendor::get();
        // $data = Motherboard::findOrFail($id);
        // return view('inventaris.peralatan_komputer.motherboard.edit', compact('data'));
    }
    public function detail_motherboard($id)
    {
        $title = "Detail Inventaris Motherboard";
        $lokasi = Ruangan::get();
        $vendor = Vendor::get();
        $data = Motherboard::findOrFail($id);
        return view('inventaris.peralatan_komputer.motherboard.detail', compact('title', 'lokasi', 'vendor', 'data'));
    }
    //CPU
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
            'memoriInterface' => "-",
            'kecepatanMemori' => "-",
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

    //berfungsi untuk mencetak atau menghapus data yang di ceklis
    public function checked_motherboard(request $request)
    {
        $kode_inventaris = [];
        for ($i = 0; $i < count($request->kode_inventaris); $i++) {
            $kode_inventaris[] = $request->kode_inventaris[$i];
        }
        if ($request->button == "hapus") {
            $data = Motherboard::whereIn('kodeInventaris', $kode_inventaris)
                ->delete();
            return redirect('inventaris/non-komputer')->with('message', 'Data Berhasil Dihapus!');
        } else {
            $data = Motherboard::select('kodeInventaris',  'tglPembelian')
            ->whereIn('kodeInventaris', $kode_inventaris)
                ->get();
            $namaBarang = "Motherboard";
            return view('inventaris.cetak', compact('data','namaBarang'));
        }
    }
    public function checked_processor(request $request)
    {
        $kode_inventaris = [];
        for ($i = 0; $i < count($request->kode_inventaris); $i++) {
            $kode_inventaris[] = $request->kode_inventaris[$i];
        }
        if ($request->button == "hapus") {
            $data = InventarisProcessor::whereIn('kodeInventaris', $kode_inventaris)
                ->delete();
            return redirect('inventaris/non-komputer')->with('message', 'Data Berhasil Dihapus!');
        } else {
            $data = InventarisProcessor::select('kodeInventaris',  'tglPembelian')
            ->whereIn('kodeInventaris', $kode_inventaris)
                ->get();
            $namaBarang = "Processor";
            return view('inventaris.cetak', compact('data', 'namaBarang'));
        }
    }
    public function checked_ram(request $request)
    {
        $kode_inventaris = [];
        for ($i = 0; $i < count($request->kode_inventaris); $i++) {
            $kode_inventaris[] = $request->kode_inventaris[$i];
        }
        if ($request->button == "hapus") {
            $data = InventarisRam::whereIn('kodeInventaris', $kode_inventaris)
                ->delete();
            return redirect('inventaris/non-komputer')->with('message', 'Data Berhasil Dihapus!');
        } else {
            $data = InventarisRam::select('kodeInventaris',  'tglPembelian')
            ->whereIn('kodeInventaris', $kode_inventaris)
                ->get();
            $namaBarang = "RAM";
            return view('inventaris.cetak', compact('data', 'namaBarang'));
        }
    }
    public function checked_psu(request $request)
    {
        $kode_inventaris = [];
        for ($i = 0; $i < count($request->kode_inventaris); $i++) {
            $kode_inventaris[] = $request->kode_inventaris[$i];
        }
        if ($request->button == "hapus") {
            $data = InventarisPsu::whereIn('kodeInventaris', $kode_inventaris)
                ->delete();
            return redirect('inventaris/non-komputer')->with('message', 'Data Berhasil Dihapus!');
        } else {
            $data = InventarisPsu::select('kodeInventaris',  'tglPembelian')
            ->whereIn('kodeInventaris', $kode_inventaris)
                ->get();
            $namaBarang = "PSU";
            return view('inventaris.cetak', compact('data', 'namaBarang'));
        }
    }
    public function checked_storage(request $request)
    {
        $kode_inventaris = [];
        for ($i = 0; $i < count($request->kode_inventaris); $i++) {
            $kode_inventaris[] = $request->kode_inventaris[$i];
        }
        if ($request->button == "hapus") {
            $data = InventarisStorage::whereIn('kodeInventaris', $kode_inventaris)
                ->delete();
            return redirect('inventaris/non-komputer')->with('message', 'Data Berhasil Dihapus!');
        } else {
            $data = InventarisStorage::select('kodeInventaris',  'tglPembelian')
            ->whereIn('kodeInventaris', $kode_inventaris)
                ->get();
            $namaBarang = "Storage";
            return view('inventaris.cetak', compact('data', 'namaBarang'));
        }
    }
    public function checked_gpu(request $request)
    {
        $kode_inventaris = [];
        for ($i = 0; $i < count($request->kode_inventaris); $i++) {
            $kode_inventaris[] = $request->kode_inventaris[$i];
        }
        if ($request->button == "hapus") {
            $data = InventarisGPU::whereIn('kodeInventaris', $kode_inventaris)
                ->delete();
            return redirect('inventaris/non-komputer')->with('message', 'Data Berhasil Dihapus!');
        } else {
            $data = InventarisGPU::select('kodeInventaris',  'tglPembelian')
            ->whereIn('kodeInventaris', $kode_inventaris)
                ->get();
            $namaBarang = "GPU";
            return view('inventaris.cetak', compact('data', 'namaBarang'));
        }
    }
    public function checked_casing(request $request)
    {
        $kode_inventaris = [];
        for ($i = 0; $i < count($request->kode_inventaris); $i++) {
            $kode_inventaris[] = $request->kode_inventaris[$i];
        }
        if ($request->button == "hapus") {
            $data = InventarisCasing::whereIn('kodeInventaris', $kode_inventaris)->delete();
            return redirect('inventaris/non-komputer')->with('message', 'Data Berhasil Dihapus!');
        } else {
            $data = InventarisCasing::select('kodeInventaris',  'tglPembelian')
            ->whereIn('kodeInventaris', $kode_inventaris)
                ->get();
            $namaBarang = "Casing";
            return view('inventaris.cetak', compact('data', 'namaBarang'));
        }
    }
}
