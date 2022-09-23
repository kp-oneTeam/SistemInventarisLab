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
        $motherboard = Motherboard::where('keterangan', '!=','Sudah dipasang dikomputer')->where('kondisi',"=",'Baik')->get();
        $processor = InventarisProcessor::where('keterangan', '!=','Sudah dipasang dikomputer')->where('kondisi',"=",'Baik')->get();
        $ram = InventarisRam::where('keterangan', '!=','Sudah dipasang dikomputer')->where('kondisi',"=",'Baik')->get();
        $storage = InventarisStorage::where('keterangan', '!=','Sudah dipasang dikomputer')->where('kondisi',"=",'Baik')->get();
        $psu = InventarisPsu::where('keterangan', '!=','Sudah dipasang dikomputer')->where('kondisi',"=",'Baik')->get();
        $vga = InventarisGPU::where('keterangan', '!=','Sudah dipasang dikomputer')->where('kondisi',"=",'Baik')->get();
        $casing = InventarisCasing::where('keterangan', '!=','Sudah dipasang dikomputer')->where('kondisi',"=",'Baik')->get();
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
        try {
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
            if ($inventarisKomputer) {
                //update lokasi dan keterangan motherboard
                $motherboard = Motherboard::findOrFail($request->motherboard);
                $motherboard->update([
                    'idRuangan' => $request->lokasi,
                    'keterangan' => "Sudah dipasang dikomputer"
                ]);
                //update lokasi dan keterangan processor
                $processor = InventarisProcessor::findOrFail($request->processor);
                $processor->update([
                    'idRuangan' => $request->lokasi,
                    'keterangan' => "Sudah dipasang dikomputer"
                ]);
                //update lokasi dan keterangan gpu
                $gpu = InventarisGPU::findOrFail($request->vga);
                $gpu->update([
                    'idRuangan' => $request->lokasi,
                    'keterangan' => "Sudah dipasang dikomputer"
                ]);
                //update lokasi dan keterangan casing
                $casing = InventarisCasing::findOrFail($request->casing);
                $casing->update([
                    'idRuangan' => $request->lokasi,
                    'keterangan' => "Sudah dipasang dikomputer"
                ]);
                //update lokasi dan keterangan psu
                $psu = InventarisPsu::findOrFail($request->psu);
                $psu->update([
                    'idRuangan' => $request->lokasi,
                    'keterangan' => "Sudah dipasang dikomputer"
                ]);
                for ($i = 0; $i < count($request->ram); $i++) {
                    DetailInvKomRam::create([
                        'idInventarisKomputer' => $inventarisKomputer->id,
                        'idInventarisRam' => $request->ram[$i]
                    ]);
                    //update lokasi dan keterangan ram
                    $ram = InventarisRam::findOrFail($request->ram[$i]);
                    $ram->update([
                        'idRuangan' => $request->lokasi,
                        'keterangan' => "Sudah dipasang dikomputer"
                    ]);
                }
                for ($i = 0; $i < count($request->storage); $i++) {
                    DetailInvKomStorage::create([
                        'idInventarisKomputer' => $inventarisKomputer->id,
                        'idInventarisStorage' => $request->storage[$i]
                    ]);
                    //update lokasi dan keterangan storage
                    $storage = InventarisStorage::findOrFail($request->storage[$i]);
                    $storage->update([
                        'idRuangan' => $request->lokasi,
                        'keterangan' => "Sudah dipasang dikomputer"
                    ]);
                }
            }
            return redirect('inventaris/komputer')->with('message', "Berhasil disimpan!");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('inventaris/komputer')->with('message', "Berhasil gagal disimpan!");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        //
        $data = InventarisKomputer::findOrFail($id);
        return view('inventaris.komputer.detail',compact('data'));
    }
    public function mobile($id)
    {
        //
        $data = InventarisKomputer::findOrFail($id);
        return view('inventaris.komputer.mobile', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Ubah Inventaris Komputer";
        $lokasi = Ruangan::get();
        $motherboard = Motherboard::where('keterangan', '!=', 'Sudah dipasang dikomputer')->where('kondisi',"=","Baik")->get();
        $processor = InventarisProcessor::where('keterangan', '!=', 'Sudah dipasang dikomputer')->where('kondisi',"=","Baik")->get();
        $ram = InventarisRam::where('keterangan', '!=', 'Sudah dipasang dikomputer')->where('kondisi',"=","Baik")->get();
        $storage = InventarisStorage::where('keterangan', '!=', 'Sudah dipasang dikomputer')->where('kondisi',"=","Baik")->get();
        $psu = InventarisPsu::where('keterangan', '!=', 'Sudah dipasang dikomputer')->where('kondisi',"=","Baik")->get();
        $vga = InventarisGPU::where('keterangan', '!=', 'Sudah dipasang dikomputer')->where('kondisi',"=","Baik")->get();
        $casing = InventarisCasing::where('keterangan', '!=', 'Sudah dipasang dikomputer')->where('kondisi',"=","Baik")->get();
        $data = InventarisKomputer::findOrFail($id);
        return view('inventaris.komputer.edit', compact('title','data','lokasi', 'motherboard', 'processor', 'ram', 'storage', 'psu', 'casing', 'vga'));
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
        try {
            //
            $data = InventarisKomputer::findOrFail($id);
            $data->update([
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
            $motherboard = Motherboard::findOrFail($request->motherboard);
            $motherboard->update([
                'idRuangan' => $request->lokasi,
                'keterangan' => "Sudah dipasang dikomputer"
            ]);
            //update lokasi dan keterangan processor
            $processor = InventarisProcessor::findOrFail($request->processor);
            $processor->update([
                'idRuangan' => $request->lokasi,
                'keterangan' => "Sudah dipasang dikomputer"
            ]);
            //update lokasi dan keterangan gpu
            $gpu = InventarisGPU::findOrFail($request->vga);
            $gpu->update([
                'idRuangan' => $request->lokasi,
                'keterangan' => "Sudah dipasang dikomputer"
            ]);
            //update lokasi dan keterangan casing
            $casing = InventarisCasing::findOrFail($request->casing);
            $casing->update([
                'idRuangan' => $request->lokasi,
                'keterangan' => "Sudah dipasang dikomputer"
            ]);
            //update lokasi dan keterangan psu
            $psu = InventarisPsu::findOrFail($request->psu);
            $psu->update([
                'idRuangan' => $request->lokasi,
                'keterangan' => "Sudah dipasang dikomputer"
            ]);
            for ($i = 0; $i < count($request->ram); $i++) {
                DetailInvKomRam::create([
                    'idInventarisKomputer' => $id,
                    'idInventarisRam' => $request->ram[$i]
                ]);
                //update lokasi dan keterangan ram
                $ram = InventarisRam::findOrFail($request->ram[$i]);
                $ram->update([
                    'idRuangan' => $request->lokasi,
                    'keterangan' => "Sudah dipasang dikomputer"
                ]);
            }
            for ($i = 0; $i < count($request->storage); $i++) {
                DetailInvKomStorage::create([
                    'idInventarisKomputer' => $id,
                    'idInventarisStorage' => $request->storage[$i]
                ]);
                //update lokasi dan keterangan storage
                $storage = InventarisStorage::findOrFail($request->storage[$i]);
                $storage->update([
                    'idRuangan' => $request->lokasi,
                    'keterangan' => "Sudah dipasang dikomputer"
                ]);
            }
            return redirect('inventaris/komputer')->with('message', "Berhasil diubah!");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('inventaris/komputer')->with('message', "Berhasil Gagal diubah!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = InventarisKomputer::findOrFail($id);
            $motherboard = Motherboard::findOrFail($data->idInventarisMotherboard);
            $motherboard->update([
                'keterangan' => "-"
            ]);
            //update lokasi dan keterangan processor
            $processor = InventarisProcessor::findOrFail($data->idInventarisProcessor);
            $processor->update([
                'keterangan' => "-"
            ]);
            //update lokasi dan keterangan gpu
            $gpu = InventarisGPU::findOrFail($data->idInventarisGpu);
            $gpu->update([
                'keterangan' => "-"
            ]);
            //update lokasi dan keterangan casing
            $casing = InventarisCasing::findOrFail($data->idInventarisCasing);
            $casing->update([
                'keterangan' => "-"
            ]);
            //update lokasi dan keterangan psu
            $psu = InventarisPsu::findOrFail($data->idInventarisPsu);
            $psu->update([
                'keterangan' => "-"
            ]);

            //ram
            $ram = DetailInvKomRam::where('idInventarisKomputer',$data->id)->get();
            foreach ($ram as $item) {
                //update lokasi dan keterangan ram
                $ram = InventarisRam::findOrFail($item->idInventarisRam);
                $ram->update([
                    'keterangan' => "-"
                ]);
            }
            //storage
            $storage = DetailInvKomStorage::where('idInventarisKomputer', $data->id)->get();
            foreach ($storage as $item) {
                //update lokasi dan keterangan storage
                $storage = InventarisStorage::findOrFail($item->idInventarisStorage);
                $storage->update([
                    'keterangan' => "-"
                ]);
            }
            $data->delete();
            return redirect('inventaris/komputer')->with('message', "Berhasil dihapus!");
        } catch (\Throwable $th) {
            return redirect('inventaris/komputer')->with('message', "Gagal dihapus!");
        }
    }
    public function getRam($id){
        $data = InventarisRam::where('id', '!=', $id)->get();
        return response()->json($data);
    }
    public function hapus_ram($id_inventaris,$id_ram,request $request){
        try {
            DetailInvKomRam::where('idInventarisRam',$id_ram)->delete();
            $data = InventarisRam::findOrFail($id_ram);
            $data->update([
                "idRuangan" => $request->lokasi_ram,
                "keterangan" => ($request->keterangan_ram ?? "-"),
                "kondisi" => $request->kondisi_ram
            ]);
            return redirect('edit/inventaris_komputer/' . $id_inventaris)->with('message', "Berhasil dihapus!");
        } catch (\Throwable $th) {
            return redirect('edit/inventaris_komputer/' . $id_inventaris)->with('message', "Gagal dihapus!");
        }
    }
    public function tambah_ram($id_inventaris,request $request){
        try {
            DetailInvKomRam::create([
                'idInventarisKomputer' => $id_inventaris,
                'idInventarisRam' => $request->ram
            ]);
            //update lokasi dan keterangan ram
            $ram = InventarisRam::findOrFail($request->ram);
            $ram->update([
                'idRuangan' => $request->lokasi,
                'keterangan' => "Sudah dipasang dikomputer"

            ]);
            return redirect('edit/inventaris_komputer/' . $id_inventaris)->with('message', "Berhasil disimpan!");
        } catch (\Throwable $th) {
            return redirect('edit/inventaris_komputer/' . $id_inventaris)->with('message', "Berhasil disimpan!");
        }
    }
    public function hapus_storage($id_inventaris, $id_storage, request $request)
    {
        try {
            DetailInvKomStorage::where('idInventarisStorage', $id_storage)->delete();
            $data = InventarisStorage::findOrFail($id_storage);
            $data->update([
                "idRuangan" => $request->lokasi_storage,
                "keterangan" => ($request->keterangan_storage ?? "-"),
                "kondisi" => $request->kondisi_storage
            ]);
            return redirect('edit/inventaris_komputer/' . $id_inventaris)->with('message', "Berhasil dihapus!");
        } catch (\Throwable $th) {
            return redirect('edit/inventaris_komputer/' . $id_inventaris)->with('message', "Gagal dihapus!");
        }
    }
    public function tambah_storage($id_inventaris, request $request)
    {
        try {
            DetailInvKomStorage::create([
                'idInventarisKomputer' => $id_inventaris,
                'idInventarisStorage' => $request->storage
            ]);
            //update lokasi dan keterangan
            $storage = InventarisStorage::findOrFail($request->storage);
            $storage->update([
                'idRuangan' => $request->lokasi,
                'keterangan' => "Sudah dipasang dikomputer"

            ]);
            return redirect('edit/inventaris_komputer/' . $id_inventaris)->with('message', "Berhasil disimpan!");
        } catch (\Throwable $th) {
            return redirect('edit/inventaris_komputer/' . $id_inventaris)->with('message', "Berhasil disimpan!");
        }
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
            $data = InventarisKomputer::select('id','kodeInventarisKomputer as kodeInventaris',  'tanggal_perakitan as tglPembelian')
            ->whereIn('kodeInventarisKomputer', $kode_inventaris)
                ->get();
            $namaBarang = "Komputer";
            return view('inventaris.cetak', compact('data', 'namaBarang'));
        }
    }
}
