<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisStorage extends Model
{
    use HasFactory;
    protected $table = 'inventaris_storage';
    protected $guarded = [];
}
