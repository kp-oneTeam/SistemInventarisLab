@extends('layouts.master')
@section('inventaris', 'active')
@section('content')
<section class="section">
    <div class="section-header">
        <a href="{{ url('inventaris/peralatan-komputer') }}" class="btn btn-warning mr-4 btn-icon icon-left"><i
                class="fas fa-caret-left"></i></a>
        <h1>Detail RAM</h1>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="text-center">
                                {!!
                                QrCode::size(100)->generate(url(env('NGROK_SERVER').'mobile/inventaris/peralatan_komputer/RAM/'.$data->id));
                                !!}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card-body">
                                <div class="row mt-2">
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
                                <div class="row mt-2">
                                    <div class="col-5">
                                        Nama / Merk Memory
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-5">
                                        {{ $data->namaMemory }}
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-5">
                                        Jenis Memory
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-5">
                                        {{ $data->jenisMemory }}
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-5">
                                        Tipe Memory
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-5">
                                        PC{{ $data->tipeMemory }}
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-5">
                                        Kapasitas
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-5">
                                        {{ $data->kapasitasMemory }}GB
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-5">
                                        Frekuensi
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-5">
                                        {{ $data->frekuensiMemory }}Hz
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-5">Lokasi</div>
                                    <div class="col-1">:</div>
                                    <div class="col-5">{{ $data->ruangan->namaRuangan }}</div>
                                </div>
                                <div class="row mt-2">
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
                                <div class="row mt-2">
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

                            </div>
                            @role('laboran')
                            <div class="col-12">
                                <a href="{{ url('edit/inventaris-peralatan-komputer/ram/'.$data->id) }}"
                                    class="btn btn-primary col-12">Ubah Data</a>
                            </div>
                            @endrole
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
