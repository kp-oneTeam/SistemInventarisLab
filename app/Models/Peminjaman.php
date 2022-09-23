<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $guarded = [];
    public function detail_peminjaman($id){
       return DetailPeminjaman::where('idPeminjaman',$id)->get();
    }
}
