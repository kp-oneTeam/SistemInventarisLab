@extends('layouts.master')
@section('inventaris', 'active')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Data Inventaris</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">
                                {!! QrCode::size(200)->generate(url('detail/inventaris/').$data->kodeInventaris); !!}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card-body">
                                <p>
                                <div class="row">
                                    <div class="col-5">
                                        Kode Inventaris
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-5">
                                        {{ $data->kodeInventaris }}
                                    </div>
                                </div>
                                </p>
                                <div class="row">
                                                <div class="col-5">
                                                    Nama / Merk Storage
                                                </div>
                                                <div class="col-1">
                                                    :
                                                </div>
                                                <div class="col-5">
                                                    {{ $data->namaStorage }}
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
                                                    {{ $data->jenisStorage }}
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
                                                    {{ $data->kapasitasStorage }}GB
                                                </div>
                                            </div>
                                <p>
                                <div class="row">
                                    <div class="col-5">
                                        Vendor
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-5">
                                        {{ $data->vendor->namaVendor }}
                                    </div>
                                </div>
                                </p>
                                <p>
                                <div class="row">
                                    <div class="col-5">
                                        Harga
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-5">
                                        {{ number_format($data->harga,0,".",".") }}
                                    </div>
                                </div>
                                </p>

                            </div>
                            <div class="col-12">
                                <a href="{{ url('edit/inventaris-peralatan-komputer/storage/'.$data->id) }}"
                                    class="btn btn-primary col-12">Ubah Data</a>
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
