@extends('layouts.master')
@section('inventaris', 'active')
@section('content')
<section class="section">
    <div class="section-header">
        <a href="{{ url('inventaris/peralatan-komputer') }}" class="btn btn-warning mr-4"><i
                class="fas fa-arrow-left"></i></a>
        <h1>Edit Inventaris Storage</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12  col-sm-12">
                            <form action="{{ url('ubah/inventaris-peralatan-komputer/psu/'.$data->id) }}"
                                method="post">
                                @csrf
                                @method("PUT")
                                <div class="form-group">
                                    <label for="">Kode Inventaris</label>
                                    <input disabled type="text" value="{{ $data->kodeInventaris }}" name="ki"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Nama / Merk PSU</label>
                                    <input type="text" value="{{ $data->namaPsu }}" name="nama_psu" class="form-control">
                                    <small>Contoh : be quiet! SYSTEM POWER 9</small>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        @php
                                            $form_factor = array("ATX","Micro-ATX","Mini-ATX");
                                        @endphp
                                        <label for="">Form Factor PSU</label><small>(ATX/MINI ATX/dll)</small>
                                        <select name="form_factor_psu" class="form-control select2" required>
                                            <option value="{{ $data->formFactor}}">{{ $data->formFactor }}</option>
                                            @foreach ($form_factor as $item)
                                            @if ($item != $data->formFactor)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="">Jenis Kabel PSU</label><small>(Modular/Non Modular)</small>
                                        <select name="jenis_kabel_psu" class="form-control select2" required>
                                            @if ($data->jenisKabel == "Modular")
                                            <option value="Modular">Modular</option>
                                            <option value="Non-Modular">Non-Modular</option>
                                            @else
                                            <option value="Non-Modular">Non-Modular</option>
                                            <option value="Modular">Modular</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="form-group col-6">
                                        <label for="">Besar Daya</label>
                                        <div class="input-group">
                                            <input type="text" value="{{ $data->besarDaya }}" name="besar_daya_psu" class="form-control" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Watt</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        @php
                                            $sertifikasi = array("Non-Sertifikasi","80+","80+ Bronze","80+ Silver","80+ Gold","80+ Platinum","80+ Titanium")
                                        @endphp
                                        <label for="">Sertifikasi PSU</label>
                                        <select name="sertifikasi_psu" class="form-control select2" required>
                                            <option value="{{ $data->sertifikasiPsu }}">{{ $data->sertifikasiPsu }}</option>
                                            @foreach ($sertifikasi as $item)
                                            @if ($item != $data->sertifikasiPsu)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                            @endif
                                            @endforeach
                                        </select>
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
                                    @if ($data->keterangan == "Sudah dipasang dikomputer" || $data->keterangan ==
                                    "Sedang Dipinjam")
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
                                            <input type="radio" name="kondisi" value="Baik" class="selectgroup-input"
                                                checked required>
                                            <span class="selectgroup-button">Baik</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="kondisi" value="Rusak" class="selectgroup-input"
                                                required>
                                            <span class="selectgroup-button">Rusak</span>
                                        </label>
                                        @else
                                        <label class="selectgroup-item">
                                            <input type="radio" name="kondisi" value="Baik" class="selectgroup-input"
                                                required>
                                            <span class="selectgroup-button">Baik</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="kondisi" value="Rusak" class="selectgroup-input"
                                                checked required>
                                            <span class="selectgroup-button">Rusak</span>
                                        </label>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    @if ($data->keterangan == "Sudah dipasang dikomputer" || $data->keterangan ==
                                    "Sedang Dipinjam")
                                    <label class="form-label">Keterangan</label>
                                    <textarea name="keterangan" disabled id="validationServer05Feedback"
                                        class="form-control is-invalid">{{ $data->keterangan }}</textarea>
                                    <div id="validationServer05Feedback" class="invalid-feedback">
                                        Keterangan Tidak Bisa Diubah, Karena {{ $data->keterangan }}
                                    </div>
                                    @else
                                    <label class="form-label">Keterangan</label>
                                    <textarea name="keterangan" class="form-control">{{ $data->keterangan }}</textarea>

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
