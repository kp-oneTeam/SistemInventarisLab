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
                        <div class="col-6">{{ $barang->namaBarang }}</div>
                    </div>
                    </p>
                    <p>
                    <div class="row">
                        <div class="col-2">Kode Barang</div>
                        <div class="col-1">:</div>
                        <div class="col-6">{{ $barang->kodeBarang }}</div>
                    </div>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-warning">Data Inventaris Monitor</h4>
                </div>
                <div class="card-body">
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
                                        <form method="POST"
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
