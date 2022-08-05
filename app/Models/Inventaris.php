<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;
    protected $table = 'inventaris';
    protected $guarded = [];
    public static function kode_inventaris()
    {
        $date = date('Y-m-d');
        $selectmax = self::selectRaw('MAX(kodeInventaris) as kodeInventaris')
        ->where('created_at', 'like', '%' . $date . '%')
            ->first();
        $date = date('Ymd');
        if ($selectmax->kodeInventaris != null) {
            $selectmax = $selectmax->kodeInventaris;
            $selectmax = substr($selectmax, 8, 4) + 1;
            $selectmax = $date . sprintf('%04s', $selectmax);
            return $selectmax;
        } else {
            $selectmax = $date . "0001";
            return $selectmax;
        }
    }
    public function barang(){
        return $this->belongsTo(Barang::class,'kodeBarang','kodeBarang');
    }
    public function ruangan(){
        return $this->belongsTo(Ruangan::class,'kodeRuangan','kodeRuangan');
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'kodeVendor', 'kodeVendor');
    }
}