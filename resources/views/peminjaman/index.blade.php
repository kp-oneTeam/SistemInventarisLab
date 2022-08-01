@extends('layouts.master')
@section('peminjaman', 'active')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Peminjaman</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-warning">Table Peminjaman</h4>
                        <div class="card-header-form">
                            <form>
                                <div class="input-group">
                                    <a href="{{ url('tambah/peminjaman') }}" class="btn btn-warning mr-2" class="btn btn-primary">Tambah Data</a>
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
                                        <th>Nama/Alata & Acc</th>
                                        <th>Tujuan dan Kepentingan</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Tgl Kembali</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    <tr>
                                        <td>1</td>
                                        <td>Camera</td>
                                        <td>Acara Fakultas</td>
                                        <td>12 Agustus 2022</td>
                                        <td>17 Agustus 2022</td>
                                        <td>
                                            <form method="POST" action="{{ url('hapus/barang/1') }}">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ url('pengembalian/1') }}" class="btn btn-sm btn-icon icon-left btn-primary"><i class="far fa-edit"></i>Pengembalian</a>
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