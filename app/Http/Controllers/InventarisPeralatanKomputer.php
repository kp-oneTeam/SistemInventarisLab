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
            'keterangan' => ($request->keterangan_mb ?? "-")
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
    public function action_update_motherboard($id,request $request)
    {
        try {
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
                    return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris Motherboard Berhasil Diubah');
            }else{
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
                    'idRuangan' => $request->lokasi_mb,
                    'idVendor' => $request->vendor_mb,
                    'harga' => $harga,
                    'tglPembelian' => $request->tanggal_pembelian_mb,
                    'kondisi' => $request->kondisi_mb,
                    'keterangan' => ($request->keterangan_mb ?? "-")
                ]);
                return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris Motherboard Berhasil Diubah');
            }
            } catch (\Throwable $th) {
            return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris Motherboard Gagal Diubah');
            //throw $th;
        }
    }
    public function detail_motherboard($id)
    {
        $title = "Detail Inventaris Motherboard";
        $data = Motherboard::findOrFail($id);
        return view('inventaris.peralatan_komputer.motherboard.detail', compact('title','data'));
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
            'keterangan' => ($request->keterangan ?? "-")
        ]);

        if ($saved) {
            return redirect('inventaris/peralatan-komputer')->with('message','data berhasil disimpan!');
        }
    }
    public function hapus_inv_processor($id)
    {
        try {
            //code...
            InventarisProcessor::findOrFail($id)->delete();
            return redirect('inventaris/peralatan-komputer')->with('message', 'Data Berhasil dihapus');
        } catch (Exception $e) {
            //throw $th;
            return redirect('inventaris/peralatan-komputer')->with('message', 'Data Gagal dihapus');
        }
    }
    public function form_ubah_processor($id)
    {
        $lokasi = Ruangan::get();
        $vendor = Vendor::get();
        $data = InventarisProcessor::findOrFail($id);
        return view('inventaris.peralatan_komputer.processor.edit', compact('data', 'lokasi', 'vendor'));
    }
    public function action_update_processor($id, request $request)
    {
        try {
            //code...
            if (!$request->has('lokasi') && !$request->has('keterangan')) {
                $harga = $request->harga;
                $harga = preg_replace('/[^0-9]/', '', $harga);
                $data = InventarisProcessor::findOrFail($id);
                $saved = $data->update([
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
                ]);
                return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris Berhasil Diubah');
            }else{
                $harga = $request->harga;
                $harga = preg_replace('/[^0-9]/', '', $harga);
                $data = InventarisProcessor::findOrFail($id);
                $saved = $data->update([
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
                    'keterangan' => ($request->keterangan ?? "-")
                ]);
                return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris Berhasil Diubah');
            }
        } catch (\Throwable $th) {
            return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris Processor Gagal Diubah');
        }
    }
    public function detail_processor($id)
    {
        $title = "Detail Inventaris Processor";
        $data = InventarisProcessor::findOrFail($id);
        return view('inventaris.peralatan_komputer.processor.detail', compact('title', 'data'));
    }

    //RAM
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
            'keterangan' => ($request->keterangan ?? "-")
        ]);

        if ($saved) {
            return redirect('inventaris/peralatan-komputer')->with('message', 'data berhasil disimpan!');
        }
    }
    public function hapus_inv_ram($id)
    {
        try {
            //code...
            InventarisRam::findOrFail($id)->delete();
            return redirect('inventaris/peralatan-komputer')->with('message', 'Data Berhasil dihapus');
        } catch (Exception $e) {
            //throw $th;
            return redirect('inventaris/peralatan-komputer')->with('message', 'Data Gagal dihapus');
        }
    }
    public function form_ubah_ram($id)
    {
        $lokasi = Ruangan::get();
        $vendor = Vendor::get();
        $data = InventarisRam::findOrFail($id);
        return view('inventaris.peralatan_komputer.ram.edit', compact('data', 'lokasi', 'vendor'));
    }
    public function action_update_ram($id, request $request)
    {
        try {
            //code...
            if (!$request->has('lokasi') && !$request->has('keterangan')) {
                $harga = $request->harga;
                $harga = preg_replace('/[^0-9]/', '', $harga);
                $data = InventarisRam::findOrFail($id);
                $saved = $data->update([
                    'idVendor' => $request->vendor,
                    'namaMemory' => $request->nama_memory,
                    'jenisMemory' => $request->jenis_memory,
                    'tipeMemory' => $request->tipe_memory,
                    'frekuensiMemory' => $request->frekuensi_memory,
                    'kapasitasMemory' => $request->kapasitas_memory,
                    'harga' => $harga,
                    'tglPembelian' => $request->tanggal,
                    'kondisi' => $request->kondisi,
                ]);
                return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris Berhasil Diubah');
            }else{
                $harga = $request->harga;
                $harga = preg_replace('/[^0-9]/', '', $harga);
                $data = InventarisRam::findOrFail($id);
                $saved = $data->update([
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
                return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris Berhasil Diubah');
            }
        } catch (\Throwable $th) {
            return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris ram Gagal Diubah');
        }
    }
    public function detail_ram($id)
    {
        $title = "Detail Inventaris ram";
        $data = InventarisRam::findOrFail($id);
        return view('inventaris.peralatan_komputer.ram.detail', compact('title', 'data'));
    }
    //Storage
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
            'keterangan' => ($request->keterangan ?? "-")
        ]);

        if ($saved) {
            return redirect('inventaris/peralatan-komputer')->with('message', 'data berhasil disimpan!');
        }
    }
    public function hapus_inv_storage($id)
    {
        try {
            //code...
            InventarisStorage::findOrFail($id)->delete();
            return redirect('inventaris/peralatan-komputer')->with('message', 'Data Berhasil dihapus');
        } catch (Exception $e) {
            //throw $th;
            return redirect('inventaris/peralatan-komputer')->with('message', 'Data Gagal dihapus');
        }
    }
    public function form_ubah_storage($id)
    {
        $lokasi = Ruangan::get();
        $vendor = Vendor::get();
        $data = InventarisStorage::findOrFail($id);
        return view('inventaris.peralatan_komputer.storage.edit', compact('data', 'lokasi', 'vendor'));
    }
    public function action_update_storage($id, request $request)
    {
        try {
            //code...
            if (!$request->has('lokasi') && !$request->has('keterangan')) {
                $harga = $request->harga;
                $harga = preg_replace('/[^0-9]/', '', $harga);
                $data = InventarisStorage::findOrFail($id);
                $saved = $data->update([
                    'idVendor' => $request->vendor,
                    'namaStorage' => $request->nama_storage,
                    'jenisStorage' => $request->jenis_storage,
                    'kapasitasStorage' => $request->kapasitas_storage,
                    'harga' => $harga,
                    'tglPembelian' => $request->tanggal,
                    'kondisi' => $request->kondisi,
                ]);
                return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris Berhasil Diubah');
            } else {
                $harga = $request->harga;
                $harga = preg_replace('/[^0-9]/', '', $harga);
                $data = InventarisStorage::findOrFail($id);
                $saved = $data->update([
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
                return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris Berhasil Diubah');
            }
        } catch (\Throwable $th) {
            return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris storage Gagal Diubah');
        }
    }
    public function detail_storage($id)
    {
        $title = "Detail Inventaris Storage";
        $data = InventarisStorage::findOrFail($id);
        return view('inventaris.peralatan_komputer.storage.detail', compact('title', 'data'));
    }
    //PSU
    public function psu(request $request)
    {
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
                'keterangan' => ($request->keterangan_psu ?? "-")
            ]);
        if ($saved) {
            return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris Berhasil Ditambahkan');
        } else {
            return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris Gagal Ditambahkan');
        }
    }
    public function hapus_inv_psu($id)
    {
        try {
            //code...
         InventarisPsu::findOrFail($id)->delete();
            return redirect('inventaris/peralatan-komputer')->with('message', 'Data Berhasil dihapus');
        } catch (Exception $e) {
            //throw $th;
            return redirect('inventaris/peralatan-komputer')->with('message', 'Data Gagal dihapus');
        }
    }
    public function form_ubah_psu($id)
    {
        $lokasi = Ruangan::get();
        $vendor = Vendor::get();
        $data = InventarisPsu::findOrFail($id);
        return view('inventaris.peralatan_komputer.psu.edit', compact('data', 'lokasi', 'vendor'));
    }
    public function action_update_psu($id, request $request)
    {
        try {
            //code...
            if (!$request->has('lokasi') && !$request->has('keterangan')) {
                $harga = $request->harga;
                $harga = preg_replace('/[^0-9]/', '', $harga);
                $data = InventarisPsu::findOrFail($id);
                $saved = $data->update([
                    'namaPsu' => $request->nama_psu,
                    'formFactor' => $request->form_factor_psu,
                    'jenisKabel' => $request->jenis_kabel_psu,
                    'besarDaya' => $request->besar_daya_psu,
                    'sertifikasiPsu' => $request->sertifikasi_psu,
                    'idVendor' => $request->vendor,
                    'harga' => $harga,
                    'tglPembelian' => $request->tanggal,
                    'kondisi' => $request->kondisi,
                ]);
                return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris Berhasil Diubah');
            } else {
                $harga = $request->harga;
                $harga = preg_replace('/[^0-9]/', '', $harga);
                $data = InventarisPsu::findOrFail($id);
                $saved = $data->update([
                    'namaPsu' => $request->nama_psu,
                    'formFactor' => $request->form_factor_psu,
                    'jenisKabel' => $request->jenis_kabel_psu,
                    'besarDaya' => $request->besar_daya_psu,
                    'sertifikasiPsu' => $request->sertifikasi_psu,
                    'idRuangan' => $request->lokasi,
                    'idVendor' => $request->vendor,
                    'harga' => $harga,
                    'tglPembelian' => $request->tanggal,
                    'kondisi' => $request->kondisi,
                    'keterangan' => $request->keterangan
                ]);
                return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris Berhasil Diubah');
            }
        } catch (\Throwable $th) {
            return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris psu Gagal Diubah');
        }
    }
    public function detail_psu($id)
    {
        $title = "Detail Inventaris psu";
        $data = InventarisPsu::findOrFail($id);
        return view('inventaris.peralatan_komputer.psu.detail', compact('title', 'data'));
    }
    //GPU
    public function gpu(request $request)
    {
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
            'keterangan' => ($request->keterangan_gpu ?? "-")
            ]);
        if ($saved) {
            return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris Berhasil Ditambahkan');
        } else {
            return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris Gagal Ditambahkan');
        }
    }
    public function hapus_inv_gpu($id)
    {
        try {
            //code...
            InventarisGPU::findOrFail($id)->delete();
            return redirect('inventaris/peralatan-komputer')->with('message', 'Data Berhasil dihapus');
        } catch (Exception $e) {
            //throw $th;
            return redirect('inventaris/peralatan-komputer')->with('message', 'Data Gagal dihapus');
        }
    }
    public function form_ubah_gpu($id)
    {
        $lokasi = Ruangan::get();
        $vendor = Vendor::get();
        $data = InventarisGPU::findOrFail($id);
        return view('inventaris.peralatan_komputer.gpu.edit', compact('data', 'lokasi', 'vendor'));
    }
    public function action_update_gpu($id, request $request)
    {
        try {
            //code...
            if (!$request->has('lokasi') && !$request->has('keterangan')) {
                $harga = $request->harga;
                $harga = preg_replace('/[^0-9]/', '', $harga);
                $data = InventarisGPU::findOrFail($id);
                $saved = $data->update([
                    'namaGpu' => $request->nama_gpu,
                    'ukuranMemori' => $request->ukuran_memori_gpu,
                    'tipeMemori' => $request->tipe_memori_gpu,
                    'idVendor' => $request->vendor_gpu,
                    'harga' => $harga,
                    'tglPembelian' => $request->tanggal,
                    'kondisi' => $request->kondisi,
                ]);
                return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris Berhasil Diubah');
            } else {
                $harga = $request->harga;
                $harga = preg_replace('/[^0-9]/', '', $harga);
                $data = InventarisGPU::findOrFail($id);
                $saved = $data->update([
                    'namaGpu' => $request->nama_gpu,
                    'ukuranMemori' => $request->ukuran_memori_gpu,
                    'tipeMemori' => $request->tipe_memori_gpu,
                    'idRuangan' => $request->lokasi,
                    'idVendor' => $request->vendor,
                    'harga' => $harga,
                    'tglPembelian' => $request->tanggal,
                    'kondisi' => $request->kondisi,
                    'keterangan' => $request->keterangan
                ]);
                return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris Berhasil Diubah');
            }
        } catch (\Throwable $th) {
            return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris GPU Gagal Diubah');
        }
    }
    public function detail_gpu($id)
    {
        $title = "Detail Inventaris gpu";
        $data = InventarisGPU::findOrFail($id);
        return view('inventaris.peralatan_komputer.gpu.detail', compact('title', 'data'));
    }
    //Casing
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
            'keterangan' => ($request->keterangan_casing ?? "-")
        ]);
        if ($saved) {
            return redirect('inventaris/peralatan-komputer')->with('message','Inventaris Berhasil Ditambahkan');
        }else{
            return redirect('inventaris/peralatan-komputer')->with('message','Inventaris Gagal Ditambahkan');
        }
    }
    public function hapus_inv_casing($id)
    {
        try {
            //code...
            InventarisCasing::findOrFail($id)->delete();
            return redirect('inventaris/peralatan-komputer')->with('message', 'Data Berhasil dihapus');
        } catch (Exception $e) {
            //throw $th;
            return redirect('inventaris/peralatan-komputer')->with('message', 'Data Gagal dihapus');
        }
    }
    public function form_ubah_casing($id)
    {
        $lokasi = Ruangan::get();
        $vendor = Vendor::get();
        $data = InventarisCasing::findOrFail($id);
        return view('inventaris.peralatan_komputer.casing.edit', compact('data', 'lokasi', 'vendor'));
    }
    public function action_update_casing($id, request $request)
    {
        try {
            //code...
            if (!$request->has('lokasi') && !$request->has('keterangan')) {
                $harga = $request->harga;
                $harga = preg_replace('/[^0-9]/', '', $harga);
                $data = InventarisCasing::findOrFail($id);
                $saved = $data->update([
                    'namaCasing' => $request->nama_casing,
                    'formFactor' => $request->form_factor_casing,
                    'idVendor' => $request->vendor,
                    'harga' => $harga,
                    'tglPembelian' => $request->tanggal,
                    'kondisi' => $request->kondisi,
                ]);
                return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris Berhasil Diubah');
            } else {
                $harga = $request->harga;
                $harga = preg_replace('/[^0-9]/', '', $harga);
                $data = InventarisCasing::findOrFail($id);
                $saved = $data->update([
                    'namaCasing' => $request->nama_casing,
                    'formFactor' => $request->form_factor_casing,
                    'idRuangan' => $request->lokasi,
                    'idVendor' => $request->vendor,
                    'harga' => $harga,
                    'tglPembelian' => $request->tanggal,
                    'kondisi' => $request->kondisi,
                    'keterangan' => $request->keterangan
                ]);
                return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris Berhasil Diubah');
            }
        } catch (\Throwable $th) {
            return redirect('inventaris/peralatan-komputer')->with('message', 'Inventaris casing Gagal Diubah');
        }
    }
    public function detail_casing($id)
    {
        $title = "Detail Inventaris casing";
        $data = InventarisCasing::findOrFail($id);
        return view('inventaris.peralatan_komputer.casing.detail', compact('title', 'data'));
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
            $data = Motherboard::select('id','kodeInventaris',  'tglPembelian')
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
            $data = InventarisProcessor::select('id','kodeInventaris',  'tglPembelian')
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
            $data = InventarisRam::select('id','kodeInventaris',  'tglPembelian')
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
            $data = InventarisPsu::select('id','kodeInventaris',  'tglPembelian')
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
            $data = InventarisStorage::select('id','kodeInventaris',  'tglPembelian')
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
            $data = InventarisGPU::select('id','kodeInventaris',  'tglPembelian')
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
            $data = InventarisCasing::select('id','kodeInventaris',  'tglPembelian')
            ->whereIn('kodeInventaris', $kode_inventaris)
                ->get();
            $namaBarang = "Casing";
            return view('inventaris.cetak', compact('data', 'namaBarang'));
        }
    }
    public function mobile($nama,$id){
        if ($nama == "Motherboard") {
            $data = Motherboard::findOrFail($id);
            return view('inventaris.peralatan_komputer.motherboard.mobile',compact('data'));
        }
        if ($nama == "Processor") {
            $data = InventarisProcessor::findOrFail($id);
            return view('inventaris.peralatan_komputer.processor.mobile', compact('data'));
        }
        if ($nama == "RAM") {
            $data = InventarisRam::findOrFail($id);
            return view('inventaris.peralatan_komputer.ram.mobile', compact('data'));
        }
        if ($nama == "Storage") {
            $data = InventarisStorage::findOrFail($id);
            return view('inventaris.peralatan_komputer.storage.mobile', compact('data'));
        }
        if ($nama == "GPU") {
            $data = InventarisGPU::findOrFail($id);
            return view('inventaris.peralatan_komputer.gpu.mobile', compact('data'));
        }
        if ($nama == "PSU") {
            $data = InventarisPsu::findOrFail($id);
            return view('inventaris.peralatan_komputer.psu.mobile', compact('data'));
        }
        if ($nama == "Casing") {
            $data = InventarisCasing::findOrFail($id);
            return view('inventaris.peralatan_komputer.casing.mobile', compact('data'));
        }
    }
}
