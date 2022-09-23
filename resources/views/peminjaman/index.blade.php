@extends('layouts.master')
@section('peminjaman', 'active')
@section('content')
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-height: 80%">
        <div class="modal-content ">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Detail Peminjaman Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="height: 80vh; overflow-y: auto;">
                <form action="" method="get" id="detailPeminjaman">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Kode Peminjaman</label>
                                <input type="text" disabled name="kode_barang" id="kode_peminjaman"class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Peminjam</label>
                                <input type="text" disabled name="kode_barang" id="nama_peminjam"class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">NIP/NID/NIM/NIK</label>
                                <input type="text" disabled name="kode_barang" id="no_identitas"class="form-control">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Tanggal Pinjam</label>
                                        <input type="text" disabled name="kode_barang" id="no_identitas"class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Tanggal Kembali</label>
                                        <input type="text" disabled name="kode_barang" id="no_identitas"class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label >Tujuan Peminjaman</label>
                        <textarea name="spek" disabled id="" class="form-control"></textarea>
                    </div>
                    <div class="table-responsive p-sm-1">
                        <table class="table table-striped" id="tableDetail">
                            <thead>
                                <tr>
                                    <th >No</th>
                                    <th >Kode Inventaris</th>
                                    <th >Nama Alat/Barang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>31434312413434</td>
                                    <td>Camera</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>31434312413434</td>
                                    <td>HDMI</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>31434312413434</td>
                                    <td>Camera</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>31434312413434</td>
                                    <td>HDMI</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>31434312413434</td>
                                    <td>Camera</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>31434312413434</td>
                                    <td>HDMI</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-icon icon-left btn-danger" data-dismiss="modal"><i
                        class="fas fa-times"></i>Batal</button>
                <a href="{{ url('pengembalian/1') }}" class="btn btn-sm btn-icon icon-left btn-primary" data-toggle="tooltip" title="Pengembalian Barang">
                     <i class="fas fa-undo"></i>Pengembalian
                </a>
            </div>
        </div>
    </div>
</div>
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
                                    <a href="{{ url('tambah/peminjaman') }}" class="btn btn-warning mr-2">Tambah Data</a>
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
                                        <th>Nama Peminjam</th>
                                        <th>Barang Yang Dipinjam</th>
                                        <th>Tujuan dan Kepentingan</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
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
        $('#tableDetail').DataTable({
        paging:false,
        ordering:false,
        info:false,
        searching:false
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
