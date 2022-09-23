<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisGPU extends Model
{
    use HasFactory;
    protected $table = 'inventaris_gpu';
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
