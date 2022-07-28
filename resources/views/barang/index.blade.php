@extends('layouts.master')
@section('barang','active')
@section('content')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning text-white">
        <h5 class="modal-title" id="exampleModalLabel">Form Data Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form action="{{ url('tambah/barang') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Kode Barang</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Nama Barang</label>
                <input type="text" class="form-control">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-icon icon-left btn-primary" data-dismiss="modal"><i class="fas fa-times"></i>Batal</button>
        <button type="submit" class="btn btn-warning btn-icon icon-left btn-warning"><i class="far fa-save"></i>Simpan</button>
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
                                <a href="{{ url('tambah/barang') }}" class="btn btn-warning mr-2" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Data</a>
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                <tr>
                                    <td>1</td>
                                    <td>BRG01</td>
                                    <td>Monitor</td>
                                    <td>
                                        <form method="POST" action="{{ url('hapus/barang/1') }}">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ url('detail/barang/1') }}" class="btn btn-sm btn-icon icon-left btn-info"><i class="far fa-eye"></i> Detail</a>
                                        <a href="{{ url('edit/barang/1') }}" class="btn btn-sm btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Edit</a>
                                        <button type="submit" class="btn btn-icon btn-sm icon-left btn-danger show_confirm" data-toggle="tooltip" title='Delete'><i class="fas fa-trash"></i>Delete</button>
                                        </form>
                                    </td>
                                </tr>
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

     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
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
@endsection
