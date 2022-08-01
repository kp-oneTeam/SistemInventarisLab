@extends('layouts.master')
@section('inventaris', 'active')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Ubah Data Inventaris</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body m-5">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Non Komputer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Komputer</a>
                    </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row">
                                <div class="col-12 col-md-6=12  col-sm-12">
                                    <form action="{{ url('tambah/inventaris') }}" method="post">
                                    @csrf
                                        <div class="form-group">
                                            <label>Nama Barang</label>
                                            <select name="nama_barang" class="form-control select2">
                                                <option>Monitor</option>
                                                <option>RAM</option>
                                                <option>Storage</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <select name="lokasi" class="form-control select2">
                                                <option>R.TU</option>
                                                <option>R.35</option>
                                                <option>R.34</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Spesifikasi</label>
                                            <textarea name="spek" id="" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Vendor</label>
                                            <select name="lokasi" class="form-control select2">
                                                <option>PT KARYA CITRA</option>
                                                <option>PT CITRA KARYA</option>
                                                <option>PT MAKMUR JAYA</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input name="harga" type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Pembelian</label>
                                            <input type="date" name="tanggal" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Kondisi</label>
                                            <div class="selectgroup w-100">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi" value="Baik" class="selectgroup-input">
                                                    <span class="selectgroup-button">Baik</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi" value="Rusak" class="selectgroup-input">
                                                    <span class="selectgroup-button">Rusak</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Keterangan</label>
                                            <textarea name="keterangan" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-warning btn-icon icon-left btn-warning float-right m-2"><i class="fas fa-save"></i>Simpan</button>
                                            <a href="{{ url('inventaris') }}" class="btn btn-secondary btn-icon icon-left btn-primary float-right m-2"><i class="fas fa-times"></i>Batal</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="row">
                                <div class="col-12 col-md-6=12  col-sm-12">
                                    <form action="{{ url('tambah/inventaris') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Lokasi</label>
                                        <select name="lokasi" class="form-control select2">
                                            <option>R.TU</option>
                                            <option>R.35</option>
                                            <option>R.34</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Motherboard</label>
                                        <select name="motherboard" class="form-control select2">
                                            <option>MSI B350</option>
                                            <option>MSI B450</option>
                                            <option>MSI B550</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Processor</label>
                                        <select name="processor" class="form-control select2">
                                            <option>AMD</option>
                                            <option>INTEL</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ram </label>
                                        <select name="ram" class="form-control select2">
                                            <option>DDR3 4GB</option>
                                            <option>DDR4 4GB</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ram 2</label>
                                        <select name="ram" class="form-control select2">
                                            <option>DDR3 4GB</option>
                                            <option>DDR4 4GB</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>VGA</label>
                                        <select name="vga" class="form-control select2">
                                            <option>NVIDIA</option>
                                            <option>RADEON</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Storage</label>
                                        <select name="storage" class="form-control select2">
                                            <option>HDD 500GB</option>
                                            <option>SDD 500GB</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Storage 2</label>
                                        <select name="storage" class="form-control select2">
                                            <option>HDD 500GB</option>
                                            <option>SDD 500GB</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>PSU</label>
                                        <select name="psu" class="form-control select2">
                                            <option>MWE 450 80+</option>
                                            <option>MWE 500 80+</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>CASING</label>
                                        <select name="casing" class="form-control select2">
                                            <option>SIMBADA</option>
                                            <option>SIMBADA ATX</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Perakitan</label>
                                        <input type="date" name="tanggal" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Kondisi</label>
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="kondisi" value="Baik" class="selectgroup-input">
                                                <span class="selectgroup-button">Baik</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="kondisi" value="Rusak" class="selectgroup-input">
                                                <span class="selectgroup-button">Rusak</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Keterangan</label>
                                        <textarea name="keterangan" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-warning btn-icon icon-left btn-warning float-right m-2"><i class="fas fa-save"></i>Simpan</button>
                                        <a href="{{ url('inventaris') }}" class="btn btn-secondary btn-icon icon-left btn-primary float-right m-2"><i class="fas fa-times"></i>Batal</a>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
