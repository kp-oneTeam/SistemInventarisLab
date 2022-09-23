@extends('layouts.master')
@section('inventaris', 'active')
@section('content')
<section class="section">
    <div class="section-header">
        <a href="{{ url('inventaris/komputer') }}" class="btn btn-warning mr-4"><i
                class="fas fa-arrow-left"></i></a>
        <h1>Detail Inventaris Komputer</h1>
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
                                    <input disabled type="text" value="{{ $data->kodeInventarisKomputer }}" name="ki"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Lokasi</label>
                                    <select disabled name="lokasi" class="form-control select2" required>
                                        <option value="">{{$data->ruangan->namaRuangan}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Perakitan</label>
                                    <input disabled value="{{ $data->tanggal_perakitan }}" type="date" name="tanggal"
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
                            @php
                                $totalharga = 0;
                            @endphp
                            <h4>Spesifikasi</h4>
                            <div class="row mt-2">
                                <div class="col-12 col-md-6 col-sm-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h6>Motherboard</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5">
                                                    Kode Inventaris
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->motherboard->kodeInventaris }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Nama / Merk Motherboard
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->motherboard->namaMotherboard }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Chipset
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->motherboard->chipsetMotherboard }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Socket Motherboard
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->motherboard->socketMotherboard }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Form Factor
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->motherboard->formFactor }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Memory Slot
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->motherboard->memoriSlot }}Ghz
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Memory Support
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->motherboard->memoriSupport }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Vendor
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->motherboard->vendor->namaVendor }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Harga
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ number_format($data->motherboard->harga,0,".",".") }}
                                                    @php
                                                        $totalharga = $data->motherboard->harga + $totalharga;
                                                    @endphp
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-sm-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h6>Processor</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5">
                                                    Kode Inventaris
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->processor->kodeInventaris }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Nama / Merk Processor
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->processor->namaProcessor }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Series
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->processor->series }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Nomor Processor
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->processor->nomorProcessor }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Generasi
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->processor->generasi }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Kecepatan
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->processor->kecepatan }}Ghz
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Core / Thread
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->processor->jumlahCore }} Core / {{ $data->processor->jumlahThread }} Thread
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Socket
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->processor->socket }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Vendor
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->processor->vendor->namaVendor }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Harga
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ number_format($data->processor->harga,0,".",".") }}
                                                    @php
                                                        $totalharga = $data->processor->harga + $totalharga;
                                                    @endphp
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $index_ram = 1;
                                    $index_storage = 1;
                                @endphp
                                @foreach ($data->ram($data->id) as $item)
                                <div class="col-12 col-md-6 col-sm-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h6>Ram {{ $index_ram++ }}</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5">
                                                    Kode Inventaris
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $item->rams->kodeInventaris }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Nama / Merk Memory
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $item->rams->namaMemory }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Jenis Memory
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $item->rams->jenisMemory }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Tipe Memory
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    PC{{ $item->rams->tipeMemory }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Kapasitas
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $item->rams->kapasitasMemory }}GB
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Frekuensi
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $item->rams->frekuensiMemory }}Hz
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Vendor
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $item->rams->vendor->namaVendor }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Harga
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ number_format($item->rams->harga,0,".",".") }}
                                                    @php
                                                        $totalharga = $item->rams->harga + $totalharga;
                                                    @endphp
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @foreach ($data->storage($data->id) as $item)
                                <div class="col-12 col-md-6 col-sm-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h6>Storage {{ $index_storage++ }}</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5">
                                                    Kode Inventaris
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $item->storage->kodeInventaris }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Nama / Merk Storage
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $item->storage->namaStorage }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Jenis Storage
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $item->storage->jenisStorage }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Kapasitas Storage
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $item->storage->kapasitasStorage }}GB
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Vendor
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $item->storage->vendor->namaVendor }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Harga
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ number_format($item->storage->harga,0,".",".") }}
                                                    @php
                                                        $totalharga = $item->storage->harga + $totalharga;
                                                    @endphp
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="col-12 col-md-6 col-sm-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h6>GPU</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5">
                                                    Kode Inventaris
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->gpu->kodeInventaris }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Nama / Merk GPU
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->gpu->namaGpu }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Kapasitas Memory
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->gpu->ukuranMemori }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Tipe Memory
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->gpu->tipeMemori }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Vendor
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->gpu->vendor->namaVendor }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Harga
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ number_format($data->gpu->harga,0,".",".") }}
                                                    @php
                                                        $totalharga = $data->gpu->harga + $totalharga;
                                                    @endphp
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-sm-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h6>PSU</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5">
                                                    Kode Inventaris
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->psu->kodeInventaris }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Nama / Merk PSU
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->psu->namaPsu }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Form Factor
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->psu->formFactor }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Jenis Kabel
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->psu->jenisKabel }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Besar Daya
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->psu->besarDaya }}W
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Sertifikasi PSU
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->psu->sertifikasiPsu }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Vendor
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->psu->vendor->namaVendor }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Harga
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ number_format($data->psu->harga,0,".",".") }}
                                                    @php
                                                        $totalharga = $data->psu->harga + $totalharga;
                                                    @endphp
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-sm-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h6>Casing</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5">
                                                    Kode Inventaris
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->casing->kodeInventaris }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Nama / Merk Casing
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->casing->namaCasing }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Form Factor
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->casing->formFactor }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Vendor
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->casing->vendor->namaVendor }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    Harga
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ number_format($data->casing->harga,0,".",".") }}
                                                    @php
                                                        $totalharga = $data->casing->harga + $totalharga;
                                                    @endphp
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="float-right">
                                                <h6>Total Harga Komputer</h6>
                                                <h4>Rp. {{ number_format($totalharga,0,"",".") }}</h4>
                                            </div>
                                        </div>
                                    </div>
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
