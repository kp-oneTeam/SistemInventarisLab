@extends('layouts.master')
@section('inventaris', 'active')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Data Inventaris Peralatan Komputer</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body m-2">
                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab"
                                aria-controls="home" aria-selected="true">Motherboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab"
                                aria-controls="profile" aria-selected="false">Processor</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab"
                                aria-controls="contact" aria-selected="false">Ram</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab"
                                aria-controls="contact" aria-selected="false">Storage</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab5" data-toggle="tab" href="#contact5" role="tab"
                                aria-controls="contact" aria-selected="false">Graphics Processor Unit (GPU)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab6" data-toggle="tab" href="#contact6" role="tab"
                                aria-controls="contact" aria-selected="false">Power Supply(PSU)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab7" data-toggle="tab" href="#contact7" role="tab"
                                aria-controls="contact" aria-selected="false">Casing</a>
                        </li>
                    </ul>
                    <div class="tab-content m-5" id="myTabContent2">
                        {{-- motherboard --}}
                        <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                            <div class="row">
                                <div class="col-12 col-md-12  col-sm-12">
                                    <form action="{{ url('tambah/inventaris_peralatan_komputer/motherboard') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Nama Motheboard</label>
                                            <input type="text" name="nama_motherboard" class="form-control" >
                                            <small>Contoh: B450 Steel Legend</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Chipset</label>
                                            <input type="text" name="chipset_mb" class="form-control">
                                            <small>Contoh: B450, K450</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Socket Processor</label>
                                            <input type="text" name="socket_mb" class="form-control">
                                            <small>Contoh: AM4, LGA1155</small>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="">Slot Memori</label>
                                                <select name="memori_slot" class="form-control select2">
                                                    <option value="">-- Pilih Slot --</option>
                                                    <option value="2">Dual Channel</option>
                                                    <option value="4">Quad Channel</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="">Support Memori</label>
                                                <select name="memori_support" class="form-control select2">
                                                    <option value="">-- Pilih Memori Support --</option>
                                                    <option value="DDR3">DDR3</option>
                                                    <option value="DDR4">DDR4</option>
                                                    <option value="DDR5">DDR5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Vendor</label>
                                            <select name="vendor_mb" class="form-control select2" required>
                                                <option value="">-- Pilih Vendor --</option>
                                                @foreach ($vendor as $item)
                                                <option value="{{ $item->id }}">{{ $item->namaVendor }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <select name="lokasi_mb" class="form-control select2" required>
                                                <option value="">-- Pilih Ruang --</option>
                                                @foreach ($lokasi as $item)
                                                <option value="{{ $item->id }}">{{ $item->namaRuangan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input name="harga_mb" id="rupiah" type="text" class="form-control rupiah" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Pembelian</label>
                                            <input type="date" name="tanggal_pembelian_mb" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Kondisi</label>
                                            <div class="selectgroup w-100">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi_mb" value="Baik"
                                                        class="selectgroup-input" required>
                                                    <span class="selectgroup-button">Baik</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi_mb" value="Rusak"
                                                        class="selectgroup-input" required>
                                                    <span class="selectgroup-button">Rusak</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Keterangan</label>
                                            <textarea name="keterangan_mb" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit"
                                                class="btn btn-warning btn-icon icon-left btn-warning float-right m-2"><i
                                                    class="fas fa-save"></i>Simpan</button>
                                            <a href="{{ url('tambah/inventaris_peralatan_komputer') }}"
                                                class="btn btn-secondary btn-icon icon-left btn-primary float-right m-2"><i
                                                    class="fas fa-times"></i>Batal</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- processor --}}
                        <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                            <div class="row">
                                <div class="col-12 col-md-12  col-sm-12">
                                    <form action="{{ url('tambah/inventaris_peralatan_komputer/cpu') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Nama Processor</label><small>(Intel/AMD)</small>
                                            <input type="text" name="nama_motherboard" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Socket</label>
                                            <input type="text" name="jenis_motherboard" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Generasi</label>
                                            <input type="text" name="jenis_motherboard" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Series</label>
                                            <input type="text" name="jenis_motherboard" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kecepatan Processor</label>
                                            <input type="text" name="jenis_motherboard" class="form-control">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Jumlah Core</label>
                                                    <input type="text" name="jenis_motherboard" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Jumlah Threat</label>
                                                    <input type="text" name="jenis_motherboard" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <select name="lokasi" class="form-control select2" required>
                                                <option value="">-- Pilih Ruang --</option>
                                                @foreach ($lokasi as $item)
                                                <option value="{{ $item->id }}">{{ $item->namaRuangan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Vendor</label>
                                            <select name="vendor" class="form-control select2" required>
                                                <option value="">-- Pilih Vendor --</option>
                                                @foreach ($vendor as $item)
                                                <option value="{{ $item->id }}">{{ $item->namaVendor }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input name="harga" id="rupiah" type="text" class="form-control rupiah" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Pembelian</label>
                                            <input type="date" name="tanggal" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Kondisi</label>
                                            <div class="selectgroup w-100">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi" value="Baik"
                                                        class="selectgroup-input" required>
                                                    <span class="selectgroup-button">Baik</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi" value="Rusak"
                                                        class="selectgroup-input" required>
                                                    <span class="selectgroup-button">Rusak</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Keterangan</label>
                                            <textarea name="keterangan" class="form-control" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit"
                                                class="btn btn-warning btn-icon icon-left btn-warning float-right m-2"><i
                                                    class="fas fa-save"></i>Simpan</button>
                                            <a href="{{ url('inventaris') }}"
                                                class="btn btn-secondary btn-icon icon-left btn-primary float-right m-2"><i
                                                    class="fas fa-times"></i>Batal</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- Memory --}}
                        <div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                            <div class="row">
                                <div class="col-12 col-md-12  col-sm-12">
                                    <form action="{{ url('tambah/inventaris_peralatan_komputer/cpu') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Nama Memory</label>
                                            <input type="text" name="nama_motherboard" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jenis Memory</label><small>(DDR3/DDR4/DDR5)</small>
                                            <input type="text" name="jenis_motherboard" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tipe Memory</label>
                                            <input type="text" name="jenis_motherboard" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kecepatan / Frekuensi Memory</label>
                                            <input type="text" name="jenis_motherboard" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kapasistas Memory</label>
                                            <input type="text" name="jenis_motherboard" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kecepatan Processor</label>
                                            <input type="text" name="jenis_motherboard" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <select name="lokasi" class="form-control select2" required>
                                                <option value="">-- Pilih Ruang --</option>
                                                @foreach ($lokasi as $item)
                                                <option value="{{ $item->id }}">{{ $item->namaRuangan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Vendor</label>
                                            <select name="vendor" class="form-control select2" required>
                                                <option value="">-- Pilih Vendor --</option>
                                                @foreach ($vendor as $item)
                                                <option value="{{ $item->id }}">{{ $item->namaVendor }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input name="harga" id="rupiah" type="text" class="form-control rupiah" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Pembelian</label>
                                            <input type="date" name="tanggal" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Kondisi</label>
                                            <div class="selectgroup w-100">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi" value="Baik"
                                                        class="selectgroup-input" required>
                                                    <span class="selectgroup-button">Baik</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi" value="Rusak"
                                                        class="selectgroup-input" required>
                                                    <span class="selectgroup-button">Rusak</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Keterangan</label>
                                            <textarea name="keterangan" class="form-control" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit"
                                                class="btn btn-warning btn-icon icon-left btn-warning float-right m-2"><i
                                                    class="fas fa-save"></i>Simpan</button>
                                            <a href="{{ url('inventaris') }}"
                                                class="btn btn-secondary btn-icon icon-left btn-primary float-right m-2"><i
                                                    class="fas fa-times"></i>Batal</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- storage --}}
                        <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab3">
                            <div class="row">
                                <div class="col-12 col-md-12  col-sm-12">
                                    <form action="{{ url('tambah/inventaris_peralatan_komputer/cpu') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Nama Storage</label>
                                            <input type="text" name="nama_motherboard" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jenis Storage</label><small>(HDD/NVME/SSD)</small>
                                            <input type="text" name="jenis_motherboard" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kapasistas</label>
                                            <input type="text" name="jenis_motherboard" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <select name="lokasi" class="form-control select2" required>
                                                <option value="">-- Pilih Ruang --</option>
                                                @foreach ($lokasi as $item)
                                                <option value="{{ $item->id }}">{{ $item->namaRuangan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Vendor</label>
                                            <select name="vendor" class="form-control select2" required>
                                                <option value="">-- Pilih Vendor --</option>
                                                @foreach ($vendor as $item)
                                                <option value="{{ $item->id }}">{{ $item->namaVendor }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input name="harga" id="rupiah" type="text" class="form-control rupiah" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Pembelian</label>
                                            <input type="date" name="tanggal" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Kondisi</label>
                                            <div class="selectgroup w-100">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi" value="Baik"
                                                        class="selectgroup-input" required>
                                                    <span class="selectgroup-button">Baik</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi" value="Rusak"
                                                        class="selectgroup-input" required>
                                                    <span class="selectgroup-button">Rusak</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Keterangan</label>
                                            <textarea name="keterangan" class="form-control" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit"
                                                class="btn btn-warning btn-icon icon-left btn-warning float-right m-2"><i
                                                    class="fas fa-save"></i>Simpan</button>
                                            <a href="{{ url('inventaris') }}"
                                                class="btn btn-secondary btn-icon icon-left btn-primary float-right m-2"><i
                                                    class="fas fa-times"></i>Batal</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- GPU --}}
                        <div class="tab-pane fade" id="contact5" role="tabpanel" aria-labelledby="contact-tab3">
                            <div class="row">
                                <div class="col-12 col-md-12  col-sm-12">
                                    <form action="{{ url('tambah/inventaris_peralatan_komputer/cpu') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Nama GPU</label>
                                            <input type="text" name="nama_motherboard" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jenis GPU</label><small>(Nvidia/AMD)</small>
                                            <input type="text" name="jenis_motherboard" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jenis Memory GPU</label>(GDDR3/GDDR4/GDDR5/dll)
                                            <input type="text" name="jenis_motherboard" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kapasistas Memory GPU</label>
                                            <input type="text" name="jenis_motherboard" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <select name="lokasi" class="form-control select2" required>
                                                <option value="">-- Pilih Ruang --</option>
                                                @foreach ($lokasi as $item)
                                                <option value="{{ $item->id }}">{{ $item->namaRuangan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Vendor</label>
                                            <select name="vendor" class="form-control select2" required>
                                                <option value="">-- Pilih Vendor --</option>
                                                @foreach ($vendor as $item)
                                                <option value="{{ $item->id }}">{{ $item->namaVendor }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input name="harga" id="rupiah" type="text" class="form-control rupiah" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Pembelian</label>
                                            <input type="date" name="tanggal" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Kondisi</label>
                                            <div class="selectgroup w-100">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi" value="Baik"
                                                        class="selectgroup-input" required>
                                                    <span class="selectgroup-button">Baik</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi" value="Rusak"
                                                        class="selectgroup-input" required>
                                                    <span class="selectgroup-button">Rusak</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Keterangan</label>
                                            <textarea name="keterangan" class="form-control" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit"
                                                class="btn btn-warning btn-icon icon-left btn-warning float-right m-2"><i
                                                    class="fas fa-save"></i>Simpan</button>
                                            <a href="{{ url('inventaris') }}"
                                                class="btn btn-secondary btn-icon icon-left btn-primary float-right m-2"><i
                                                    class="fas fa-times"></i>Batal</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- PSU --}}
                        <div class="tab-pane fade" id="contact6" role="tabpanel" aria-labelledby="contact-tab3">
                            <div class="row">
                                <div class="col-12 col-md-12  col-sm-12">
                                    <form action="{{ url('tambah/inventaris_peralatan_komputer/cpu') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Nama PSU</label>
                                            <input type="text" name="nama_motherboard" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jenis PSU</label><small>(ATX/MINI ATX/dll)</small>
                                            <input type="text" name="jenis_motherboard" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jenis Kabel PSU</label><small>(Modular/Non Modular)</small>
                                            <input type="text" name="jenis_motherboard" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Besar Daya</label>
                                            <input type="text" name="jenis_motherboard" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <select name="lokasi" class="form-control select2" required>
                                                <option value="">-- Pilih Ruang --</option>
                                                @foreach ($lokasi as $item)
                                                <option value="{{ $item->id }}">{{ $item->namaRuangan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Vendor</label>
                                            <select name="vendor" class="form-control select2" required>
                                                <option value="">-- Pilih Vendor --</option>
                                                @foreach ($vendor as $item)
                                                <option value="{{ $item->id }}">{{ $item->namaVendor }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input name="harga" id="rupiah" type="text" class="form-control rupiah" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Pembelian</label>
                                            <input type="date" name="tanggal" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Kondisi</label>
                                            <div class="selectgroup w-100">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi" value="Baik"
                                                        class="selectgroup-input" required>
                                                    <span class="selectgroup-button">Baik</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi" value="Rusak"
                                                        class="selectgroup-input" required>
                                                    <span class="selectgroup-button">Rusak</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Keterangan</label>
                                            <textarea name="keterangan" class="form-control" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit"
                                                class="btn btn-warning btn-icon icon-left btn-warning float-right m-2"><i
                                                    class="fas fa-save"></i>Simpan</button>
                                            <a href="{{ url('inventaris') }}"
                                                class="btn btn-secondary btn-icon icon-left btn-primary float-right m-2"><i
                                                    class="fas fa-times"></i>Batal</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- Casing --}}
                        <div class="tab-pane fade" id="contact7" role="tabpanel" aria-labelledby="contact-tab3">
                            <div class="row">
                                <div class="col-12 col-md-12  col-sm-12">
                                    <form action="{{ url('tambah/inventaris_peralatan_komputer/cpu') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Nama Casing</label>
                                            <input type="text" name="nama_motherboard" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jenis Casing</label><small>(ATX/MINI ATX/dll)</small>
                                            <input type="text" name="jenis_motherboard" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <select name="lokasi" class="form-control select2" required>
                                                <option value="">-- Pilih Ruang --</option>
                                                @foreach ($lokasi as $item)
                                                <option value="{{ $item->id }}">{{ $item->namaRuangan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Vendor</label>
                                            <select name="vendor" class="form-control select2" required>
                                                <option value="">-- Pilih Vendor --</option>
                                                @foreach ($vendor as $item)
                                                <option value="{{ $item->id }}">{{ $item->namaVendor }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input name="harga" id="rupiah" type="text" class="form-control rupiah" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Pembelian</label>
                                            <input type="date" name="tanggal" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Kondisi</label>
                                            <div class="selectgroup w-100">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi" value="Baik"
                                                        class="selectgroup-input" required>
                                                    <span class="selectgroup-button">Baik</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi" value="Rusak"
                                                        class="selectgroup-input" required>
                                                    <span class="selectgroup-button">Rusak</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Keterangan</label>
                                            <textarea name="keterangan" class="form-control" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit"
                                                class="btn btn-warning btn-icon icon-left btn-warning float-right m-2"><i
                                                    class="fas fa-save"></i>Simpan</button>
                                            <a href="{{ url('inventaris') }}"
                                                class="btn btn-secondary btn-icon icon-left btn-primary float-right m-2"><i
                                                    class="fas fa-times"></i>Batal</a>
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
<script>
    var rupiah = document.getElementById("rupiah");
    rupiah.addEventListener("keyup", function (e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, "Rp. ");
    });
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }
        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }
</script>
@endsection
