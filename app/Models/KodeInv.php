<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeInv extends Model
{
    use HasFactory;
    protected $table = 'kode_inv';
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
}
