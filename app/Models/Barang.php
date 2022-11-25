<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $guarded = [];
    public static function inventaris($id)
    {
        $inventaris = Inventaris::join('barang', 'barang.id', '=', 'inventaris.idBarang')
        ->join('vendor', 'vendor.id', '=', 'inventaris.idVendor')
        ->join('ruangan', 'ruangan.id', '=', 'inventaris.idRuangan')
        ->select('kodeInventaris', 'namaBarang', 'spesifikasi', 'kodeRuangan', 'namaRuangan', 'kondisi', 'keterangan', 'tgl_pembelian')
        ->where('barang.id', $id)
            ->get();


        $total = $inventaris->count();
        return $total;
    }
}
