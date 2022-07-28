@extends('layouts.master')
@section('barang','active')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Data Barang</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p>
                        <div class="row">
                            <div class="col-2">Nama Barang</div>
                            <div class="col-1">:</div>
                            <div class="col-6">Monitor</div>
                        </div>
                    </p>
                    <p>
                        <div class="row">
                            <div class="col-2">Kode Barang</div>
                            <div class="col-1">:</div>
                            <div class="col-6">BRG01</div>
                        </div>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-warning">Data Inventariss</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-sm-1">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Inventaris</th>
                                    <th>Lokasi</th>
                                    <th>Spesifikasi</th>
                                    <th>Kondisi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                <tr>
                                    <td>1</td>
                                    <td>22010101</td>
                                    <td>R.32</td>
                                    <td>LG 22Inch </td>
                                    <td>Baik</td>
                                    <td>
                                        <form method="POST" action="{{ url('hapus/inventaris/1') }}">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ url('edit/inventaris/1') }}" class="btn btn-sm btn-icon icon-left btn-info"><i class="far fa-eye"></i> Detail</a>
                                        <a href="{{ url('edit/inventaris/1') }}" class="btn btn-sm btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Edit</a>
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
