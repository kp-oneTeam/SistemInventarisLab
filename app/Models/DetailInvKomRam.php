<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailInvKomRam extends Model
{
    protected $table = 'detail_inv_kom_ram';
    protected $guarded = [];
    use HasFactory;
    public function rams()
    {
        return $this->belongsTo(InventarisRam::class, 'idInventarisRam', 'id');
    }
}
