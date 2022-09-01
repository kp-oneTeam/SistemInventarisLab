<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;
    protected $table = 'inventaris';
    protected $guarded = [];
    
    public function barang(){
        return $this->belongsTo(Barang::class,'idBarang','id');
    }
    public function ruangan(){
        return $this->belongsTo(Ruangan::class,'idRuangan','id');
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'idVendor', 'id');
    }
}
