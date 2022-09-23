<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailInvKomStorage extends Model
{
    use HasFactory;
    protected $table = 'detail_inv_kom_storage';
    protected $guarded = [];
    public function storage()
    {
        return $this->belongsTo(InventarisStorage::class, 'idInventarisStorage', 'id');
    }
}
