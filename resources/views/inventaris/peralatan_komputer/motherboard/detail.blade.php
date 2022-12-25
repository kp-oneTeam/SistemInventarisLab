@extends('layouts.master')
@section('inventaris', 'active')
@section('content')
<section class="section">
    <div class="section-header">
        <a href="{{ url('inventaris/peralatan-komputer') }}" class="btn btn-warning mr-4 btn-icon icon-left"><i class="fas fa-caret-left"></i></a>
        <h1>Detail Motherboard</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">
                            {!! QrCode::size(200)->generate(url(env('NGROK_SERVER').'mobile/inventaris/peralatan_komputer/Motherboard/'.$data->id)); !!}
                        </div>
                        </div>
                        <div class="col-12 mt-3">
                            <p>
                                <div class="row">
                                    <div class="col-3">Kode Inventaris</div>
                                    <div class="col-1">:</div>
                                    <div class="col-5">{{ $data->kodeInventaris }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-3">Vendor</div>
                                    <div class="col-1">:</div>
                                    <div class="col-5">{{ $data->vendor->namaVendor }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-3">Lokasi</div>
                                    <div class="col-1">:</div>
                                    <div class="col-5">{{ $data->ruangan->namaRuangan }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-3">Kondisi</div>
                                    <div class="col-1">:</div>
                                    <div class="col-5">{{ $data->kondisi }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-3">Keterangan</div>
                                    <div class="col-1">:</div>
                                    <div class="col-5">{{ $data->keterangan }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-3">
                                        Nama / Merk Motherboard
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-5">
                                        {{ $data->namaMotherboard }}
                                    </div>
                                </div>
                                </p>
                                <p>
                                <div class="row">
                                    <div class="col-3">
                                        Chipset
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-5">
                                        {{ $data->chipsetMotherboard }}
                                    </div>
                                </div>
                                </p>
                                <p>
                                <div class="row">
                                    <div class="col-3">
                                        Socket Motherboard
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-5">
                                        {{ $data->socketMotherboard }}
                                    </div>
                                </div>
                                </p>
                                <p>
                                <div class="row">
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
                                </p>
                                <p>
                                <div class="row">
                                    <div class="col-3">
                                        Memory Slot
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-5">
                                        {{ $data->memoriSlot }}
                                    </div>
                                </div>
                                </p>
                                <p>
                                <div class="row">
                                    <div class="col-3">
                                        Memory Support
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-5">
                                        {{ $data->memoriSupport }}
                                    </div>
                                </div>
                                </p>
                            <p>
                                <div class="row">
                                    <div class="col-3">Tanggal Pembelian</div>
                                    <div class="col-1">:</div>
                                    <div class="col-5">{{ $data->tglPembelian }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-3">Harga Pembelian</div>
                                    <div class="col-1">:</div>
                                    <div class="col-5">{{ number_format($data->harga,0,"",".") }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-3">Kondisi</div>
                                    <div class="col-1">:</div>
                                    <div class="col-5">{{ $data->kondisi }}</div>
                                </div>
                            </p>
                            <p>
                                <div class="row">
                                    <div class="col-3">Keterangan</div>
                                    <div class="col-1">:</div>
                                    <div class="col-5">{{ $data->keterangan }}</div>
                                </div>
                            </p>
                        </div>
                        @role('laboran')
                        <div class="col-12">
                            <a href="{{ url('edit/inventaris/'.$data->kodeInventaris) }}" class="btn btn-primary col-12">Ubah Data</a>
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
