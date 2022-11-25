@extends('layouts.master')
@section('inventaris', 'active')
@section('content')
<section class="section">
    <div class="section-header">
        <a href="{{ url('inventaris/non-komputer') }}" class="btn btn-warning mr-4 btn-icon icon-left"><i class="fas fa-caret-left"></i></a>
        <h1>Detail Data Inventaris</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <p>
                                <div class="row">
                                    <div class="col-3">Kode Inventaris</div>
                                    <div class="col-9">: {{ $data->kodeInventaris }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-3">Nama Barang</div>
                                    <div class="col-9">: {{ $data->barang->namaBarang }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-3">Vendor</div>
                                    <div class="col-9">: {{ $data->vendor->namaVendor }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-3">Lokasi</div>
                                    <div class="col-9">: {{ $data->ruangan->namaRuangan }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-3">Merk</div>
                                    <div class="col-9">: {{ $data->merk }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-3">Spesifikasi</div>
                                    <div class="col-9">: {{ $data->spesifikasi }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-3">Tanggal Pembelian</div>
                                    <div class="col-9">: {{ $data->tgl_pembelian }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-3">Harga Pembelian</div>
                                    {{-- <div class="col-1">:</div> --}}
                                    <div class="col-8" id="harga"></div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-3">Kondisi</div>
                                    <div class="col-9">: {{ $data->kondisi }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-3">Keterangan</div>
                                    <div class="col-9">: {{ $data->keterangan }}</div>
                                </div>
                            </p>
                        </div>
                        <div class="col-4">
                            <div class="mt-lg-6">
                                {!! QrCode::size(200)->generate(env('NGROK_SERVER').'mobile/detail/inventaris/'.$data->kodeInventaris); !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
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

       var harga = $("#harga").text(" : Rp. " + formatRupiah("{{ $data->harga }}"));
       console.log(harga)
    })
</script>
@endsection
