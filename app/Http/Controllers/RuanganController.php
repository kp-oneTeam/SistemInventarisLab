<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RuanganController extends Controller
{
    //
    public function index(){
        $title = "Manajemen Ruangan";
        return view('ruangan.index',compact('title'));
    }
}
