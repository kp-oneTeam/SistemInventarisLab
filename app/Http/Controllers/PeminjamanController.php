<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventaris;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
class PeminjamanController extends Controller
{
    //
    public function index(){
        $title = "Manajemen Peminjaman";
        $dataPeminjaman = Peminjaman::get();
        return view('peminjaman.index',compact('title', 'dataPeminjaman'));
    }
    public function tambah_peminjaman(request $request){
        $saved = Peminjaman::create([
            'kodePeminjaman' => '3213537581236',
            'noIdentitas' => $request->no_identitas,
            'namaPeminjam' => $request->nama_peminjam,
            'tujuanPeminjaman' => $request->tujuan_peminjaman,
            'tglPeminjaman' => $request->tanggal_pinjam,
            'status' => 'Sedang Dipinjam'
        ]);

        if ($saved) {
            # code...
            for ($i=0; $i < count($request->idInventaris); $i++) { 
                $update_inven = Inventaris::where('kodeInventaris',$request->idInventaris[$i])->update([
                    'keterangan' => "Sedang Dipinjam"
                ]);
                $invent = Inventaris::where('kodeInventaris',$request->idInventaris[$i])->first();
                $simpan_detail = DetailPeminjaman::create([
                    'idPeminjaman' => $saved->id,
                    'idInventaris' => $invent->id
            ]);
            }
        }
        return redirect('/peminjaman')->with('message', 'Data Peminjaman Berhasil Disimpan');
    }
    public function form_tambah_peminjaman()
    {
        $title = "Tambah Peminjaman";
        $data = Inventaris::join('barang','barang.id','=','inventaris.idBarang')
            ->join('vendor', 'vendor.id', '=', 'inventaris.idVendor')
            ->join('ruangan', 'ruangan.id', '=', 'inventaris.idRuangan')
            ->select('kodeInventaris','namaBarang','spesifikasi','namaRuangan','kondisi','keterangan','tgl_pembelian')
            ->get();
        return view('peminjaman.create', compact('title', 'data'));
    }
    public function form_pengembalian($id){
        $title = "Pengembalian Barang";
        return view('peminjaman.return',compact('title'));
    }
}
