<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisKomputer extends Model
{
    use HasFactory;
    protected $table = 'inventaris_komputer';
    protected $guarded = [];
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'idRuangan', 'id');
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'idVendor', 'id');
    }
    public function motherboard()
    {
        return $this->belongsTo(Motherboard::class, 'idInventarisMotherboard', 'id');
    }
    public function processor()
    {
        return $this->belongsTo(InventarisProcessor::class, 'idInventarisProcessor', 'id');
    }
    public function gpu()
    {
        return $this->belongsTo(InventarisGPU::class, 'idInventarisGpu', 'id');
    }
    public function psu()
    {
        return $this->belongsTo(InventarisPsu::class, 'idInventarisPsu', 'id');
    }
    public function casing()
    {
        return $this->belongsTo(InventarisCasing::class, 'idInventarisCasing', 'id');
    }
    public function ram($id)
    {
        $data = DetailInvKomRam::where('idInventarisKomputer',$id)->get();
        return $data;
    }
    public function storage($id)
    {
        $data = DetailInvKomStorage::where('idInventarisKomputer', $id)->get();
        return $data;
    }
}

