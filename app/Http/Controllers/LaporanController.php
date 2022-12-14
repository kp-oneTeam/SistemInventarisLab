<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Barang;
use App\Models\Inventaris;
use App\Models\InventarisKomputer;
use App\Models\Ruangan;
use App\Models\SpesifikasiKomputer;
use App\Models\Vendor;
use App\Models\Motherboard;
use App\Models\InventarisCasing;
use App\Models\InventarisGPU;
use App\Models\InventarisProcessor;
use App\Models\InventarisPsu;
use App\Models\InventarisRam;
use App\Models\InventarisStorage;
use App\Models\KodeInv;
use App\Models\Peminjaman;

class LaporanController extends Controller
{
    //
    public function index(){
        $title = "Laporan";
        return view('laporan.index',compact('title'));
    }
    public function cetak(Request $request){
        $dari_tanggal  = $request->dari_tanggal;
        $sampai_tanggal = $request->sampai_tanggal;
        if ($request->jenis_laporan == "inventaris non-komputer") {
            $title = "Data Inventaris Non Komputer";
            $data = Inventaris::join('barang', 'barang.id', '=', 'inventaris.idBarang')
            ->join('vendor', 'vendor.id', '=', 'inventaris.idVendor')
            ->join('ruangan', 'ruangan.id', '=', 'inventaris.idRuangan')
            ->select('namaBarang', 'kodeRuangan', 'namaRuangan', 'namaVendor', 'inventaris.*')
            ->orderBy('created_at',"ASC")
            ->get();
            return view('laporan.print', compact('title','data'));
        }
        if ($request->jenis_laporan == "inventaris peralatan komputer") {
            $title = "Data Inventaris Peralatan Komputer";
            $motherboard = Motherboard::join('vendor', 'vendor.id', '=', 'inventaris_motherboard.idVendor')
            ->join('ruangan', 'ruangan.id', '=', 'inventaris_motherboard.idRuangan')
            ->select('inventaris_motherboard.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
            ->orderBy('created_at',"ASC")
            ->get();
            $processor = InventarisProcessor::join('vendor', 'vendor.id', '=', 'inventaris_processor.idVendor')
            ->join('ruangan', 'ruangan.id', '=', 'inventaris_processor.idRuangan')
            ->select('inventaris_processor.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
            ->orderBy('created_at',"ASC")
            ->get();
            $ram = InventarisRam::join('vendor', 'vendor.id', '=', 'inventaris_ram.idVendor')
            ->join('ruangan', 'ruangan.id', '=', 'inventaris_ram.idRuangan')
            ->select('inventaris_ram.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
            ->orderBy('created_at',"ASC")
            ->get();
            $storage = InventarisStorage::join('vendor', 'vendor.id', '=', 'inventaris_storage.idVendor')
            ->join('ruangan', 'ruangan.id', '=', 'inventaris_storage.idRuangan')
            ->select('inventaris_storage.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
            ->orderBy('created_at',"ASC")
            ->get();
            $gpu = InventarisGPU::join('vendor', 'vendor.id', '=', 'inventaris_gpu.idVendor')
            ->join('ruangan', 'ruangan.id', '=', 'inventaris_gpu.idRuangan')
            ->select('inventaris_gpu.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
            ->orderBy('created_at',"ASC")
            ->get();
            $psu = InventarisPsu::join('vendor', 'vendor.id', '=', 'inventaris_psu.idVendor')
            ->join('ruangan', 'ruangan.id', '=', 'inventaris_psu.idRuangan')
            ->select('inventaris_psu.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
            ->orderBy('created_at',"ASC")
            ->get();
            $casing = InventarisCasing::join('vendor', 'vendor.id', '=', 'inventaris_casing.idVendor')
            ->join('ruangan', 'ruangan.id', '=', 'inventaris_casing.idRuangan')
            ->select('inventaris_casing.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
            ->orderBy('created_at',"ASC")
            ->get();
            return view('laporan.print', compact('title', 'motherboard', 'processor', 'ram', 'storage', 'gpu', 'psu', 'casing'));
        }
        if ($request->jenis_laporan == "inventaris komputer") {
            $title = "Data Inventaris Komputer";
            $komputer = InventarisKomputer::get();
            return view('laporan.print', compact('title', 'komputer'));
        }
        if ($request->jenis_laporan == "peminjaman") {
            $title = "Data Inventaris Yang Sedang Dipinjam";
            $data = Inventaris::join('barang', 'barang.id', '=', 'inventaris.idBarang')
            ->join('vendor', 'vendor.id', '=', 'inventaris.idVendor')
            ->join('ruangan', 'ruangan.id', '=', 'inventaris.idRuangan')
            ->select('namaBarang', 'kodeRuangan', 'namaRuangan', 'namaVendor', 'inventaris.*')
            ->where('keterangan', "Sedang dipinjam")
            ->orderBy('created_at',"ASC")
            ->get();
            return view('laporan.print', compact('title', 'data'));
        }
        if($request->jenis_laporan == "all"){
            $title = "Laporan Inventaris";
            $data = Inventaris::join('barang', 'barang.id', '=', 'inventaris.idBarang')
            ->join('vendor', 'vendor.id', '=', 'inventaris.idVendor')
            ->join('ruangan', 'ruangan.id', '=', 'inventaris.idRuangan')
            ->select('namaBarang','kodeRuangan', 'namaRuangan', 'namaVendor','inventaris.*')
            ->where('tgl_pembelian', '>', $dari_tanggal)
            ->where('tgl_pembelian', '<', $sampai_tanggal)
            ->orderBy('created_at',"ASC")
            ->get();
            //Peralatan Komputer
            $motherboard = Motherboard::join('vendor', 'vendor.id', '=', 'inventaris_motherboard.idVendor')
            ->join('ruangan', 'ruangan.id', '=', 'inventaris_motherboard.idRuangan')
            ->select('inventaris_motherboard.*','kodeRuangan', 'namaRuangan', 'namaVendor')
            ->where('tglPembelian', '>', $dari_tanggal)
            ->where('tglPembelian', '<', $sampai_tanggal)
            ->orderBy('created_at',"ASC")
            ->get();
            $processor = InventarisProcessor::join('vendor', 'vendor.id', '=', 'inventaris_processor.idVendor')
            ->join('ruangan', 'ruangan.id', '=', 'inventaris_processor.idRuangan')
                ->select('inventaris_processor.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
            ->where('tglPembelian', '>', $dari_tanggal)
            ->where('tglPembelian', '<', $sampai_tanggal)
            ->orderBy('created_at',"ASC")
            ->get();
            $ram = InventarisRam::join('vendor', 'vendor.id', '=', 'inventaris_ram.idVendor')
                ->join('ruangan', 'ruangan.id', '=', 'inventaris_ram.idRuangan')
                ->select('inventaris_ram.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
            ->where('tglPembelian', '>', $dari_tanggal)
            ->where('tglPembelian', '<', $sampai_tanggal)
            ->orderBy('created_at',"ASC")
            ->get();
            $storage = InventarisStorage::join('vendor', 'vendor.id', '=', 'inventaris_storage.idVendor')
            ->join('ruangan', 'ruangan.id', '=', 'inventaris_storage.idRuangan')
                ->select('inventaris_storage.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
            ->where('tglPembelian', '>', $dari_tanggal)
            ->where('tglPembelian', '<', $sampai_tanggal)
            ->orderBy('created_at',"ASC")
            ->get();
            $gpu = InventarisGPU::join('vendor', 'vendor.id', '=', 'inventaris_gpu.idVendor')
                ->join('ruangan', 'ruangan.id', '=', 'inventaris_gpu.idRuangan')
                ->select('inventaris_gpu.*','kodeRuangan', 'namaRuangan', 'namaVendor')
                ->where('tglPembelian', '>', $dari_tanggal)
            ->where('tglPembelian', '<', $sampai_tanggal)
            ->orderBy('created_at',"ASC")
            ->get();
            $psu = InventarisPsu::join('vendor', 'vendor.id', '=', 'inventaris_psu.idVendor')
                ->join('ruangan', 'ruangan.id', '=', 'inventaris_psu.idRuangan')
                ->select('inventaris_psu.*','kodeRuangan', 'namaRuangan', 'namaVendor')
                ->where('tglPembelian', '>', $dari_tanggal)
            ->where('tglPembelian', '<', $sampai_tanggal)
            ->orderBy('created_at',"ASC")
            ->get();
            $casing = InventarisCasing::join('vendor', 'vendor.id', '=', 'inventaris_casing.idVendor')
            ->join('ruangan', 'ruangan.id', '=', 'inventaris_casing.idRuangan')
            ->select('inventaris_casing.*','kodeRuangan', 'namaRuangan', 'namaVendor')
            ->where('tglPembelian', '>', $dari_tanggal)
            ->where('tglPembelian', '<', $sampai_tanggal)
            ->orderBy('created_at',"ASC")
            ->get();

            $komputer = InventarisKomputer::where('tanggal_perakitan', '>', $dari_tanggal)
                ->orderBy('created_at',"ASC")->where('tanggal_perakitan', '<', $sampai_tanggal)
                ->get();
        }
        else{
            $title = "Laporan Inventaris Yang ".$request->jenis_laporan;
            if($request->jenis_laporan == "Baik" || $request->jenis_laporan == "Rusak"){
                $data = Inventaris::join('barang', 'barang.id', '=', 'inventaris.idBarang')
                ->join('vendor', 'vendor.id', '=', 'inventaris.idVendor')
                ->join('ruangan', 'ruangan.id', '=', 'inventaris.idRuangan')
                ->select('namaBarang', 'kodeRuangan', 'namaRuangan', 'namaVendor', 'inventaris.*')
                ->where('tgl_pembelian', '>', $dari_tanggal)
                ->where('tgl_pembelian', '<', $sampai_tanggal)
                ->where('kondisi',$request->jenis_laporan)
                ->orderBy('created_at',"ASC")
                ->get();
                //Peralatan Komputer
                $motherboard = Motherboard::join('vendor', 'vendor.id', '=', 'inventaris_motherboard.idVendor')
                ->join('ruangan', 'ruangan.id', '=', 'inventaris_motherboard.idRuangan')
                ->select('inventaris_motherboard.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
                ->where('tglPembelian', '>', $dari_tanggal)
                ->where('tglPembelian', '<', $sampai_tanggal)
                 ->where('kondisi',$request->jenis_laporan)
                ->orderBy('created_at',"ASC")
                 ->get();
                $processor = InventarisProcessor::join('vendor', 'vendor.id', '=', 'inventaris_processor.idVendor')
                ->join('ruangan', 'ruangan.id', '=', 'inventaris_processor.idRuangan')
                ->select('inventaris_processor.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
                ->where('tglPembelian', '>', $dari_tanggal)
                ->where('tglPembelian', '<', $sampai_tanggal)
                 ->where('kondisi',$request->jenis_laporan)
                ->orderBy('created_at',"ASC")
                 ->get();
                $ram = InventarisRam::join('vendor', 'vendor.id', '=', 'inventaris_ram.idVendor')
                    ->join('ruangan', 'ruangan.id', '=', 'inventaris_ram.idRuangan')
                    ->select('inventaris_ram.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
                    ->where('tglPembelian', '>', $dari_tanggal)
                    ->where('tglPembelian', '<', $sampai_tanggal)
                     ->where('kondisi',$request->jenis_laporan)
                    ->orderBy('created_at',"ASC")
                     ->get();
                $storage = InventarisStorage::join('vendor', 'vendor.id', '=', 'inventaris_storage.idVendor')
                ->join('ruangan', 'ruangan.id', '=', 'inventaris_storage.idRuangan')
                ->select('inventaris_storage.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
                ->where('tglPembelian', '>', $dari_tanggal)
                ->where('tglPembelian', '<', $sampai_tanggal)
                 ->where('kondisi',$request->jenis_laporan)
                ->orderBy('created_at',"ASC")
                 ->get();
                $gpu = InventarisGPU::join('vendor', 'vendor.id', '=', 'inventaris_gpu.idVendor')
                    ->join('ruangan', 'ruangan.id', '=', 'inventaris_gpu.idRuangan')
                    ->select('inventaris_gpu.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
                    ->where('tglPembelian', '>', $dari_tanggal)
                    ->where('tglPembelian', '<', $sampai_tanggal)
                     ->where('kondisi',$request->jenis_laporan)
                    ->orderBy('created_at',"ASC")
                     ->get();
                $psu = InventarisPsu::join('vendor', 'vendor.id', '=', 'inventaris_psu.idVendor')
                    ->join('ruangan', 'ruangan.id', '=', 'inventaris_psu.idRuangan')
                    ->select('inventaris_psu.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
                    ->where('tglPembelian', '>', $dari_tanggal)
                    ->where('tglPembelian', '<', $sampai_tanggal)
                     ->where('kondisi',$request->jenis_laporan)
                    ->orderBy('created_at',"ASC")
                     ->get();
                $casing = InventarisCasing::join('vendor', 'vendor.id', '=', 'inventaris_casing.idVendor')
                ->join('ruangan', 'ruangan.id', '=', 'inventaris_casing.idRuangan')
                ->select('inventaris_casing.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
                ->where('tglPembelian', '>', $dari_tanggal)
                ->where('tglPembelian', '<', $sampai_tanggal)
                ->where('kondisi',$request->jenis_laporan)
                ->orderBy('created_at',"ASC")
                ->get();

                $komputer = InventarisKomputer::where('tanggal_perakitan', '>', $dari_tanggal)
                ->orderBy('created_at',"ASC")->where('tanggal_perakitan', '<', $sampai_tanggal)->where('kondisi',$request->jenis_laporan)
                ->get();
            }
            if($request->jenis_laporan == "Sedang dipinjam"){
                // $data = Inventaris::join('barang', 'barang.id', '=', 'inventaris.idBarang')
                // ->join('vendor', 'vendor.id', '=', 'inventaris.idVendor')
                // ->join('ruangan', 'ruangan.id', '=', 'inventaris.idRuangan')
                // ->select('namaBarang', 'kodeRuangan', 'namaRuangan', 'namaVendor', 'inventaris.*')
                // ->where('tgl_pembelian', '>', $dari_tanggal)
                // ->where('tgl_pembelian', '<', $sampai_tanggal)
                // ->where('keterangan',$request->jenis_laporan)
                // ->orderBy('created_at',"ASC")
                // ->get();
                // //Peralatan Komputer
                // $motherboard = Motherboard::join('vendor', 'vendor.id', '=', 'inventaris_motherboard.idVendor')
                // ->join('ruangan', 'ruangan.id', '=', 'inventaris_motherboard.idRuangan')
                // ->select('inventaris_motherboard.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
                // ->where('tglPembelian', '>', $dari_tanggal)
                // ->where('tglPembelian', '<', $sampai_tanggal)
                //     ->where('keterangan',$request->jenis_laporan)
                //     ->orderBy('created_at',"ASC")
                //     ->get();
                // $processor = InventarisProcessor::join('vendor', 'vendor.id', '=', 'inventaris_processor.idVendor')
                // ->join('ruangan', 'ruangan.id', '=', 'inventaris_processor.idRuangan')
                // ->select('inventaris_processor.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
                // ->where('tglPembelian', '>', $dari_tanggal)
                // ->where('tglPembelian', '<', $sampai_tanggal)
                //     ->where('keterangan',$request->jenis_laporan)
                //     ->orderBy('created_at',"ASC")
                //     ->get();
                // $ram = InventarisRam::join('vendor', 'vendor.id', '=', 'inventaris_ram.idVendor')
                // ->join('ruangan', 'ruangan.id', '=', 'inventaris_ram.idRuangan')
                // ->select('inventaris_ram.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
                // ->where('tglPembelian', '>', $dari_tanggal)
                // ->where('tglPembelian', '<', $sampai_tanggal)
                //     ->where('keterangan',$request->jenis_laporan)
                //     ->orderBy('created_at',"ASC")
                //     ->get();
                // $storage = InventarisStorage::join('vendor', 'vendor.id', '=', 'inventaris_storage.idVendor')
                // ->join('ruangan', 'ruangan.id', '=', 'inventaris_storage.idRuangan')
                // ->select('inventaris_storage.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
                // ->where('tglPembelian', '>', $dari_tanggal)
                // ->where('tglPembelian', '<', $sampai_tanggal)
                //     ->where('keterangan',$request->jenis_laporan)
                //     ->orderBy('created_at',"ASC")
                //     ->get();
                // $gpu = InventarisGPU::join('vendor', 'vendor.id', '=', 'inventaris_gpu.idVendor')
                // ->join('ruangan', 'ruangan.id', '=', 'inventaris_gpu.idRuangan')
                // ->select('inventaris_gpu.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
                // ->where('tglPembelian', '>', $dari_tanggal)
                // ->where('tglPembelian', '<', $sampai_tanggal)
                //     ->where('keterangan',$request->jenis_laporan)
                //     ->orderBy('created_at',"ASC")
                //     ->get();
                // $psu = InventarisPsu::join('vendor', 'vendor.id', '=', 'inventaris_psu.idVendor')
                // ->join('ruangan', 'ruangan.id', '=', 'inventaris_psu.idRuangan')
                // ->select('inventaris_psu.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
                // ->where('tglPembelian', '>', $dari_tanggal)
                // ->where('tglPembelian', '<', $sampai_tanggal)
                //     ->where('keterangan',$request->jenis_laporan)
                //     ->orderBy('created_at',"ASC")
                //     ->get();
                // $casing = InventarisCasing::join('vendor', 'vendor.id', '=', 'inventaris_casing.idVendor')
                // ->join('ruangan', 'ruangan.id', '=', 'inventaris_casing.idRuangan')
                // ->select('inventaris_casing.*', 'kodeRuangan', 'namaRuangan', 'namaVendor')
                // ->where('tglPembelian', '>', $dari_tanggal)
                // ->where('tglPembelian', '<', $sampai_tanggal)
                // ->where('keterangan',$request->jenis_laporan)
                // ->orderBy('created_at',"ASC")
                // ->get();

                // $komputer = InventarisKomputer::where('tanggal_perakitan', '>', $dari_tanggal)
                // ->orderBy('created_at',"ASC")->where('tanggal_perakitan', '<', $sampai_tanggal)->where('keterangan',$request->jenis_laporan)
                // ->get();
                $data = Peminjaman::where('tglPeminjaman', '>', $dari_tanggal)
                ->where('tglPeminjaman', '<', $sampai_tanggal)->get();
                return view('laporan.print_peminjaman',compact('title','data','dari_tanggal','sampai_tanggal'));
            }
        }
        return view('laporan.print',compact('title','dari_tanggal','sampai_tanggal', 'data', 'motherboard', 'processor', 'ram', 'storage', 'gpu', 'psu', 'casing', 'komputer'));
    }
}
