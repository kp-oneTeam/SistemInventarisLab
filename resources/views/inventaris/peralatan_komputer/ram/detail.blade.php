@extends('layouts.master')
@section('inventaris', 'active')
@section('content')
<section class="section">
    <div class="section-header">
        <a href="{{ url('inventaris/peralatan-komputer') }}" class="btn btn-warning mr-4"><i
                class="fas fa-arrow-left"></i></a>
        <h1>Detail Inventaris RAM (Random Access Memory)</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12  col-sm-12">
                            <form action="{{ url('tambah/inventaris_peralatan_komputer/ram') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Kode Inventaris</label>
                                    <input disabled type="text" value="{{ $data->kodeInventaris }}" name="ki"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Nama / Merk Memory</label>
                                    <input disabled type="text" value="{{ $data->namaMemory }}" name="nama_memory"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Memory</label><small>(DDR3/DDR4/DDR5)</small>
                                    <input disabled type="text" value="{{ $data->jenisMemory }}" name="jenis_memory"
                                        class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tipe Memory</label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">PC</span>
                                                </div>
                                                <input disabled type="text" value="{{ $data->tipeMemory }}"
                                                    name="tipe_memory" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Kapasitas Memory</label>
                                            <div class="input-group">
                                                <input disabled type="text" value="{{ $data->kapasitasMemory }}"
                                                    name="kapasitas_memory" class="form-control">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">GB</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Kecepatan / Frekuensi Memory</label>
                                        <div class="input-group">
                                            <input disabled type="text" value="{{ $data->frekuensiMemory }}"
                                                name="frekuensi_memory" class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Hz</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Lokasi</label>
                                    <select disabled name="lokasi" class="form-control select2" required>
                                        <option value="">{{$data->ruangan->namaRuangan}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Vendor</label>
                                    <select disabled name="vendor" class="form-control select2" required>
                                        <option value="">{{ $data->vendor->namaVendor }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input disabled value="{{ $data->harga }}" name="harga" id="rupiah" type="text"
                                        class="form-control rupiah" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Pembelian</label>
                                    <input disabled value="{{ $data->tglPembelian }}" type="date" name="tanggal"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kondisi</label>
                                    <div class="selectgroup w-100">
                                        @if ($data->kondisi == "Baik")
                                        <label class="selectgroup-item">
                                            <input disabled type="radio" name="kondisi" value="Baik"
                                                class="selectgroup-input" checked required>
                                            <span class="selectgroup-button">Baik</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input disabled type="radio" name="kondisi" value="Rusak"
                                                class="selectgroup-input" required>
                                            <span class="selectgroup-button">Rusak</span>
                                        </label>
                                        @else
                                        <label class="selectgroup-item">
                                            <input disabled type="radio" name="kondisi" value="Baik"
                                                class="selectgroup-input" required>
                                            <span class="selectgroup-button">Baik</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input disabled type="radio" name="kondisi" value="Rusak"
                                                class="selectgroup-input" checked required>
                                            <span class="selectgroup-button">Rusak</span>
                                        </label>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Keterangan</label>
                                    <textarea disabled name="keterangan_mb"
                                        class="form-control">{{ $data->keterangan }}</textarea>
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
    $(document).ready(function () {
        var val = $('#rupiah').val();
        var rp = formatRupiah(val, "Rp. ");
        $('#rupiah').val(rp)
    });
    $('.rupiah').keypress(function () {
        var val = this.value;
        var rp = formatRupiah(val, "Rp. ");
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
