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
        try {
            $data = Inventaris::findOrFail($id);
            return $data;
            //code...
        } catch (\Throwable $th) {
            return 0;
            //throw $th;
        }
    }
}
