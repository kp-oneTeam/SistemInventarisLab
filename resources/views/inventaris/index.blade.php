@extends('layouts.master')
@section('inventaris', 'active')
@section('content')
<section class="section">
    <div class="section-header">
        <ul class="nav nav-pills ml-4" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('inventaris/non-komputer') ? 'active' : null }}" id="pills-non-tab" href="{{ url('inventaris/non-komputer') }}" role="tab"
                    aria-controls="pills-non" aria-selected="true">Non Komputer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('inventaris/peralatan-komputer') ? 'active' : null }}" id="pills-peralatan-komputer-tab"
                    href="{{ url('inventaris/peralatan-komputer') }}" role="tab" aria-controls="pills-peralatan-komputer"
                    aria-selected="true">Peralatan Komputer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('inventaris/komputer') ? 'active' : null }}" id="pills-profile-tab" href="{{ url('inventaris/komputer') }}" role="tab"
                    aria-controls="pills-profile" aria-selected="false">Komputer</a>
            </li>
        </ul>
    </div>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show {{ request()->is('inventaris/non-komputer') ? 'active' : null }}" id="{{ url('inventaris/non-komputer') }}" role="tabpanel" aria-labelledby="pills-non-tab">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-warning">Data Inventaris</h4>
                            <div class="card-header-form">
                                <form>
                                    <div class="input-group">
                                        <a href="{{ url('tambah/inventaris') }}" class="btn btn-warning mr-2"
                                            class="btn btn-primary">Tambah Data</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="float-right mb-2">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <form id="formCetak" action="{{ url('checked/inventaris') }}" method="post">
                                        @csrf

                                        <button name="button" value="cetak" type="submit"
                                            class="btn btn-primary icon-left text-white"><i class="fas fa-print"></i>
                                            &nbsp; Cetak</button>
                                        <button name="button" value="hapus" type="submit"
                                            class="btn btn-danger icon-left text-white"><i class="fas fa-trash"></i>
                                            &nbsp; Hapus</button>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive p-sm-1">
                                <table class="table table-striped" id="myTable">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" class="check-all"></th>
                                            <th>No</th>
                                            <th>Kode Inventaris</th>
                                            <th>Nama Barang</th>
                                            <th>Spesifikasi</th>
                                            <th>Lokasi</th>
                                            <th>Tanggal Pembelian</th>
                                            <th>Status</th>

                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no = 1;
                                        @endphp
                                        @foreach ($data as $item)
                                        <tr>
                                            <td width="1%"><input type="checkbox" class="checked"> </td>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->kodeInventaris }}</td>
                                            <td>{{ $item->namaBarang }}</td>
                                            <td>{{ $item->spesifikasi }}</td>
                                            <td>{{$item->kodeRuangan ." ". $item->namaRuangan }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item->tgl_pembelian)); }}</td>
                                            <td>{{ $item->kondisi }}</td>

                                            <td>
                                                <form method="POST" target="_blank"
                                                    action="{{ url('hapus/inventaris/'.$item->kodeInventaris) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ url('detail/inventaris/'.$item->kodeInventaris) }}"
                                                        class="btn btn-sm btn-icon icon-left btn-info mb-2"><i
                                                            class="far fa-eye"></i> Detail</a>
                                                    <a href="{{ url('edit/inventaris/'.$item->kodeInventaris) }}"
                                                        class="btn btn-sm btn-icon icon-left btn-primary mb-2"><i
                                                            class="far fa-edit"></i> Edit</a>
                                                    <button type="submit"
                                                        class="btn btn-icon btn-sm icon-left btn-danger show_confirm"
                                                        data-toggle="tooltip" title='Hapus'><i
                                                            class="fas fa-trash"></i>Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade show {{ request()->is('inventaris/peralatan-komputer') ? 'active' : null }}" id="{{ url('inventaris/peralatan-komputer') }}" role="tabpanel"
            aria-labelledby="pills-peralatan-komputer-tab">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-warning">Data Inventaris Peralatan Komputer</h4>
                            <div class="card-header-form">
                                <form>
                                    <div class="input-group">
                                        <a href="{{ url('inventaris/peralatan-komputer/tambah/motherboard') }}" class="btn btn-warning mr-2">Tambah Data</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="float-right mb-2">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <form target="_blank" id="formCetak2" action="{{ url('checked/inventaris/peralatan-komputer/') }}" method="post">
                                        @csrf
                                        <button name="button" value="cetak" type="submit"
                                            class="btn btn-primary icon-left text-white"><i class="fas fa-print"></i>
                                            &nbsp; Cetak</button>
                                        <button name="button" value="hapus" type="submit"
                                            class="btn btn-danger icon-left text-white"><i class="fas fa-trash"></i>
                                            &nbsp; Hapus</button>
                                    </form>
                                </div>
                            </div>
                            <br><br>
                            {{-- tab --}}
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab"
                                        aria-controls="home" aria-selected="true">Motherboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab"
                                        aria-controls="profile" aria-selected="false">Processor</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab"
                                        aria-controls="contact" aria-selected="false">Ram</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab"
                                        aria-controls="contact" aria-selected="false">Storage</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab5" data-toggle="tab" href="#contact5" role="tab"
                                        aria-controls="contact" aria-selected="false">Graphics Processor Unit (GPU)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab6" data-toggle="tab" href="#contact6" role="tab"
                                        aria-controls="contact" aria-selected="false">Power Supply(PSU)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab7" data-toggle="tab" href="#contact7" role="tab"
                                        aria-controls="contact" aria-selected="false">Casing</a>
                                </li>
                            </ul>
                            <div class="tab-content m-2" id="myTabContent2">
                                {{-- motherboard --}}
                                @include('inventaris.peralatan_komputer.motherboard.list')
                                {{-- processor --}}
                                @include('inventaris.peralatan_komputer.processor.list')
                                {{-- Memory --}}
                                @include('inventaris.peralatan_komputer.ram.list')
                                {{-- storage --}}
                                @include('inventaris.peralatan_komputer.storage.list')
                                {{-- GPU --}}
                                @include('inventaris.peralatan_komputer.gpu.list')
                                {{-- PSU --}}
                                @include('inventaris.peralatan_komputer.psu.list')
                                {{-- Casing --}}
                                @include('inventaris.peralatan_komputer.casing.list')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('inventaris.komputer.list')
    </div>
