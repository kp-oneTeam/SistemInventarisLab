<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisPsu extends Model
{
    use HasFactory;
    protected $table = 'inventaris_psu';
    protected $guarded = [];
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'idRuangan', 'id');
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'idVendor', 'id');
    }
}
