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
                    <div class="row">
                                <div class="col-12 col-md-12  col-sm-12">
                                    <form action="{{ url('ubah/inventaris/'.$data->kodeInventaris) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                        <div class="form-group">
                                            <label>Nama Barang</label>
                                            <select name="nama_barang" class="form-control select2" required>

                                                <option value="{{ $data->idBarang }}">{{ $data->barang->namaBarang}}</option>
                                                @foreach ($barang as $item)
                                                @if ($item->id != $data->idBarang)
                                                <option value="{{ $item->id }}">{{ $item->namaBarang }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <select name="lokasi" class="form-control select2" required>
                                                <option value="{{ $data->idRuangan }}">{{$data->ruangan->namaRuangan}}</option>
                                                @foreach ($lokasi as $item)
                                                @if ($item->id != $data->idRuangan)
                                                <option value="{{ $item->id }}">{{ $item->namaRuangan }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Spesifikasi</label>
                                            <textarea name="spek" id="" class="form-control" required>{{ $data->spesifikasi }}
                                            </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Vendor</label>
                                            <select name="vendor" class="form-control select2" required>
                                                <option value="{{ $data->idVendor }}">{{$data->vendor->namaVendor}}</option>
                                                @foreach ($vendor as $item)
                                                @if ($item->id != $data->idVendor)
                                                <option value="{{ $item->id }}">{{ $item->namaVendor }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input name="harga" id="rupiah" type="text" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Pembelian</label>
                                            <input type="date" name="tanggal" class="form-control" value="{{ $data->tgl_pembelian }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Kondisi</label>
                                            <div class="selectgroup w-100">
                                                @if ($data->kondisi == "Baik")
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi" value="Baik" class="selectgroup-input" checked required>
                                                    <span class="selectgroup-button">Baik</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi" value="Rusak" class="selectgroup-input" required>
                                                    <span class="selectgroup-button">Rusak</span>
                                                </label>
                                                @else
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi" value="Baik" class="selectgroup-input" required>
                                                    <span class="selectgroup-button">Baik</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="kondisi" value="Rusak" class="selectgroup-input" checked required>
                                                    <span class="selectgroup-button">Rusak</span>
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Keterangan</label>
                                            <textarea name="keterangan" class="form-control" required>{{ $data->keterangan }}</textarea>
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
</section>
<script>
    var rupiah = document.getElementById("rupiah");
    rupiah.addEventListener("keyup", function(e) {
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
    $(document).ready(function () {
        $("#rupiah").val(formatRupiah("{{ $data->harga }}","Rp ."));
    })
</script>
@endsection
