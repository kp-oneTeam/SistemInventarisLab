@extends('layouts.master')
@section('inventaris', 'active')
@section('content')
<section class="section">
    <div class="section-header">
        <a href="{{ url('inventaris/peralatan-komputer') }}" class="btn btn-warning mr-4"><i class="fas fa-arrow-left"></i></a>
        <h1>Detail Data Inventaris Motherboard</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12  col-sm-12">
                            <form action="{{ url('ubah/inventaris_peralatan_komputer/motherboard/'.$data->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Nama / Merk Motheboard</label>
                                    <input disabled type="text" value="{{ $data->namaMotherboard }}"
                                        name="nama_motherboard" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Chipset</label>
                                    <input disabled type="text" value="{{ $data->chipsetMotherboard }}"
                                        name="chipset_mb" class="form-control" required>
                                    <small>Contoh: B450, K450</small>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="">Socket Processor</label>
                                        <input disabled type="text" value="{{ $data->socketMotherboard }}"
                                            name="socket_mb" class="form-control" required>
                                        <small>Contoh: AM4, LGA1155</small>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="">Form Factor</label>
                                        <select disabled name="form_factor" class="form-control select2" required>
                                            @if ($data->formFactor == "ATX")
                                            <option value="ATX">ATX</option>
                                            <option value="Micro-ATX">Micro-ATX</option>
                                            <option value="Mini-ATX">Mini-ATX</option>
                                            @elseif($data->formFactor == "Micro-ATX")
                                            <option value="Micro-ATX">Micro-ATX</option>
                                            <option value="Mini-ATX">Mini-ATX</option>
                                            <option value="ATX">ATX</option>
                                            @else
                                            <option value="Mini-ATX">Mini-ATX</option>
                                            <option value="ATX">ATX</option>
                                            <option value="Micro-ATX">Micro-ATX</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="">Slot Memori</label>
                                        <select disabled name="memori_slot" class="form-control select2" required>
                                            @if ($data->memoriSlot == "2")
                                            <option value="2">Dual Channel</option>
                                            <option value="4">Quad Channel</option>
                                            @else
                                            <option value="4">Quad Channel</option>
                                            <option value="2">Dual Channel</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="">Support Memori</label>
                                        <select disabled name="memori_support" class="form-control select2" required>
                                            @if ($data->memoriSupport == "DDR3")
                                            <option value="DDR3">DDR3</option>
                                            <option value="DDR4">DDR4</option>
                                            <option value="DDR5">DDR5</option>
                                            @elseif($data->memoriSupport == "DDR4")
                                            <option value="DDR4">DDR4</option>
                                            <option value="DDR5">DDR5</option>
                                            <option value="DDR3">DDR3</option>
                                            @else
                                            <option value="DDR5">DDR5</option>
                                            <option value="DDR3">DDR3</option>
                                            <option value="DDR4">DDR4</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Vendor</label>
                                    <select disabled name="vendor_mb" class="form-control select2" required>
                                        <option value="{{ $data->idVendor }}">{{ $data->vendor->namaVendor }}</option>
                                        @foreach ($vendor as $item)
                                        @if ($item->id != $data->idVendor)
                                        <option value="{{ $item->id }}">{{ $item->namaVendor }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Lokasi</label>
                                    <select disabled name="lokasi_mb" class="form-control select2" required>
                                        <option value="{{ $data->idRuangan }}">{{ $data->ruangan->namaRuangan }}
                                        </option>
                                        @foreach ($lokasi as $item)
                                        @if ($item->id != $data->idRuangan)
                                        <option value="{{ $item->id }}">{{ $item->kodeRuangan." || ".$item->namaRuangan
                                            }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input disabled name="harga_mb" id="rupiah" type="text" class="form-control rupiah"
                                        required value="{{ $data->harga }}">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Pembelian</label>
                                    <input disabled type="date" value="{{ $data->tglPembelian }}"
                                        name="tanggal_pembelian_mb" class="form-control" required>
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
