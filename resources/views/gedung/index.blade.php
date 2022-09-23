@extends('layouts.master')
@section('gedung','active')
@section('content')
<!-- Modal Tambah data -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="exampleModalLabel">Form Data gedung</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('tambah/gedung') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Gedung</label>
                        <input type="text" id="nama_gedung" name="nama_gedung" class="form-control nama_gedung">
                        <div class="invalid-feedback" id="err_tambah_nama_gedung">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-icon icon-left btn-primary" data-dismiss="modal"><i class="fas fa-times"></i>Batal</button>
                        <button type="submit" id="tambah_gedung" class="btn btn-warning btn-icon icon-left btn-warning"><i class="far fa-save"></i>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Tambah Data -->
<!-- Modal Update Data -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Form Ubah Data gedung</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="editformgedung">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Nama gedung</label>
                        <input type="text" name="nama_gedung" id="input_edit_nama_gedung"class="form-control edit_nama_gedung">
                        <div class="invalid-feedback" id="err_edit_nama_gedung">

                        </div>
                        <input type="hidden" name="" id="input_edit_id_gedung">
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
        <section class="section">
            <div class="section-header">
                <h1>Data Gedung</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-warning"></h4>
                            <div class="card-header-form">
                                <form>
                                    <div class="input-group">
                                        <a href="{{ url('tambah/gedung') }}" class="btn btn-warning mr-2" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Data</a>
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
                                            <th>Nama Gedung</th>
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
                                            <td>{{ $item->namaGedung }}</td>
                                            <td>
                                                <form method="POST" action="{{ url('hapus/gedung/'.$item->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-icon icon-left btn-primary btn_editgedung"  data-id="{{ $item->id }}" data-toggle="modal" data-target="#updateModal">
                                                    <i class="far fa-edit"></i> Edit
                                                </button>
                                                <button type="submit" class="btn btn-icon btn-sm icon-left btn-danger show_confirm" data-toggle="tooltip" title='Hapus'><i class="fas fa-trash"></i>Hapus</button>
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
    $(document).ready(function(){
    $('#myTable').DataTable();
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
    $("#myTable .btn_editgedung").on("click", function() {
            var dataId = $(this).attr("data-id");
            var count = $('.mainbody > tr').length+1;
            var currentRow = $(this).closest("tr"); // get current row 1st table cell TD value
            var nama_gedung = currentRow.find("td:eq(1)").html(); // get current row 2nd table cell TD value // get current row 2nd table cell TD value
            $("#input_edit_nama_gedung").val(nama_gedung);
            $("#input_edit_id_gedung").val($(".btn_editgedung").attr("data-id"));
            $("#editformgedung").attr('action','update/gedung/'+$(".btn_editgedung").attr("data-id"));
    });
    //Validasi Tambah (Nama gedung)
    $("#nama_gedung").keyup(function(){
        var delay = 0;
        var value = this.value;
        $('#msg_err_tambah_nama_gedung').remove()
        $.ajax({
            url : 'validasi_gedung/'+value,
            type : 'GET',
            dataType : 'json',
            success: function (data) {
                setTimeout(function(){
                    $('.nama_gedung').removeClass("is-invalid")
                    $('#msg_err_tambah_nama_gedung').remove()
                    if (data.status === true) {
                        $('.nama_gedung').addClass("is-invalid")
                        html = "<div id='msg_err_tambah_nama_gedung'>";
                        html += data.message;
                        html += "</div>";
                        $('#err_tambah_nama_gedung').append(html)
                        $('#tambah_gedung').prop('disabled',true); //button simpan agar tidak dapat diklik
                    }else{
                        $('.nama_gedung').removeClass("is-invalid")
                        $('#msg_err_tambah_nama_gedung').remove()
                        $('#tambah_gedung').prop('disabled',false);  //button simpan agar dapat diklik
                    }
                },delay);
            }
        });
    });
    //Validasi Edit
    $("#input_edit_nama_gedung").keyup(function() {
        var delay = 0;
        var value = this.value;
        $.ajax({
            url : 'validasi_edit_gedung/'+$("#input_edit_id_gedung").val()+'/'+value,
            type : 'GET',
            dataType : 'json',
            success : function (data) {
                setTimeout(function(){
                    $('#msg_err_update_nama_gedung').remove()
                    $('.edit_nama_gedung').removeClass("is-invalid")
                    if (data.status === true) {
                        $('.edit_nama_gedung').addClass("is-invalid")
                        html = "<div id='msg_err_update_nama_gedung'>";
                        html += data.message;
                        html += "</div>";
                        $('#err_edit_nama_gedung').append(html)
                        $('#btn_simpan_update').prop('disabled',true);
                    }else{
                        $('.edit_nama_gedung').removeClass("is-invalid")
                        $('#msg_err_update_nama_gedung').remove()
                        $('#btn_simpan_update').prop('disabled',false);
                    }
                },delay)
            }
        });
    });
    //Modal Edit Close
    $('#updateModal').on('hidden.bs.modal',function () {
        $('.edit_nama_gedung').removeClass("is-invalid")
        $('#msg_err_update_nama_gedung').remove()
        $('#btn_simpan_update').prop('disabled',false);
    });
</script>
{{-- checkbox --}}
<script>
    $(".check-all").on('change',function(){
        var html = "<div id='hapus_semua'>";
        var col1,col2;
        $(".checked").prop('checked',this.checked);
        $(".checked").each(function(){
            var row = $(this).closest("tr")[0];
                col1 = row.cells[1].innerHTML; //nomor
                col2 = row.cells[2].innerHTML; //ambil kode gedung
                html += '<input type="hidden" name="kode_gedung[]" value="'+col2+'" id="input'+col1+'"></input>';
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
        var col2 = currentRow.find("td:eq(2)").html(); //ambil kode gedung
        if ($(this).prop('checked')) {
             $("#formHapus").show();
             html += '<input type="hidden" name="kode_gedung[]" value="'+col2+'" id="input'+col1+'"></input></div>';
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
