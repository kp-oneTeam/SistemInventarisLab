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
                        <div class="col-12">
                            <div class="text-center">
                            {!! QrCode::size(200)->generate(url(env('NGROK_SERVER').'detail/inventaris/').$data->kodeInventaris); !!}
                        </div>
                        </div>
                        <div class="col-12">
                            <p>
                                <div class="row">
                                    <div class="col-5">Kode Inventaris</div>
                                    <div class="col-1">:</div>
                                    <div class="col-5">{{ $data->kodeInventaris }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-5">Nama Barang</div>
                                    <div class="col-1">:</div>
                                    <div class="col-5">{{ $data->barang->namaBarang }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-5">Vendor</div>
                                    <div class="col-1">:</div>
                                    <div class="col-5">{{ $data->vendor->namaVendor }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-5">Lokasi</div>
                                    <div class="col-1">:</div>
                                    <div class="col-5">{{ $data->ruangan->namaRuangan }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-5">Merk</div>
                                    <div class="col-1">:</div>
                                    <div class="col-5">{{ $data->merk }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-5">Spesifikasi</div>
                                    <div class="col-1">:</div>
                                    <div class="col-5">{{ $data->spesifikasi }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-5">Tanggal Pembelian</div>
                                    <div class="col-1">:</div>
                                    <div class="col-5">{{ $data->tgl_pembelian }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-5">Harga Pembelian</div>
                                    <div class="col-1">:</div>
                                    <div class="col-5">{{ number_format($data->harga,0,"",".") }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-5">Kondisi</div>
                                    <div class="col-1">:</div>
                                    <div class="col-5">{{ $data->kondisi }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-5">Keterangan</div>
                                    <div class="col-1">:</div>
                                    <div class="col-5">{{ $data->keterangan }}</div>
                                </div>
                            </p>
                        </div>
                        <div class="col-12">
                            <a href="{{ url('edit/inventaris/'.$data->kodeInventaris) }}" class="btn btn-primary col-12">Ubah Data</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var rupiah = document.getElementById("rupiah");
    rupiah.addEventListener("keyup", function(e) {
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
