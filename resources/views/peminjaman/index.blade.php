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
                        @role('laboran')
                        <div class="card-header-form">
                            <form>
                                <div class="input-group">
                                    <a href="{{ url('tambah/peminjaman') }}" class="btn btn-warning mr-2">Tambah Data</a>
                                </div>
                            </form>
                        </div>
                        @endrole
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-sm-1">
                            <table class="table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Peminjam</th>
                                        <th>Barang Yang Dipinjam</th>
                                        <th>Tujuan dan Kepentingan</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status</th>
                                        @role('laboran')
                                        <th>Aksi</th>
                                        @endrole
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach($dataPeminjaman as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->namaPeminjam }}</td>
                                            <td>
                                                {{-- <ul> --}}
                                                @foreach ($item->detail_peminjaman($item->id) as $pinjaman)
                                                    <li>{{ $pinjaman->inventaris($pinjaman->idInventaris)->kodeInventaris }} - {{ $pinjaman->inventaris($pinjaman->idInventaris)->barang->namaBarang  }}  - {{ $pinjaman->inventaris($pinjaman->idInventaris)->spesifikasi }}  </li>
                                                @endforeach
                                                {{-- </ul> --}}
                                            </td>
                                            <td>{{ $item->tujuanPeminjaman }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item->tglPeminjaman)); }}</td>
                                            @if ($item->tglKembali == null)
                                                <td>-</td>
                                            @else
                                                <td>{{ date('d-m-Y', strtotime($item->tglKembali)); }}</td>
                                            @endif
                                            <td>{{ $item->status }}</td>
                                            @role('laboran')
                                            <td>
                                                <form method="POST" action="{{ url('hapus/peminjaman/'.$item->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    @if ($item->status != "Sudah dikembalikan")
                                                     <a href="{{ url('pengembalian/'.$item->id) }}" class="btn btn-sm btn-icon icon-left btn-primary mb-2" data-toggle="tooltip" title="Pengembalian Barang">
                                                        <i class="fas fa-undo"></i>Pengembalian
                                                    </a>
                                                    @endif
                                                    @if ($item->status == "Sudah dikembalikan")
                                                    <button type="submit" class="btn btn-icon btn-sm icon-left btn-danger show_confirm  mb-2" data-toggle="tooltip" title='Hapus Data'><i class="fas fa-trash"></i>Hapus</button>
                                                    @endif
                                                </form>
                                            </td>
                                            @endrole
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
        $('#myTable').DataTable({
        "autoWidth":false,
        "columnDefs": [
                { "width": "5%", "targets": 0 }
            ],
        language: {
                "url": "{{ url('admin/js/datatable-id.json') }}",
            },
            dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                className: "btn btn-danger",
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                }
            }
        ]
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
    $("#myTable .btn-detail-peminjaman").on("click", function() {
    });
</script>
@endsection
