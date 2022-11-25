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
        $title = "Data Peminjam";
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
            'status' => 'Sedang dipinjam'
        ]);

        if ($saved) {
            # code...
            for ($i=0; $i < count($request->idInventaris); $i++) {
                $update_inven = Inventaris::where('kodeInventaris',$request->idInventaris[$i])->update([
                    'keterangan' => "Sedang dipinjam"
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
            ->where('keterangan','!=','Sedang dipinjam')
            ->get();
        return view('peminjaman.create', compact('title', 'data'));
    }
    public function form_pengembalian($id){
        $title = "Pengembalian Barang";
        $data = Peminjaman::findOrFail($id);
        $inventaris = DetailPeminjaman::where("idPeminjaman",$data->id)->get();
        return view('peminjaman.return',compact('title','data','inventaris'));
    }
    public function pengembalian($id,request $request){
        try {
            Peminjaman::findOrFail($id)->update([
                'tglKembali' => date('Y-m-d'),
                'status' => "Sudah dikembalikan",
            ]);
            $data = DetailPeminjaman::where('idPeminjaman',$id)->get();
            $index = 0;
            foreach ($data as $item) {
                Inventaris::findOrFail($item->idInventaris)->update([
                    'kondisi' => $request->kondisi[$index],
                    'keterangan' => ($request->keterangan_inv[$index] ?? "-")
                ]);
                $index = $index + 1;
            }
            return redirect('/peminjaman')->with('message', 'Data Pengembalian Berhasil Disimpan');
        } catch (\Throwable $th) {
            return redirect('/peminjaman')->with('message', 'Data Pengembalian Gagal Disimpan');
        }
    }
    public function hapus($id){
        try {
            Peminjaman::findOrFail($id)->delete();
            $data = DetailPeminjaman::where('idPeminjaman', $id)->delete();
            return redirect('/peminjaman')->with('message', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect('/peminjaman')->with('message', 'Data Gagal Disimpan');
        }
    }
}
