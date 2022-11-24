@extends('layouts.master') @section('vendor','active') @section('content')
<!-- Modal Tambah Data -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    Form Data Vendor
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('tambah/vendor') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Vendor</label>
                        <input type="text" id="nama_vendor" name="nama_vendor" class="form-control nama_vendor"/>
                        <div class="invalid-feedback" id="err_tambah_nama_vendor"></div>
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Telepon</label>
                        <input type="number" name="telepon_vendor" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat Vendor</label>
                        <input type="text" name="alamat_vendor" class="form-control"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-icon icon-left btn-primary" data-dismiss="modal">
                            <i class="fas fa-times"></i>Batal
                        </button>
                        <button  type="submit" id="tambah_vendor" class="btn btn-warning btn-icon icon-left btn-warning">
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
                    <div class="form-group sr-only">
                        <label for="">Kode Vendor</label>
                        <input type="text" name="id" id="input_edit_kode_vendor" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Vendor</label>
                        <input type="text" name="nama_vendor" id="input_edit_nama_vendor" class="form-control edit_nama_vendor">
                        <div class="invalid-feedback" id="err_edit_nama_vendor"> </div>
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Telepon</label>
                        <input type="text" name="telepon_vendor" id="input_edit_telp_vendor" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat Vendor</label>
                        <textarea name="alamat_vendor" id="input_edit_alamat_vendor" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-icon icon-left btn-danger" data-dismiss="modal">
                            <i class="fas fa-times"></i>Batal
                        </button>
                        <button type="submit" id="btn_simpan_update" class="btn btn-warning btn-icon icon-left btn-primary">
                            <i class="far fa-save"></i>Simpan
                        </button>
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
                    <h4 class="text-warning"></h4>
                    <div class="card-header-form">
                        <form>
                            <div class="input-group">
                                <a href="{{ url('tambah/vendor') }}" class="btn btn-warning mr-2" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Data</a>
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
                                    <th>Nama Vendor</th>
                                    <th>Nomor Telepon</th>
                                    <th>Alamat Vendor</th>
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
                                        <td>{{ $item->namaVendor }}</td>
                                        <td>{{ $item->teleponVendor }}</td>
                                        <td>{{ $item->alamatVendor }}</td>
                                        <td>
                                            <form method="POST" action="{{ url('hapus/vendor/'.$item->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ url('detail/vendor/'.$item->id) }}" class="btn btn-sm btn-icon icon-left btn-info">
                                                    <i class="far fa-eye" data-id="{{ $item->id }}"></i>Detail
                                                    </a>
                                                <button type="button" class="btn btn-sm btn-icon icon-left btn-primary btn_editVendor" data-id="{{ $item->id }}" data-toggle="modal", data-target="#updateModal" >
                                                    <i class="far fa-edit" ></i>Edit
                                                    </button>
                                                <button type="submit" class="btn btn-icon btn-sm icon-left btn-danger show_confirm" data-toggle="tooltip" title="Hapus">
                                                    <i class="fas fa-trash"></i>Hapus
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
        $("#myTable").DataTable({
            "autoWidth":false,
            "columnDefs": [
                { "width": "5%", "targets": 0 }
            ],
            language: {
                "url": "{{ url('admin/js/datatable-id.json') }}",
            }
        });
    });
</script>
<script type="text/javascript">
    $('.show_confirm').click(function (event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text:'Akan Menghapus Data!',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
            icon: 'warning',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });
</script>
<script>
    $("#myTable .btn_editVendor").on("click", function() {
            var count = $('.mainbody > tr').length+1;
            var currentRow = $(this).closest("tr");
            var id = $(this).data("id");
            var nama_vendor = currentRow.find("td:eq(1)").html(); // get current row 1st table cell TD value
            var telepon_vendor = currentRow.find("td:eq(2)").html(); // get current row 2nd table cell TD value
            var alamat_vendor = currentRow.find("td:eq(3)").html(); // get current row 1st table cell TD value
            $("#input_edit_kode_vendor").val(id);
            $("#input_edit_nama_vendor").val(nama_vendor);
            $("#input_edit_telp_vendor").val(telepon_vendor);
            $("#input_edit_alamat_vendor").val(alamat_vendor);
            $("#editformVendor").attr('action','update/vendor/'+id);
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
{{-- checkbox --}}
<script>
    $(document).ready(function () {
        $("#formHapus").hide();
    })
    $(".check-all").on('change',function(){
        var html = "<div id='hapus_semua'>";
        var col1,col2;
        $(".checked").prop('checked',this.checked);
        $(".checked").each(function(){
            var row = $(this).closest("tr")[0];
                col1 = row.cells[1].innerHTML; //nomor
                col2 = row.cells[2].innerHTML; //ambil kode Vendor
                html += '<input type="hidden" name="kode_vendor[]" value="'+col2+'" id="input'+col1+'"></input>';
        });
        html += "<div>"
        if ($(this).prop('checked')) {
            $(".hapus_semua").remove();
            $("#formHapus").show();
            $("#formHapus").append(html);
        }else{
            $("#formHapus").hide();
            $("#hapus_semua").remove();
            $(".hapus_semua").remove();
        }
    });
    $("#myTable .checked").on('change',function(){
        var message = "";
        var html = "<div class='hapus_semua'>";
        var currentRow = $(this).closest("tr");
        var col1 = currentRow.find("td:eq(1)").html(); //nomor
        var col2 = currentRow.find("td:eq(2)").html(); //ambil kode vendor
        if ($(this).prop('checked')) {
             $("#formHapus").show();
             html += '<input type="hidden" name="kode_vendor[]" value="'+col2+'" id="input'+col1+'"></input></div>';
             $("#formHapus").append(html);
        }else{
            var checked_count = $('.checked').filter(':checked').length;
            if(checked_count != 0){
                $("#input"+col1).remove();
            }else{
                $("#formHapus").hide();
                $("#input"+col1).remove();
            }
        }
    });
</script>
@endsection
