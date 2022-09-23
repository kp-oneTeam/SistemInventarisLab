@extends('layouts.master')
@section('inventaris', 'active')
@section('content')
<section class="section">
    <div class="section-header">
        <a href="{{ url('inventaris/peralatan-komputer') }}" class="btn btn-warning mr-4"><i
                class="fas fa-arrow-left"></i></a>
        <h1>Detail Inventaris Storage</h1>
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
                                    <label for="">Nama / Merk GPU</label>
                                    <input disabled value="{{ $data->namaGpu }}" type="text" name="nama_gpu" class="form-control" required>
                                    <small>Contoh : MSI GeForce® GTX 1050</small>
                                </div>
                                <div class="row">
                                    <div class="form-group col-3">
                                        <label for="">Ukuran Memori</label>
                                        <div class="input-group">
                                            <input disabled value="{{ $data->ukuranMemori }}" type="text" name="ukuran_memori_gpu" class="form-control" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">GB</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-3">
                                        <label for="">Tipe Memori</label>
                                        <input disabled type="text" value="{{ $data->tipeMemory }}" name="tipe_memori_gpu" class="form-control" required>
                                        <small>Contoh : GDDR3, GDDR5</small>
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
