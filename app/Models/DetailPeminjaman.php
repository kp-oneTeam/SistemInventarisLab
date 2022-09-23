<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    use HasFactory;
    protected $table = 'detail_peminjaman';
    protected $guarded = [];
    public function inventaris($id)
    {
        $data = Inventaris::findOrFail($id);
        return $data;
    }
}
