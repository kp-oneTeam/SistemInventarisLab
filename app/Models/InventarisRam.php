<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisRam extends Model
{
    use HasFactory;
    protected $table = 'inventaris_ram';
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
