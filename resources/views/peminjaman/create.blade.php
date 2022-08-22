@extends('layouts.master')
@section('peminjaman', 'active')
@section('content')
{{-- Modal Tambah Barang --}}
<div class="modal fade" id="daftarBarangModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document" style="max-height: 80%">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Daftar Barang Inventaris</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="height: 80vh; overflow-y: auto;">
                <div class="table-responsive text-center p-sm-1">
                    <table class="table table-striped" id="daftarBarangTable">
                        <thead>
                            <tr>
                                <th class="text-center">Kode Inventaris</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-center">Spesifikasi</th>
                                <th class="text-center">Lokasi</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $item->kodeInventaris }}</td>
                                            <td>{{ $item->namaBarang }}</td>
                                            <td>{{ $item->spesifikasi }}</td>
                                            <td>{{ $item->namaRuangan }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-icon icon-right btn-primary pilih-barang" data-dismiss="modal">
                                                    <i class="fas fa-check"></i> Pilih
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-icon icon-left btn-danger" data-dismiss="modal"><i
                        class="fas fa-times"></i>Batal</button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Tambah Barang --}}
<section class="section">
    <div class="section-header">
        <h1>Tambah Data Peminjaman</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-warning">Rincian Peminjaman</h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('tambah/peminjaman') }}" method="POST">
                        @csrf
                        <h6>Kamis, 20 Agustus 2022</h6><br>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nama Peminjam</label>
                                    <input type="text" name="nama_peminjam" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>No.Identitas (NID/NIP/NIM)</label>
                                    <input type="text" name="no_identitas" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label >Daftar Alat/Barang yang dipinjam:</label>
                        </div>
                        <div class="table-responsive p-sm-1">
                            <table class="table table-striped text-center" id="tableBarang">
                                <thead>
                                    <tr >
                                        <th class="text-center" style="width:25%">Kode Inventaris</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center" style="width:10%">Spesifikasi</th>
                                        <th class="text-center" style="width:10%">Lokasi</th>
                                        <th class="text-center" style="width:10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="tableBody">
                                </tbody>
                            </table>
                        </div>
                        <br>

                            <div class="input-group d-flex justify-content-end">
                                <button type="button" class="btn btn-md btn-icon icon-left btn-primary btn-daftar-barang" data-toggle="modal" data-target="#daftarBarangModal" title="Tambah Barang">
                                    <i class="fa fa-plus" ></i></button>
                            </div>
                        <br>
                        <div class="form-group">
                            <label >Tujuan Peminjaman</label>
                            <textarea name="tujuan_peminjaman" id="" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Peminjaman</label>
                            <input type="date" name="tanggal_pinjam" class="form-control">
                        </div>
                        <div class="form-group">
                            <label >Keterangan</label>
                            <textarea name="ket" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning btn-icon icon-left btn-warning float-right m-2"><i class="fas fa-save"></i>Simpan</button>
                            <a href="{{ url('peminjaman') }}" class="btn btn-secondary btn-icon icon-left btn-primary float-right m-2"><i class="fas fa-times"></i>Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
$(document).ready(function(){
    $('#daftarBarangTable').DataTable({
        info:false
    });

    $("#daftarBarangTable .pilih-barang").on("click", function() {
            var count = $('.tableBody > tr').length+1;
            var currentRow = $(this).closest("tr");
            var col1 = currentRow.find("td:eq(0)").html(); // get current row 1st table cell TD value
            var col2 = currentRow.find("td:eq(1)").html(); // get current row 2nd table cell TD value
            var col3 = currentRow.find("td:eq(2)").html(); // get current row 2nd table cell TD value
            var col4 = currentRow.find("td:eq(3)").html(); // get current row 2nd table cell TD value
            html = "<tr class='baris'>";
            html += "<input type='hidden' name='idInventaris[]' value='"+ col1 +"'>";
            html += "<td>"+ col1 +"</td>";
            html += "<td>"+ col2 +"</td>";
            html += "<td>"+ col3 +"</td>";
            html += "<td>"+ col4 +"</td>";
            html += "<td><button type='button' class='btn btn-icon btn-sm icon-left btn-danger remove-row'><i class='fas fa-trash'></i>Hapus</button></td>"
            html += "</tr>";
            $(".tableBody").append(html);
    });
    $(document).on('click','.remove-row',function(){
                $(this).closest(".baris").remove();
                $('.tableBody > tr').each(function(i){
                    $('.numbers',this).html(i+1);
                });
        });
        function renumberRows() {
            $(".tableBody > tr").each(function(i, v) {
                $(this).find(".rownumber").text(i + 1);
            });
        }
});
</script>
<script>
    $(".btn-detail-peminjaman").on("click", function() {
    });
</script>
@endsection