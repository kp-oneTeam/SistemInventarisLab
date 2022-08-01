@extends('layouts.master')
@section('peminjaman', 'active')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Data Peminjaman</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-warning">Rincian Peminjaman</h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('tambah/peminjaman') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama/Alat</label>
                            <select name="nama_alat" class="form-control select">
                                <option >Camera EOS M200</option>
                                <option >Ram 4 GB</option>
                                <option >Monitor AOC 24 inch</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Peminjam</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>No.Identitas (NID/NIP/NIM)</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label >Tujuan Peminjaman</label>
                            <textarea name="spek" id="" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Peminjaman</label>
                            <input type="date" name="tanggal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label >Keterangan</label>
                            <textarea name="ket" id="" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning btn-icon icon-left btn-warning float-right m-2"><i class="fas fa-save"></i>Simpan</button>
                            <a href="{{ url('peminjaman') }}" class="btn btn-secondary btn-icon icon-left btn-primary float-right m-2"><i class="fas fa-times"></i>Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection