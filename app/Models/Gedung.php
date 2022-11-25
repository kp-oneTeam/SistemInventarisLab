<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    use HasFactory;
    protected $table = 'gedung';
    protected $guarded = [];

    public static function ruangan($id){
       $data = Ruangan::where('idGedung',$id)->get();
       return $data;
    }
}
