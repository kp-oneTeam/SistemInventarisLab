@extends('layouts.master')
@section('barang','active')
@section('content')
<!-- Modal Tambah Data -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="exampleModalLabel">Form Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('tambah/barang') }}" method="post" id="formBarang">
                    @csrf
                    <div class="form-group">
                        <label for="">Kode Barang</label>
                        <input type="text" name="kode_barang" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" id="nama_barang" name="nama_barang" class="form-control nama_barang">
                        <div class="invalid-feedback" id="err_tambah_nama_barang">

                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-icon icon-left btn-primary" data-dismiss="modal"><i
                        class="fas fa-times"></i>Batal</button>
                <button type="submit" id="tambah_barang" class="btn btn-warning btn-icon icon-left btn-warning"><i
                        class="far fa-save"></i>Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Update Data -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Form Ubah Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="editformBarang">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Kode Barang</label>
                        <input type="text" disabled name="kode_barang" id="input_edit_kode_barang"class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" name="nama_barang" id="input_edit_nama_barang" class="form-control edit_nama_barang">
                        <div class="invalid-feedback" id="err_edit_nama_barang">

                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-icon icon-left btn-danger" data-dismiss="modal"><i
                        class="fas fa-times"></i>Batal</button>
                <button type="submit" id="btn_simpan_update" class="btn btn-warning btn-icon icon-left btn-primary"><i
                        class="far fa-save"></i>Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<section class="section">
    <div class="section-header">
        <h1>Data Barang</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-warning">Table Barang</h4>
                    <div class="card-header-form">
                        <form>
                            <div class="input-group">
                                <a href="{{ url('tambah/barang') }}" class="btn btn-warning mr-2"
                                    class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah
                                    Data</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-sm-1">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->kodeBarang }}</td>
                                    <td>{{ $item->namaBarang }}</td>
                                    <td>
                                        <form method="POST" action="{{ url('hapus/barang/'.$item->kodeBarang) }}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ url('detail/barang/'.$item->kodeBarang) }}"
                                                class="btn btn-sm btn-icon icon-left btn-info"><i
                                                    class="far fa-eye"></i> Detail</a>
                                            <button type="button" class="btn btn-sm btn-icon icon-left btn-primary btn_editBarang" data-toggle="modal" data-target="#updateModal">
                                                <i class="far fa-edit" data-id="{{ $item->kodeBarang }}"></i> Edit</button>
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
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });
</script>
<script>
    $("#myTable .btn_editBarang").on("click", function() {
            var count = $('.mainbody > tr').length+1;
            var currentRow = $(this).closest("tr");
            var col1 = currentRow.find("td:eq(1)").html(); // get current row 1st table cell TD value
            var col2 = currentRow.find("td:eq(2)").html(); // get current row 2nd table cell TD value
            $("#input_edit_kode_barang").val(col1);
            $("#input_edit_nama_barang").val(col2);
            $("#editformBarang").attr('action','update/barang/'+col1);
    });
    //Validasi Tambah (Nama Barang)
    $("#nama_barang").on('input',function(){
        var delay = 0;
        $('#msg_err_tambah_nama_barang').remove()
        $.ajax({
            url : 'validasi_barang/'+$(this).val(),
            type : 'GET',
            dataType : 'json',
            success: function (data) {
                setTimeout(function(){
                    $('.nama_barang').removeClass("is-invalid")
                    $('#msg_err_tambah_nama_barang').remove()
                    if (data.status === true) {
                        $('.nama_barang').addClass("is-invalid")
                        html = "<div id='msg_err_tambah_nama_barang'>";
                        html += data.message;
                        html += "</div>";
                        $('#err_tambah_nama_barang').append(html)
                        $('#tambah_barang').prop('disabled',true); //button simpan agar tidak dapat diklik
                    }else{
                        $('.nama_barang').removeClass("is-invalid")
                        $('#msg_err_tambah_nama_barang').remove()
                        $('#tambah_barang').prop('disabled',false);  //button simpan agar dapat diklik
                    }
                },delay);
            }
        });
    });
    //Validasi Edit
    $("#input_edit_nama_barang").on('input',function() {
        var delay = 0;
        // $('#msg_err_update_nama_barang').remove()
        $.ajax({
            url : 'validasi_edit_barang/'+$("#input_edit_kode_barang").val()+'/'+$(this).val(),
            type : 'GET',
            dataType : 'json',
            success : function (data) {
                setTimeout(function(){
                    $('#msg_err_update_nama_barang').remove()
                    $('.edit_nama_barang').removeClass("is-invalid")
                    if (data.status === true) {
                        $('.edit_nama_barang').addClass("is-invalid")
                        html = "<div id='msg_err_update_nama_barang'>";
                        html += data.message;
                        html += "</div>";
                        $('#err_edit_nama_barang').append(html)
                        $('#btn_simpan_update').prop('disabled',true);
                    }else{
                        $('.edit_nama_barang').removeClass("is-invalid")
                        $('#msg_err_update_nama_barang').remove()
                        $('#btn_simpan_update').prop('disabled',false);
                    }
                },delay)
            }
        });
    });
    //Modal Edit Close
    $('#updateModal').on('hidden.bs.modal',function () {
        $('.edit_nama_barang').removeClass("is-invalid")
        $('#msg_err_update_nama_barang').remove()
        $('#btn_simpan_update').prop('disabled',false);
    });

</script>
@endsection
