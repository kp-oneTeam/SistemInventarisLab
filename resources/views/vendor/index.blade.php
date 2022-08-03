@extends('layouts.master') @section('vendor','active') @section('content')
<!-- Modal Tambah Data -->
<div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    Form Data Vendor
                </h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('tambah/vendor') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Kode Vendor</label>
                        <input
                            type="text"
                            name="kode_vendor"
                            class="form-control"
                        />
                    </div>
                    <div class="form-group">
                        <label for="">Nama Vendor</label>
                        <input
                            type="text"
                            id="nama_vendor"
                            name="nama_vendor"
                            class="form-control nama_vendor"
                        />
                        <div class="invalid-feedback" id="err_tambah_nama_vendor">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-icon icon-left btn-primary"
                            data-dismiss="modal"
                        >
                            <i class="fas fa-times"></i>Batal
                        </button>
                        <button
                            type="submit"
                            id="tambah_vendor"
                            class="btn btn-warning btn-icon icon-left btn-warning"
                        >
                            <i class="far fa-save"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- endModal Tambah Data -->
<!-- Modal Update Data -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Form Ubah Data Vendor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="editformVendor">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Kode Vendor</label>
                        <input type="text" disabled name="kode_vendor" id="input_edit_kode_vendor"class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Vendor</label>
                        <input type="text" name="nama_vendor" id="input_edit_nama_vendor"class="form-control edit_nama_vendor">
                        <div class="invalid-feedback" id="err_edit_nama_vendor">

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
</div>
{{-- end Modal update --}}
<section class="section">
    <div class="section-header">
        <h1>Data Vendor</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-warning">Table Vendor</h4>
                    <div class="card-header-form">
                        <form>
                            <div class="input-group">
                                <a
                                    href="{{ url('tambah/vendor') }}"
                                    class="btn btn-warning mr-2"
                                    class="btn btn-primary"
                                    data-toggle="modal"
                                    data-target="#exampleModal"
                                    >Tambah Data</a
                                >
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
                                    <th>Kode Vendor</th>
                                    <th>Nama Vendor</th>
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
                                        <td>{{ $item->kodeVendor }}</td>
                                        <td>{{ $item->namaVendor }}</td>
                                        <td>
                                            <form method="POST" action="{{ url('hapus/vendor/'.$item->kodeVendor) }}">
                                                @csrf 
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-icon icon-left btn-primary btn_editVendor" data-toggle="modal", data-target="#updateModal" >
                                                    <i class="far fa-edit" data-id="{{ $item->kodeVendor }}"></i>Edit
                                                    </button>
                                                <button
                                                    type="submit"
                                                    class="btn btn-icon btn-sm icon-left btn-danger show_confirm"
                                                    data-toggle="tooltip"
                                                    title="Delete">
                                                    <i class="fas fa-trash"></i
                                                    >Delete
                                                </button>
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
        $("#myTable").DataTable();
    });
</script>
<script type="text/javascript">
    $(".show_confirm").click(function (event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        Swal.fire({
            title: "Apakah Anda Yakin Akan Menghapus Data?",
            showCancelButton: true,
            confirmButtonText: "Yes",
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
<script>
    $("#myTable .btn_editVendor").on("click", function() {
            var count = $('.mainbody > tr').length+1;
            var currentRow = $(this).closest("tr");
            var kode_vendor = currentRow.find("td:eq(1)").html(); // get current row 1st table cell TD value
            var nama_vendor = currentRow.find("td:eq(2)").html(); // get current row 2nd table cell TD value
            $("#input_edit_kode_vendor").val(kode_vendor);
            $("#input_edit_nama_vendor").val(nama_vendor);
            $("#editformVendor").attr('action','update/vendor/'+kode_vendor);
        });
    //Validasi Tambah (Nama Vendor)
    $("#nama_vendor").on('input',function(){
        var delay = 0;
        $('#msg_err_tambah_nama_vendor').remove()
        $.ajax({
            url : 'validasi_vendor/'+$(this).val(),
            type : 'GET',
            dataType : 'json',
            success: function (data) {
                setTimeout(function(){
                    $('.nama_vendor').removeClass("is-invalid")
                    $('#msg_err_tambah_nama_vendor').remove()
                    if (data.status === true) {
                        $('.nama_vendor').addClass("is-invalid")
                        html = "<div id='msg_err_tambah_nama_vendor'>";
                        html += data.message;
                        html += "</div>";
                        $('#err_tambah_nama_vendor').append(html)
                        $('#tambah_vendor').prop('disabled',true); //button simpan agar tidak dapat diklik
                    }else{
                        $('.nama_vendor').removeClass("is-invalid")
                        $('#msg_err_tambah_nama_vendor').remove()
                        $('#tambah_vendor').prop('disabled',false);  //button simpan agar dapat diklik
                    }
                },delay);
            }
        });
    });
    //Validasi Edit
    $("#input_edit_nama_vendor").on('input',function() {
        var delay = 0;
        // $('#msg_err_update_nama_vendor').remove()
        $.ajax({
            url : 'validasi_edit_vendor/'+$("#input_edit_kode_vendor").val()+'/'+$(this).val(),
            type : 'GET',
            dataType : 'json',
            success : function (data) {
                setTimeout(function(){
                    $('#msg_err_update_nama_vendor').remove()
                    $('.edit_nama_vendor').removeClass("is-invalid")
                    if (data.status === true) {
                        $('.edit_nama_vendor').addClass("is-invalid")
                        html = "<div id='msg_err_update_nama_vendor'>";
                        html += data.message;
                        html += "</div>";
                        $('#err_edit_nama_vendor').append(html)
                        $('#btn_simpan_update').prop('disabled',true);
                    }else{
                        $('.edit_nama_vendor').removeClass("is-invalid")
                        $('#msg_err_update_nama_vendor').remove()
                        $('#btn_simpan_update').prop('disabled',false);
                    }
                },delay)
            }
        });
    });
    //Modal Edit Close
    $('#updateModal').on('hidden.bs.modal',function () {
        $('.edit_nama_vendor').removeClass("is-invalid")
        $('#msg_err_update_nama_vendor').remove()
        $('#btn_simpan_update').prop('disabled',false);
    });
</script>

@endsection
