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
                    <div class="table-responsive p-sm-1">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Inventaris</th>
                                    <th>Nama Barang</th>
                                    <th>Spesifikasi</th>
                                    <th>Lokasi</th>
                                    <th>Harga</th>
                                    <th>Tahun</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                <tr>
                                    <td>1</td>
                                    <td>20220701</td>
                                    <td>CPU/KOMPUTER</td>
                                    <td>INTEL I3-12000F - 8GB -NVIDIA 3090</td>
                                    <td>R.35</td>
                                    <td>9.000.000</td>
                                    <td>2002</td>
                                    <td>
                                        <form method="POST" action="{{ url('hapus/inventaris/1') }}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ url('detail/inventaris/1') }}"
                                                class="btn btn-sm btn-icon icon-left btn-info mb-2"><i
                                                    class="far fa-eye"></i> Detail</a>
                                            <a href="{{ url('edit/inventaris/1') }}"
                                                class="btn btn-sm btn-icon icon-left btn-primary mb-2"><i
                                                    class="far fa-edit"></i> Edit</a>
                                            <button type="submit"
                                                class="btn btn-icon btn-sm icon-left btn-danger show_confirm"
                                                data-toggle="tooltip" title='Delete'><i
                                                    class="fas fa-trash"></i>Delete</button>
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
@endsection
