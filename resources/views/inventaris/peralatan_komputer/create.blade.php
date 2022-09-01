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
                            <a class="nav-link {{ request()->is('inventaris/peralatan-komputer/tambah/motherboard') ? 'active' : null }}" id="home-tab3" href="{{ url('inventaris/peralatan-komputer/tambah/motherboard') }}" role="tab"
                                aria-controls="home" aria-selected="true">Motherboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('inventaris/peralatan-komputer/tambah/processor') ? 'active' : null }}" id="profile-tab3" href="{{ url('inventaris/peralatan-komputer/tambah/processor') }}" role="tab"
                                aria-controls="profile" aria-selected="false">Processor</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('inventaris/peralatan-komputer/tambah/ram') ? 'active' : null }}" id="contact-tab3" href="{{ url('inventaris/peralatan-komputer/tambah/ram') }}" role="tab"
                                aria-controls="contact" aria-selected="false">Ram</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('inventaris/peralatan-komputer/tambah/storage') ? 'active' : null }}" id="contact-tab4" href="{{ url('inventaris/peralatan-komputer/tambah/storage') }}" role="tab"
                                aria-controls="contact" aria-selected="false">Storage</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('inventaris/peralatan-komputer/tambah/gpu') ? 'active' : null }}" id="contact-tab5" href="{{ url('inventaris/peralatan-komputer/tambah/gpu') }}" role="tab"
                                aria-controls="contact" aria-selected="false">Graphics Processor Unit (GPU)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('inventaris/peralatan-komputer/tambah/psu') ? 'active' : null }}" id="contact-tab6" href="{{ url('inventaris/peralatan-komputer/tambah/psu') }}" role="tab"
                                aria-controls="contact" aria-selected="false">Power Supply(PSU)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('inventaris/peralatan-komputer/tambah/casing') ? 'active' : null }}" id="contact-tab7" href="{{ url('inventaris/peralatan-komputer/tambah/casing') }}" role="tab"
                                aria-controls="contact" aria-selected="false">Casing</a>
                        </li>
                    </ul>
                    <div class="tab-content m-5" id="myTabContent2">
                        {{-- motherboard --}}
                        <div class="tab-pane fade show {{ request()->is('inventaris/peralatan-komputer/tambah/motherboard') ? 'active' : null }}" id="{{ url('inventaris/peralatan-komputer/tambah/motherboard') }}" role="tabpanel" aria-labelledby="home-tab3">
                            <div class="row">
                                <div class="col-12 col-md-12  col-sm-12">
                                    <form action="{{ url('tambah/inventaris_peralatan_komputer/motherboard') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Nama Motheboard</label>
                                            <input type="text" name="nama_motherboard" class="form-control" required >
                                            <small>Contoh: B450 Steel Legend</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Chipset</label>
                                            <input type="text" name="chipset_mb" class="form-control" required>
                                            <small>Contoh: B450, K450</small>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="">Socket Processor</label>
                                                <input type="text" name="socket_mb" class="form-control" required>
                                                <small>Contoh: AM4, LGA1155</small>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="">Form Factor</label>
                                                <select name="form_factor" class="form-control select2" required>
                                                    <option selected>-- Pilih Form Factor --</option>
                                                    <option value="ATX">ATX</option>
                                                    <option value="Micro-ATX">Micro-ATX</option>
                                                    <option value="Mini-ATX">Mini-ATX</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="">Slot Memori</label>
                                                <select name="memori_slot" class="form-control select2" required>
                                                    <option selected>-- Pilih Slot --</option>
                                                    <option value="2">Dual Channel</option>
                                                    <option value="4">Quad Channel</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="">Support Memori</label>
                                                <select name="memori_support" class="form-control select2" required>
                                                    <option selected>-- Pilih Memori Support --</option>
                                                    <option value="DDR3">DDR3</option>
                                                    <option value="DDR4">DDR4</option>
                                                    <option value="DDR5">DDR5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Vendor</label>
                                            <select name="vendor_mb" class="form-control select2" required>
                                                <option selected>-- Pilih Vendor --</option>
                                                @foreach ($vendor as $item)
                                                <option value="{{ $item->id }}">{{ $item->namaVendor }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <select name="lokasi_mb" class="form-control select2" required>
                                                <option selected>-- Pilih Ruang --</option>
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
                        <div class="tab-pane fade show {{ request()->is('inventaris/peralatan-komputer/tambah/processor') ? 'active' : null }}" id="{{ url('inventaris/peralatan-komputer/tambah/processor') }}" role="tabpanel" aria-labelledby="profile-tab3">
                            <div class="row">
                                <div class="col-12 col-md-12  col-sm-12">
                                    <form action="{{ url('tambah/inventaris_peralatan_komputer/cpu') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Nama Processor</label><small>(Intel/AMD)</small>
                                            <input type="text" name="nama_processor" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Series</label>
                                            <input type="text" name="series" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nomor Processor</label>
                                            <input type="text" name="nomor_processor" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Socket</label>
                                            <input type="text" name="socket" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Generasi</label>
                                            <input type="text" name="generasi" class="form-control">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Kecepatan Processor</label>
                                                    <div class="input-group">
                                                        <input type="text" name="kecepatan_processor" class="form-control">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">GHz</span>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Jumlah Core</label>
                                                    <div class="input-group">
                                                        <input type="text" name="jumlah_core" class="form-control">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">Core</span>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Jumlah Thread</label>
                                                    <div class="input-group">
                                                        <input type="text" name="jumlah_thread" class="form-control">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">Thread</span>
                                                    </div>
                                                    </div>
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
                                            <textarea name="keterangan" class="form-control"></textarea>
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
                        <div class="tab-pane fade show {{ request()->is('inventaris/peralatan-komputer/tambah/ram') ? 'active' : null }}" id="{{ url('inventaris/peralatan-komputer/tambah/ram') }}" role="tabpanel" aria-labelledby="contact-tab3">
                            <div class="row">
                                <div class="col-12 col-md-12  col-sm-12">
                                    <form action="{{ url('tambah/inventaris_peralatan_komputer/ram') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Nama Memory</label>
                                            <input type="text" name="nama_memory" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jenis Memory</label><small>(DDR3/DDR4/DDR5)</small>
                                            <input type="text" name="jenis_memory" class="form-control">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Tipe Memory</label>
                                                    <div class="input-group">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">PC</span>
                                                        </div>
                                                        <input type="text" name="tipe_memory" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Kapasitas Memory</label>
                                                    <div class="input-group">
                                                        <input type="text" name="kapasitas_memory" class="form-control">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">GB</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="">Kecepatan / Frekuensi Memory</label>
                                                    <div class="input-group">
                                                        <input type="text" name="frekuensi_memory" class="form-control">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">Hz</span>
                                                        </div>
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
                        {{-- storage --}}
                        <div class="tab-pane fade show {{ request()->is('inventaris/peralatan-komputer/tambah/storage') ? 'active' : null }}" id="{{ url('inventaris/peralatan-komputer/tambah/storage') }}" role="tabpanel" aria-labelledby="contact-tab3">
                            <div class="row">
                                <div class="col-12 col-md-12  col-sm-12">
                                    <form action="{{ url('tambah/inventaris_peralatan_komputer/storage') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Nama Storage</label>
                                            <input type="text" name="nama_storage" class="form-control">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Jenis Storage</label><small>(HDD/NVME/SSD)</small>
                                                    <select name="jenis_storage" id="" class="form-control">
                                                        <option value="">-- Pilih Jenis Storage --</option>
                                                        <option value="HDD">HDD</option>
                                                        <option value="NVME">NVME</option>
                                                        <option value="SSD">SSD</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Kapasitas Storage</label>
                                                    <div class="input-group">
                                                        <input type="number" min="1" name="kapasitas_storage" class="form-control" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">GB</span>
                                                        </div>
                                                    </div>
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
                        {{-- GPU --}}
                        <div class="tab-pane fade show {{ request()->is('inventaris/peralatan-komputer/tambah/gpu') ? 'active' : null }}" id="{{ url('inventaris/peralatan-komputer/tambah/gpu') }}" role="tabpanel" aria-labelledby="contact-tab3">
                            <div class="row">
                                <div class="col-12 col-md-12  col-sm-12">
                                    <form action="{{ url('tambah/inventaris_peralatan_komputer/gpu') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Nama GPU</label>
                                            <input type="text" name="nama_gpu" class="form-control" required>
                                            <small>Contoh : MSI GeForce® GTX 1050</small>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-3">
                                                <label for="">Ukuran Memori</label>
                                                <div class="input-group">
                                                    <input type="text" name="ukuran_memori_gpu" class="form-control" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">GB</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-3">
                                                <label for="">Memori Interface</label>
                                                <div class="input-group">
                                                    <input type="text" name="memori_interface_gpu" class="form-control" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">bit</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-3">
                                                <label for="">Kecepatan Memori</label>
                                                <div class="input-group">
                                                    <input type="text" name="kecepatan_memori_gpu" class="form-control" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">MHz</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-3">
                                                <label for="">Tipe Memori</label>
                                                <input type="text" name="tipe_memori_gpu" class="form-control" required>
                                                <small>Contoh : GDDR3, GDDR5</small>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <select name="lokasi_gpu" class="form-control select2" required>
                                                <option selected>-- Pilih Ruang --</option>
                                                @foreach ($lokasi as $item)
                                                <option value="{{ $item->id }}">{{ $item->namaRuangan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Vendor</label>
                                            <select name="vendor_gpu" class="form-control select2" required>
                                                <option selected>-- Pilih Vendor --</option>
                                                @foreach ($vendor as $item)
                                                <option value="{{ $item->id }}">{{ $item->namaVendor }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input name="harga_gpu" id="rupiah" type="text" class="form-control rupiah" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Pembelian</label>
                                            <input type="date" name="tgl_pembelian_gpu" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Kondisi</label>
                                            <div class="selectgroup w-100">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi_gpu" value="Baik"
                                                        class="selectgroup-input" required>
                                                    <span class="selectgroup-button">Baik</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi_gpu" value="Rusak"
                                                        class="selectgroup-input" required>
                                                    <span class="selectgroup-button">Rusak</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Keterangan</label>
                                            <textarea name="keterangan_gpu" class="form-control"></textarea>
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
                        <div class="tab-pane fade show {{ request()->is('inventaris/peralatan-komputer/tambah/psu') ? 'active' : null }}" id="{{ url('inventaris/peralatan-komputer/tambah/psu') }}" role="tabpanel" aria-labelledby="contact-tab3">
                            <div class="row">
                                <div class="col-12 col-md-12  col-sm-12">
                                    <form action="{{ url('tambah/inventaris_peralatan_komputer/psu') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Nama PSU</label>
                                            <input type="text" name="nama_psu" class="form-control">
                                            <small>Contoh : be quiet! SYSTEM POWER 9</small>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="">Form Factor PSU</label><small>(ATX/MINI ATX/dll)</small>
                                                <select name="form_factor_psu" class="form-control select2" required>
                                                    <option selected>-- Pilih Form Factor --</option>
                                                    <option value="ATX">ATX</option>
                                                    <option value="Micro-ATX">Micro-ATX</option>
                                                    <option value="Mini-ATX">Mini-ATX</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="">Jenis Kabel PSU</label><small>(Modular/Non Modular)</small>
                                                <select name="jenis_kabel_psu" class="form-control select2" required>
                                                    <option selected>-- Pilih Jenis Kabel --</option>
                                                    <option value="Modular">Modular</option>
                                                    <option value="Non-Modular">Non-Modular</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="">Besar Daya</label>
                                                <div class="input-group">
                                                    <input type="text" name="besar_daya_psu" class="form-control" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">Watt</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="">Sertifikasi PSU</label>
                                                <select name="sertifikasi_psu" class="form-control select2" required>
                                                    <option selected>-- Pilih Sertifikasi --</option>
                                                    <option value="Non-Sertifikasi">Non-Sertifikasi</option>
                                                    <option value="80+">80+</option>
                                                    <option value="80+ Bronze">80+ Bronze</option>
                                                    <option value="80+ Silver">80+ Silver</option>
                                                    <option value="80+ Gold">80+ Gold</option>
                                                    <option value="80+ Platinum">80+ Platinum</option>
                                                    <option value="80+ Titanium">80+ Titanium</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label>Lokasi</label>
                                                <select name="lokasi_psu" class="form-control select2" required>
                                                    <option value="">-- Pilih Ruang --</option>
                                                    @foreach ($lokasi as $item)
                                                    <option value="{{ $item->id }}">{{ $item->namaRuangan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <label>Vendor</label>
                                                <select name="vendor_psu" class="form-control select2" required>
                                                    <option value="">-- Pilih Vendor --</option>
                                                    @foreach ($vendor as $item)
                                                    <option value="{{ $item->id }}">{{ $item->namaVendor }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input name="harga_psu" id="rupiah" type="text" class="form-control rupiah" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Pembelian</label>
                                            <input type="date" name="tgl_pembelian_psu" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Kondisi</label>
                                            <div class="selectgroup w-100">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi_psu" value="Baik"
                                                        class="selectgroup-input" required>
                                                    <span class="selectgroup-button">Baik</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi_psu" value="Rusak"
                                                        class="selectgroup-input" required>
                                                    <span class="selectgroup-button">Rusak</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Keterangan</label>
                                            <textarea name="keterangan_psu" class="form-control"></textarea>
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
                        <div class="tab-pane fade show {{ request()->is('inventaris/peralatan-komputer/tambah/casing') ? 'active' : null }}" id="{{ url('inventaris/peralatan-komputer/tambah/casing') }}" role="tabpanel" aria-labelledby="contact-tab3">
                            <div class="row">
                                <div class="col-12 col-md-12  col-sm-12">
                                    <form action="{{ url('tambah/inventaris_peralatan_komputer/casing') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Nama Casing</label>
                                            <input type="text" name="nama_casing" class="form-control">
                                            <small>Contoh: Powerlogic Armaggeddon Tessaraxx Apex 7</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Form Factor Casing</label><small>(ATX/MINI ATX/dll)</small>
                                            <select name="form_factor_casing" class="form-control select2" required>
                                                <option selected>-- Pilih Form Factor --</option>
                                                <option value="ATX">ATX</option>
                                                <option value="Micro-ATX">Micro-ATX</option>
                                                <option value="Mini-ATX">Mini-ATX</option>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label>Lokasi</label>
                                                <select name="lokasi_casing" class="form-control select2" required>
                                                    <option value="">-- Pilih Ruang --</option>
                                                    @foreach ($lokasi as $item)
                                                    <option value="{{ $item->id }}">{{ $item->namaRuangan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <label>Vendor</label>
                                                <select name="vendor_casing" class="form-control select2" required>
                                                    <option value="">-- Pilih Vendor --</option>
                                                    @foreach ($vendor as $item)
                                                    <option value="{{ $item->id }}">{{ $item->namaVendor }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input name="harga_casing" id="rupiah" type="text" class="form-control rupiah" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Pembelian</label>
                                            <input type="date" name="tgl_pembelian_casing" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Kondisi</label>
                                            <div class="selectgroup w-100">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi_casing" value="Baik"
                                                        class="selectgroup-input" required>
                                                    <span class="selectgroup-button">Baik</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi_casing" value="Rusak"
                                                        class="selectgroup-input" required>
                                                    <span class="selectgroup-button">Rusak</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Keterangan</label>
                                            <textarea name="keterangan_casing" class="form-control" ></textarea>
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
    $('.rupiah').keypress(function () {
        var val = this.value;
        var rp = formatRupiah(val,"Rp. ");
        $(this).val(rp);
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
