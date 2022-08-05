@extends('layouts.master')
@section('inventaris', 'active')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Inventaris</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-warning">Table Inventaris</h4>
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

                            <button name="button" value="cetak" type="submit" class="btn btn-primary icon-left text-white"><i class="fas fa-print"></i> &nbsp; Cetak</button>
                            <button name="button" value="hapus" type="submit" class="btn btn-danger icon-left text-white"><i class="fas fa-trash"></i> &nbsp; Hapus</button>
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
                                    <th>Tahun Pembelian</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
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
                                    <td>{{ $item->namaRuangan }}</td>
                                    <td>{{ $item->kondisi }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>{{ date('Y', strtotime($item->tgl_pembelian)); }}</td>
                                    <td>
                                        <form method="POST" action="{{ url('hapus/inventaris/'.$item->kodeInventaris) }}">
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
                                                data-toggle="tooltip" title='Delete'><i
                                                    class="fas fa-trash"></i>Delete</button>
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
</section>
@include('layouts.sweatalert')
<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
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
        $("#formCetak").hide();
    })
    $(".check-all").on('change',function(){
        var html = "<div id='hapus_semua'>";
        var col1,col2;
        $(".checked").prop('checked',this.checked);
        $(".checked").each(function(){
            var row = $(this).closest("tr")[0];
                col1 = row.cells[1].innerHTML; //nomor
                col2 = row.cells[2].innerHTML; //ambil kode inventaris
                html += '<input type="hidden" name="kode_inventaris[]" value="'+col2+'" id="input'+col1+'"></input>';
        });
        html += "<div>"
        if ($(this).prop('checked')) {
            $("#formCetak").show();
            $("#formCetak").append(html);
        }else{
            $("#formCetak").hide();
            $("#hapus_semua").remove();
        }
    });
    $("#myTable .checked").on('change',function(){
        var message = "";
        var currentRow = $(this).closest("tr");
        var col1 = currentRow.find("td:eq(1)").html(); //nomor
        var col2 = currentRow.find("td:eq(2)").html(); //ambil kode inventaris
        if ($(this).prop('checked')) {
             $("#formCetak").show();
             var html = '<input type="hidden" name="kode_inventaris[]" value="'+col2+'" id="input'+col1+'"></input>';
             $("#formCetak").append(html);
        }else{
            var checked_count = $('.checked').filter(':checked').length;
            if(checked_count != 0){
                $("#input"+col1).remove();
            }else{
                $("#formCetak").hide();
                $("#input"+col1).remove();
            }
        }
    });
</script>
@endsection
