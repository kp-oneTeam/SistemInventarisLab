@extends('layouts.master')
@section('inventaris', 'active')
@section('content')
<section class="section">
    <div class="section-header">
        <a href="{{ url('inventaris/peralatan-komputer') }}" class="btn btn-warning mr-4"><i
                class="fas fa-arrow-left"></i></a>
        <h1>Edit Data Inventaris Motherboard</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12  col-sm-12">
                            <form action="{{ url('ubah/inventaris-peralatan-komputer/processor/'.$data->id) }}" method="post">
                                @csrf
                                @method("PUT")
                                <div class="form-group">
                                    <label for="">Kode Inventaris</label><small>(Intel/AMD)</small>
                                    <input value="{{ $data->kodeInventaris }}" disabled type="text"
                                        name="ki" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Nama / Merk Processor</label><small>(Intel/AMD)</small>
                                    <input value="{{ $data->namaProcessor }}" type="text" name="nama_processor"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Series</label>
                                    <input value="{{ $data->series }}" type="text" name="series"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Generasi</label>
                                    <input value="{{ $data->generasi }}" type="text" name="generasi"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Nomor Processor</label>
                                    <input value="{{ $data->nomorProcessor }}" type="text"
                                        name="nomor_processor" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Socket</label>
                                    <input value="{{ $data->socket }}" type="text" name="socket"
                                        class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Kecepatan Processor</label>
                                            <div class="input-group">
                                                <input value="{{ $data->kecepatan }}" type="text"
                                                    name="kecepatan_processor" class="form-control">
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
                                                <input type="text" value="{{ $data->jumlahCore }}"
                                                    name="jumlah_core" class="form-control">
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
                                                <input type="text" value="{{ $data->jumlahThread }}"
                                                name="jumlah_thread" class="form-control">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">Thread</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Vendor</label>
                                    <select name="vendor" class="form-control select2" required>
                                        <option value="{{ $data->idVendor }}">{{ $data->vendor->namaVendor }}</option>
                                        @foreach ($vendor as $item)
                                        @if ($item->id != $data->idVendor)
                                        <option value="{{ $item->id }}">{{ $item->namaVendor }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    @if ($data->keterangan == "Sudah dipasang dikomputer" || $data->keterangan == "Sedang Dipinjam")
                                    <label>Lokasi</label>
                                    <select name="lokasi" disabled class="form-control select2 is-invalid"
                                        id="validationServer04" required>
                                        <option value="{{ $data->idRuangan }}">{{ $data->ruangan->namaRuangan }}
                                        </option>
                                        @foreach ($lokasi as $item)
                                        @if ($item->id != $data->idRuangan)
                                        <option value="{{ $item->id }}">{{ $item->kodeRuangan." || ".$item->namaRuangan
                                            }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        Lokasi Tidak Bisa Diubah, Karena {{ $data->keterangan }}
                                    </div>
                                    @else
                                    <label>Lokasi</label>
                                    <select name="lokasi" class="form-control select2" required>
                                        <option value="{{ $data->idRuangan }}">{{ $data->ruangan->namaRuangan }}
                                        </option>
                                        @foreach ($lokasi as $item)
                                        @if ($item->id != $data->idRuangan)
                                        <option value="{{ $item->id }}">{{ $item->kodeRuangan." || ".$item->namaRuangan
                                            }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input value="{{ $data->harga }}" name="harga" id="rupiah" type="text"
                                        class="form-control rupiah" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Pembelian</label>
                                    <input value="{{ $data->tglPembelian }}" type="date" name="tanggal"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kondisi</label>
                                    <div class="selectgroup w-100">
                                        @if ($data->kondisi == "Baik")
                                        <label class="selectgroup-item">
                                            <input type="radio" name="kondisi" value="Baik"
                                                class="selectgroup-input" checked required>
                                            <span class="selectgroup-button">Baik</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="kondisi" value="Rusak"
                                                class="selectgroup-input" required>
                                            <span class="selectgroup-button">Rusak</span>
                                        </label>
                                        @else
                                        <label class="selectgroup-item">
                                            <input type="radio" name="kondisi" value="Baik"
                                                class="selectgroup-input" required>
                                            <span class="selectgroup-button">Baik</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="kondisi" value="Rusak"
                                                class="selectgroup-input" checked required>
                                            <span class="selectgroup-button">Rusak</span>
                                        </label>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    @if ($data->keterangan == "Sudah dipasang dikomputer" || $data->keterangan == "Sedang Dipinjam")
                                    <label class="form-label">Keterangan</label>
                                    <textarea name="keterangan" disabled id="validationServer05Feedback"
                                        class="form-control is-invalid">{{ $data->keterangan }}</textarea>
                                    <div id="validationServer05Feedback" class="invalid-feedback">
                                        Keterangan Tidak Bisa Diubah, Karena {{ $data->keterangan }}
                                    </div>
                                    @else
                                    <label class="form-label">Keterangan</label>
                                    <textarea name="keterangan"
                                        class="form-control">{{ $data->keterangan }}</textarea>

                                    @endif
                                </div>
                                <div class="form-group">
                                            <button type="submit"
                                                class="btn btn-warning btn-icon icon-left btn-warning float-right m-2"><i
                                                    class="fas fa-save"></i>Update</button>
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
    $(document).ready(function () {
        $("#rupiah").val(formatRupiah("{{ $data->harga }}", "Rp ."));
    })
</script>
@endsection
