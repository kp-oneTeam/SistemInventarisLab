<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    //
    public function index(){
        $title = "Laporan";
        return view('laporan.index',compact('title'));
    }
}
