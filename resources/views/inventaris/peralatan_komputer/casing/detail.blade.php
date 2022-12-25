@extends('layouts.master')
@section('inventaris', 'active')
@section('content')
<section class="section">
    <div class="section-header">
        <a href="{{ url('inventaris/peralatan-komputer') }}" class="btn btn-warning mr-4 btn-icon icon-left"><i
                class="fas fa-caret-left"></i></a>
        <h1>Detail Casing</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">
                                {!! QrCode::size(200)->generate(url(env('NGROK_SERVER').'mobile/inventaris/peralatan_komputer/Casing/'.$data->id)); !!}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card-body">
                                <div class="row mt-2">
                                    <div class="col-3">
                                        Kode Inventaris
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-5">
                                        {{ $data->kodeInventaris }}
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-3">
                                        Nama / Merk Casing
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-5">
                                        {{ $data->namaCasing }}
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-3">
                                        Form Factor
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-5">
                                        {{ $data->formFactor }}
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-3">Lokasi</div>
                                    <div class="col-1">:</div>
                                    <div class="col-5">{{ $data->ruangan->namaRuangan }}</div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-3">
                                        Vendor
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-5">
                                        {{ $data->vendor->namaVendor }}
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-3">
                                        Harga
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-5">
                                        {{ number_format($data->harga,0,".",".") }}
                                    </div>
                                </div>

                            </div>
                            @role('laboran')
                            <div class="col-12">
                                <a href="{{ url('edit/inventaris-peralatan-komputer/casing/'.$data->id) }}"
                                    class="btn btn-primary col-12">Ubah Data</a>
                            </div>
                            @endrole
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