</section>
@include('layouts.sweatalert')
<script>
    $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {

    });
    $(document).ready(function () {
        $('#myTable').DataTable();
        $('#TableMotherboard').DataTable();
        $('#tableKomputer').DataTable();
        $('#tableProcessor').DataTable();
        $('#tableRam').DataTable();
        $('#tableStorage').DataTable();
        $('#tableGpu').DataTable();
        $('#tablePsu').DataTable();
        $('#tableCasing').DataTable();
    });
</script>
<script type="text/javascript">
    $('.show_confirm').click(function (event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        Swal.fire({
            title: 'Apakah Anda Yakin Akan Menghapus Data?',
            showCancelButton: true,
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });
</script>
{{-- checkbox --}}
<script>
    $(document).ready(function () {
        $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
            $("#formCetak2").hide();
            $("#hapus_semua2").remove();
            $(".hapus_semua2").remove();
            $("#hapus_semua3").remove();
            $(".hapus_semua3").remove();
            $("#hapus_semua4").remove();
            $(".hapus_semua4").remove();
            $("#hapus_semua5").remove();
            $(".hapus_semua5").remove();
            $("#hapus_semua6").remove();
            $(".hapus_semua6").remove();
            $("#hapus_semua7").remove();
            $(".hapus_semua7").remove();
            $("#hapus_semua8").remove();
            $(".hapus_semua8").remove();
            $("input[type=checkbox]").prop('checked',false);
        })
        $("#formCetak").hide();
        $("#formCetak2").hide();
        $("#formCetak3").hide();
    });
    $(".check-all").on('change', function () {
        var html = "<div id='hapus_semua'>";
        var col1, col2;
        $(".checked").prop('checked', this.checked);
        $(".checked").each(function () {
            var row = $(this).closest("tr")[0];
            col1 = row.cells[1].innerHTML; //nomor
            col2 = row.cells[2].innerHTML; //ambil kode inventaris
            html += '<input type="hidden" name="kode_inventaris[]" value="' + col2 + '" id="input' + col1 + '"></input>';
        });
        html += "<div>"
        if ($(this).prop('checked')) {
            $(".hapus_semua").remove();
            $("#formCetak").show();
            $("#formCetak").append(html);
        } else {
            $("#formCetak").hide();
            $("#hapus_semua").remove();
            $(".hapus_semua").remove();
        }
    });
    $("#myTable .checked").on('change', function () {
        var message = "";
        var html = "<div class='hapus_semua'>";
        var currentRow = $(this).closest("tr");
        var col1 = currentRow.find("td:eq(1)").html(); //nomor
        var col2 = currentRow.find("td:eq(2)").html(); //ambil kode inventaris
        if ($(this).prop('checked')) {
            $("#formCetak").show();
            html += '<input type="hidden" name="kode_inventaris[]" value="' + col2 + '" id="input' + col1 + '"></input></div>';
            $("#formCetak").append(html);
        } else {
            var checked_count = $('.checked').filter(':checked').length;
            if (checked_count != 0) {
                $("#input" + col1).remove();
            } else {
                $("#formCetak").hide();
                $("#input" + col1).remove();
            }
        }
    });
    //motherboard
    $(".check-all-mth").on('change', function () {
        $('#formCetak2').attr('action', '{{ url("checked/inventaris/peralatan-komputer/motherboard") }}');
        var html = "<div id='hapus_semua2'>";
        var col1, col2;
        $(".checked-mth").prop('checked', this.checked);
        $(".checked-mth").each(function () {
            var row = $(this).closest("tr")[0];
            col1 = row.cells[1].innerHTML; //nomor
            col2 = row.cells[2].innerHTML; //ambil kode inventaris
            html += '<input type="hidden" name="kode_inventaris[]" value="' + col2 + '" id="input' + col1 + '"></input>';
        });
        html += "<div>"
        if ($(this).prop('checked')) {
            $(".hapus_semua2").remove();
            $("#formCetak2").show();
            $("#formCetak2").append(html);
        } else {
            $("#formCetak2").hide();
            $("#hapus_semua2").remove();
            $(".hapus_semua2").remove();
        }
    });
    $("#TableMotherboard .checked-mth").on('change', function () {
        $('#formCetak2').attr('action', '{{ url("checked/inventaris/peralatan-komputer/motherboard") }}');
        var message = "";
        var html = "<div class='hapus_semua2'>";
        var currentRow = $(this).closest("tr");
        var col1 = currentRow.find("td:eq(1)").html(); //nomor
        var col2 = currentRow.find("td:eq(2)").html(); //ambil kode inventaris
        if ($(this).prop('checked')) {
            $("#formCetak2").show();
            html += '<input type="hidden" name="kode_inventaris[]" value="' + col2 + '" id="inputmth' + col1 + '"></input></div>';
            $("#formCetak2").append(html);
        } else {
            var checked_count = $('.checked-mth').filter(':checked').length;
            if (checked_count != 0) {
                $("#inputmth" + col1).remove();
            } else {
                $("#formCetak2").hide();
                $("#inputmth" + col1).remove();
            }
        }
    });
    //processor
    $(".check-all-cpu").on('change', function () {
        $('#formCetak2').attr('action', '{{ url("checked/inventaris/peralatan-komputer/processor") }}');
        var html = "<div id='hapus_semua3'>";
        var col1, col2;
        $(".checked-cpu").prop('checked', this.checked);
        $(".checked-cpu").each(function () {
            var row = $(this).closest("tr")[0];
            col1 = row.cells[1].innerHTML; //nomor
            col2 = row.cells[2].innerHTML; //ambil kode inventaris
            html += '<input type="hidden" name="kode_inventaris[]" value="' + col2 + '" id="input' + col1 + '"></input>';
        });
        html += "<div>"
        if ($(this).prop('checked')) {
            $(".hapus_semua3").remove();
            $("#formCetak2").show();
            $("#formCetak2").append(html);
        } else {
            $("#formCetak2").hide();
            $("#hapus_semua3").remove();
            $(".hapus_semua3").remove();
        }
    });
    $("#tableProcessor .checked-cpu").on('change', function () {
        $('#formCetak2').attr('action', '{{ url("checked/inventaris/peralatan-komputer/processor") }}');
        var message = "";
        var html = "<div class='hapus_semua3'>";
        var currentRow = $(this).closest("tr");
        var col1 = currentRow.find("td:eq(1)").html(); //nomor
        var col2 = currentRow.find("td:eq(2)").html(); //ambil kode inventaris
        if ($(this).prop('checked')) {
            $("#formCetak2").show();
            html += '<input type="hidden" name="kode_inventaris[]" value="' + col2 + '" id="inputcpu' + col1 + '"></input></div>';
            $("#formCetak2").append(html);
        } else {
            var checked_count = $('.checked-cpu').filter(':checked').length;
            if (checked_count != 0) {
                $("#inputcpu" + col1).remove();
            } else {
                $("#formCetak2").hide();
                $("#inputcpu" + col1).remove();
            }
        }
    });
    //ram
    $(".check-all-ram").on('change', function () {
        $('#formCetak2').attr('action', '{{ url("checked/inventaris/peralatan-komputer/ram") }}');
        var html = "<div id='hapus_semua4'>";
        var col1, col2;
        $(".checked-ram").prop('checked', this.checked);
        $(".checked-ram").each(function () {
            var row = $(this).closest("tr")[0];
            col1 = row.cells[1].innerHTML; //nomor
            col2 = row.cells[2].innerHTML; //ambil kode inventaris
            html += '<input type="hidden" name="kode_inventaris[]" value="' + col2 + '" id="input' + col1 + '"></input>';
        });
        html += "<div>"
        if ($(this).prop('checked')) {
            $(".hapus_semua4").remove();
            $("#formCetak2").show();
            $("#formCetak2").append(html);
        } else {
            $("#formCetak2").hide();
            $("#hapus_semua4").remove();
            $(".hapus_semua4").remove();
        }
    });
    $("#tableRam .checked-ram").on('change', function () {
        $('#formCetak2').attr('action', '{{ url("checked/inventaris/peralatan-komputer/ram") }}');
        var message = "";
        var html = "<div class='hapus_semua4'>";
        var currentRow = $(this).closest("tr");
        var col1 = currentRow.find("td:eq(1)").html(); //nomor
        var col2 = currentRow.find("td:eq(2)").html(); //ambil kode inventaris
        if ($(this).prop('checked')) {
            $("#formCetak2").show();
            html += '<input type="hidden" name="kode_inventaris[]" value="' + col2 + '" id="inputram' + col1 + '"></input></div>';
            $("#formCetak2").append(html);
        } else {
            var checked_count = $('.checked-ram').filter(':checked').length;
            if (checked_count != 0) {
                $("#inputram" + col1).remove();
            } else {
                $("#formCetak2").hide();
                $("#inputram" + col1).remove();
            }
        }
    });
    //storage
    $(".check-all-storage").on('change', function () {
        $('#formCetak2').attr('action', '{{ url("checked/inventaris/peralatan-komputer/storage") }}');
        var html = "<div id='hapus_semua5'>";
        var col1, col2;
        $(".checked-storage").prop('checked', this.checked);
        $(".checked-storage").each(function () {
            var row = $(this).closest("tr")[0];
            col1 = row.cells[1].innerHTML; //nomor
            col2 = row.cells[2].innerHTML; //ambil kode inventaris
            html += '<input type="hidden" name="kode_inventaris[]" value="' + col2 + '" id="input' + col1 + '"></input>';
        });
        html += "<div>"
        if ($(this).prop('checked')) {
            $(".hapus_semua5").remove();
            $("#formCetak2").show();
            $("#formCetak2").append(html);
        } else {
            $("#formCetak2").hide();
            $("#hapus_semua5").remove();
            $(".hapus_semua5").remove();
        }
    });
    $("#tableStorage .checked-storage").on('change', function () {
        $('#formCetak2').attr('action', '{{ url("checked/inventaris/peralatan-komputer/storage") }}');
        var message = "";
        var html = "<div class='hapus_semua5'>";
        var currentRow = $(this).closest("tr");
        var col1 = currentRow.find("td:eq(1)").html(); //nomor
        var col2 = currentRow.find("td:eq(2)").html(); //ambil kode inventaris
        if ($(this).prop('checked')) {
            $("#formCetak2").show();
            html += '<input type="hidden" name="kode_inventaris[]" value="' + col2 + '" id="inputstorage' + col1 + '"></input></div>';
            $("#formCetak2").append(html);
        } else {
            var checked_count = $('.checked-storage').filter(':checked').length;
            if (checked_count != 0) {
                $("#inputstorage" + col1).remove();
            } else {
                $("#formCetak2").hide();
                $("#inputstorage" + col1).remove();
            }
        }
    });
    //gpu
    $(".check-all-gpu").on('change', function () {
        $('#formCetak2').attr('action', '{{ url("checked/inventaris/peralatan-komputer/gpu") }}');
        var html = "<div id='hapus_semua6'>";
        var col1, col2;
        $(".checked-gpu").prop('checked', this.checked);
        $(".checked-gpu").each(function () {
            var row = $(this).closest("tr")[0];
            col1 = row.cells[1].innerHTML; //nomor
            col2 = row.cells[2].innerHTML; //ambil kode inventaris
            html += '<input type="hidden" name="kode_inventaris[]" value="' + col2 + '" id="input' + col1 + '"></input>';
        });
        html += "<div>"
        if ($(this).prop('checked')) {
            $(".hapus_semua6").remove();
            $("#formCetak2").show();
            $("#formCetak2").append(html);
        } else {
            $("#formCetak2").hide();
            $("#hapus_semua5").remove();
            $(".hapus_semua5").remove();
        }
    });
    $("#tableGpu .checked-gpu").on('change', function () {
        $('#formCetak2').attr('action', '{{ url("checked/inventaris/peralatan-komputer/gpu") }}');
        var message = "";
        var html = "<div class='hapus_semua6'>";
        var currentRow = $(this).closest("tr");
        var col1 = currentRow.find("td:eq(1)").html(); //nomor
        var col2 = currentRow.find("td:eq(2)").html(); //ambil kode inventaris
        if ($(this).prop('checked')) {
            $("#formCetak2").show();
            html += '<input type="hidden" name="kode_inventaris[]" value="' + col2 + '" id="inputgpu' + col1 + '"></input></div>';
            $("#formCetak2").append(html);
        } else {
            var checked_count = $('.checked-gpu').filter(':checked').length;
            if (checked_count != 0) {
                $("#inputgpu" + col1).remove();
            } else {
                $("#formCetak2").hide();
                $("#inputgpu" + col1).remove();
            }
        }
    });
    //psu
    $(".check-all-psu").on('change', function () {
        $('#formCetak2').attr('action', '{{ url("checked/inventaris/peralatan-komputer/psu") }}');
        var html = "<div id='hapus_semua7'>";
        var col1, col2;
        $(".checked-psu").prop('checked', this.checked);
        $(".checked-psu").each(function () {
            var row = $(this).closest("tr")[0];
            col1 = row.cells[1].innerHTML; //nomor
            col2 = row.cells[2].innerHTML; //ambil kode inventaris
            html += '<input type="hidden" name="kode_inventaris[]" value="' + col2 + '" id="input' + col1 + '"></input>';
        });
        html += "<div>"
        if ($(this).prop('checked')) {
            $(".hapus_semua7").remove();
            $("#formCetak2").show();
            $("#formCetak2").append(html);
        } else {
            $("#formCetak2").hide();
            $("#hapus_semua5").remove();
            $(".hapus_semua5").remove();
        }
    });
    $("#tablePsu .checked-psu").on('change', function () {
        $('#formCetak2').attr('action', '{{ url("checked/inventaris/peralatan-komputer/psu") }}');
        var message = "";
        var html = "<div class='hapus_semua7'>";
        var currentRow = $(this).closest("tr");
        var col1 = currentRow.find("td:eq(1)").html(); //nomor
        var col2 = currentRow.find("td:eq(2)").html(); //ambil kode inventaris
        if ($(this).prop('checked')) {
            $("#formCetak2").show();
            html += '<input type="hidden" name="kode_inventaris[]" value="' + col2 + '" id="inputpsu' + col1 + '"></input></div>';
            $("#formCetak2").append(html);
        } else {
            var checked_count = $('.checked-psu').filter(':checked').length;
            if (checked_count != 0) {
                $("#inputpsu" + col1).remove();
            } else {
                $("#formCetak2").hide();
                $("#inputpsu" + col1).remove();
            }
        }
    });
    //casing
    $(".check-all-casing").on('change', function () {
        $('#formCetak2').attr('action', '{{ url("checked/inventaris/peralatan-komputer/casing") }}');
        var html = "<div id='hapus_semua8'>";
        var col1, col2;
        $(".checked-casing").prop('checked', this.checked);
        $(".checked-casing").each(function () {
            var row = $(this).closest("tr")[0];
            col1 = row.cells[1].innerHTML; //nomor
            col2 = row.cells[2].innerHTML; //ambil kode inventaris
            html += '<input type="hidden" name="kode_inventaris[]" value="' + col2 + '" id="input' + col1 + '"></input>';
        });
        html += "<div>"
        if ($(this).prop('checked')) {
            $(".hapus_semua8").remove();
            $("#formCetak2").show();
            $("#formCetak2").append(html);
        } else {
            $("#formCetak2").hide();
            $("#hapus_semua5").remove();
            $(".hapus_semua5").remove();
        }
    });
    $("#tableCasing .checked-casing").on('change', function () {
        $('#formCetak2').attr('action', '{{ url("checked/inventaris/peralatan-komputer/casing") }}');
        var message = "";
        var html = "<div class='hapus_semua8'>";
        var currentRow = $(this).closest("tr");
        var col1 = currentRow.find("td:eq(1)").html(); //nomor
        var col2 = currentRow.find("td:eq(2)").html(); //ambil kode inventaris
        if ($(this).prop('checked')) {
            $("#formCetak2").show();
            html += '<input type="hidden" name="kode_inventaris[]" value="' + col2 + '" id="inputcasing' + col1 + '"></input></div>';
            $("#formCetak2").append(html);
        } else {
            var checked_count = $('.checked-casing').filter(':checked').length;
            if (checked_count != 0) {
                $("#inputcasing" + col1).remove();
            } else {
                $("#formCetak2").hide();
                $("#inputcasing" + col1).remove();
            }
        }
    });
    //komputer
    $(".check-all-komputer").on('change', function () {
        $('#formCetak3').attr('action', '{{ url("checked/inventaris/komputer") }}');
        var html = "<div id='hapus_semua9'>";
        var col1, col2;
        $(".checked-komputer").prop('checked', this.checked);
        $(".checked-komputer").each(function () {
            var row = $(this).closest("tr")[0];
            col1 = row.cells[1].innerHTML; //nomor
            col2 = row.cells[2].innerHTML; //ambil kode inventaris
            html += '<input type="hidden" name="kode_inventaris[]" value="' + col2 + '" id="input' + col1 + '"></input>';
        });
        html += "<div>"
        if ($(this).prop('checked')) {
            $(".hapus_semua9").remove();
            $("#formCetak3").show();
            $("#formCetak3").append(html);
        } else {
            $("#formCetak3").hide();
            $("#hapus_semua5").remove();
            $(".hapus_semua5").remove();
        }
    });
    $("#tableKomputer .checked-komputer").on('change', function () {
        $('#formCetak3').attr('action', '{{ url("checked/inventaris/komputer") }}');
        var message = "";
        var html = "<div class='hapus_semua9'>";
        var currentRow = $(this).closest("tr");
        var col1 = currentRow.find("td:eq(1)").html(); //nomor
        var col2 = currentRow.find("td:eq(2)").html(); //ambil kode inventaris
        if ($(this).prop('checked')) {
            $("#formCetak3").show();
            html += '<input type="hidden" name="kode_inventaris[]" value="' + col2 + '" id="inputkomputer' + col1 + '"></input></div>';
            $("#formCetak3").append(html);
        } else {
            var checked_count = $('.checked-komputer').filter(':checked').length;
            if (checked_count != 0) {
                $("#inputkomputer" + col1).remove();
            } else {
                $("#formCetak3").hide();
                $("#inputkomputer" + col1).remove();
            }
        }
    });
</script>
@endsection
