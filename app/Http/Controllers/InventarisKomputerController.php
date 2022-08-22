<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Inventaris;
use App\Models\InventarisKomputer;
use App\Models\Ruangan;
use App\Models\Vendor;
use Illuminate\Http\Request;

class InventarisKomputerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Tambah Inventaris Komputer";
        $lokasi = Ruangan::get();
        $motherboard = Inventaris::join('barang', 'barang.id', '=', 'inventaris.idBarang')
        ->where('namaBarang','LIKE','%'.'Motherboard'.'%')
        ->select('inventaris.id','kodeInventaris', 'spesifikasi')
        ->get();
        $processor = Inventaris::join('barang', 'barang.id', '=', 'inventaris.idBarang')
            ->where('namaBarang', 'LIKE', '%' . 'processor' . '%')
            ->select('inventaris.id', 'kodeInventaris', 'spesifikasi')
            ->get();
        $ram = Inventaris::join('barang', 'barang.id', '=', 'inventaris.idBarang')
            ->where('namaBarang', 'LIKE', '%' . 'ram' . '%')
            ->select('inventaris.id', 'kodeInventaris', 'spesifikasi')
            ->get();
        $storage = Inventaris::join('barang', 'barang.id', '=', 'inventaris.idBarang')
            ->where('namaBarang', 'LIKE', '%' . 'storage' . '%')
            ->select('inventaris.id', 'kodeInventaris', 'spesifikasi')
            ->get();
        $psu = Inventaris::join('barang', 'barang.id', '=', 'inventaris.idBarang')
            ->where('namaBarang', 'LIKE', '%' . 'psu' . '%')
            ->select('inventaris.id', 'kodeInventaris', 'spesifikasi')
            ->get();
        $vga = Inventaris::join('barang', 'barang.id', '=', 'inventaris.idBarang')
            ->where('namaBarang', 'LIKE', '%' . 'vga' . '%')
            ->select('inventaris.id', 'kodeInventaris', 'spesifikasi')
            ->get();
        $casing = Inventaris::join('barang', 'barang.id', '=', 'inventaris.idBarang')
            ->where('namaBarang', 'LIKE', '%' . 'casing' . '%')
            ->select('inventaris.id', 'kodeInventaris', 'spesifikasi')
            ->get();
        return view('inventaris.create_inv_komputer',compact('lokasi','motherboard','processor','ram','storage','psu','casing','vga'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inventarisKomputer = InventarisKomputer::create([
            'kodeInventaris' => Inventaris::kode_inventaris(),
            ''
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
