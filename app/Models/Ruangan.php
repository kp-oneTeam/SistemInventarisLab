<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    protected $table = 'ruangan';
    protected $guarded = [];
    public function gedung()
    {
        return $this->belongsTo(Gedung::class, 'idGedung', 'id');
    }
    public static function inventaris($id)
    {
        $inventaris = Inventaris::join('barang', 'barang.id', '=', 'inventaris.idBarang')
        ->join('vendor', 'vendor.id', '=', 'inventaris.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris.idRuangan')
        ->select('kodeInventaris', 'namaBarang', 'spesifikasi', 'kodeRuangan', 'namaRuangan', 'kondisi', 'keterangan', 'tgl_pembelian')
        ->where('ruangan.id', $id)
        ->get();
        //Peralatan Komputer
        $motherboard = Motherboard::join('vendor', 'vendor.id', '=', 'inventaris_motherboard.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_motherboard.idRuangan')
        ->select('inventaris_motherboard.id', 'kodeInventaris', 'namaMotherboard', 'chipsetMotherboard', 'socketMotherboard', 'formFactor', 'memoriSlot', 'memoriSupport', 'kodeRuangan', 'namaRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->where('ruangan.id', $id)
        ->get();
        $processor = InventarisProcessor::join('vendor', 'vendor.id', '=', 'inventaris_processor.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_processor.idRuangan')
        ->select('inventaris_processor.id', 'kodeInventaris', 'namaProcessor', 'nomorProcessor', 'generasi', 'series', 'kecepatan', 'jumlahCore', 'jumlahThread', 'socket', 'kodeRuangan', 'namaRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->where('ruangan.id', $id)
        ->get();
        $ram = InventarisRam::join('vendor', 'vendor.id', '=', 'inventaris_ram.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_ram.idRuangan')
        ->select('inventaris_ram.id', 'kodeInventaris', 'namaMemory', 'jenisMemory', 'tipeMemory', 'kapasitasMemory', 'frekuensiMemory', 'namaRuangan', 'idRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->where('ruangan.id', $id)
        ->get();
        $storage = InventarisStorage::join('vendor', 'vendor.id', '=', 'inventaris_storage.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_storage.idRuangan')
        ->select('inventaris_storage.id', 'kodeInventaris', 'namaStorage', 'jenisStorage', 'kapasitasStorage', 'namaRuangan', 'idRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->where('ruangan.id', $id)
        ->get();
        $gpu = InventarisGPU::join('vendor', 'vendor.id', '=', 'inventaris_gpu.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_gpu.idRuangan')
        ->select('inventaris_gpu.id', 'kodeInventaris', 'namaGpu', 'ukuranMemori', 'memoriInterface', 'kecepatanMemori', 'tipeMemori', 'namaRuangan', 'idRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->where('ruangan.id', $id)
        ->get();
        $psu = InventarisPsu::join('vendor', 'vendor.id', '=', 'inventaris_psu.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_psu.idRuangan')
        ->select('inventaris_psu.id', 'kodeInventaris', 'namaPsu', 'formFactor', 'jenisKabel', 'besarDaya', 'sertifikasiPsu', 'namaRuangan', 'idRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->where('ruangan.id', $id)
        ->get();
        $casing = InventarisCasing::join('vendor', 'vendor.id', '=', 'inventaris_casing.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris_casing.idRuangan')
        ->select('inventaris_casing.id', 'kodeInventaris', 'namaCasing', 'formFactor', 'namaRuangan', 'idRuangan', 'namaVendor', 'harga', 'tglPembelian', 'kondisi', 'keterangan')
        ->where('ruangan.id', $id)
        ->get();

        $komputer = InventarisKomputer::where('idRuangan', $id)->get();

        $total = $inventaris->count() + $komputer->count() + $motherboard->count() + $processor->count() + $ram->count() + $gpu->count() +$casing->count() + $storage->count() + $psu->count() + $psu->count();
        return $total;
    }
}
