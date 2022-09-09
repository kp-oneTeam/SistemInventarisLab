<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailInvKomRam;
use App\Models\DetailInvKomStorage;
use App\Models\Inventaris;
use App\Models\InventarisCasing;
use App\Models\InventarisGPU;
use App\Models\InventarisKomputer;
use App\Models\InventarisProcessor;
use App\Models\InventarisPsu;
use App\Models\InventarisRam;
use App\Models\InventarisStorage;
use App\Models\KodeInv;
use App\Models\Motherboard;
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
        $motherboard = Motherboard::get();
        $processor = InventarisProcessor::get();
        $ram = InventarisRam::get();
        $storage = InventarisStorage::get();
        $psu = InventarisPsu::get();
        $vga = InventarisGPU::get();
        $casing = InventarisCasing::get();
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
        $kodeinv = KodeInv::create(['kodeInventaris' => KodeInv::kode_inventaris()]);
        $inventarisKomputer = InventarisKomputer::create([
            'kodeInventarisKomputer' => $kodeinv->kodeInventaris,
            'idRuangan' => $request->lokasi,
            'idInventarisMotherboard' => $request->motherboard,
            'idInventarisProcessor' => $request->processor,
            'idInventarisGpu' => $request->vga,
            'idInventarisCasing' => $request->casing,
            'idInventarisPsu' => $request->psu,
            'tanggal_perakitan' => $request->tanggal,
            'kondisi' => $request->kondisi,
            'keterangan' => ($request->keterangan ?? "-")
        ]);
        if($inventarisKomputer){
            for ($i = 0; $i < count($request->ram); $i++) {
                DetailInvKomRam::create([
                    'idInventarisKomputer' => $inventarisKomputer->id,
                    'idInventarisRam' => $request->ram[$i]
                ]);
            }
            for ($i = 0; $i < count($request->storage); $i++) {
                DetailInvKomStorage::create([
                    'idInventarisKomputer' => $inventarisKomputer->id,
                    'idInventarisStorage' => $request->ram[$i]
                ]);
            }
        }
        return redirect('inventaris/komputer')->with('success',"berhasil disimpan!");
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
    public function getRam($id){
        $data = InventarisRam::where('id', '!=', $id)->get();
        return response()->json($data);;
    }
    public function checked(request $request)
    {
        $kode_inventaris = [];
        for ($i = 0; $i < count($request->kode_inventaris); $i++) {
            $kode_inventaris[] = $request->kode_inventaris[$i];
        }
        if ($request->button == "hapus") {
            $data = InventarisKomputer::whereIn('kodeInventarisKomputer', $kode_inventaris)
                ->delete();
            return redirect('inventaris/komputer')->with('message', 'Data Berhasil Dihapus!');
        } else {
            $data = InventarisKomputer::select('kodeInventarisKomputer as kodeInventaris',  'tanggal_perakitan as tglPembelian')
            ->whereIn('kodeInventarisKomputer', $kode_inventaris)
                ->get();
            $namaBarang = "Komputer";
            return view('inventaris.cetak', compact('data', 'namaBarang'));
        }
    }
}
