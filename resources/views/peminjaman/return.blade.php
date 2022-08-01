@extends('layouts.master')
@section('peminjaman', 'active')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pengembalian Alat/Barang</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-warning">Rincian Pengembalian</h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('tambah/peminjaman') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama Peminjam</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="table-responsive p-sm-1">
                            <table class="table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama/Alata & Acc</th>
                                        <th>Kode Barang</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    <tr>
                                        <td>1</td>
                                        <td>Camera</td>
                                        <td>321324343</td>
                                        <td>Ok</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>RAM 8 GB</td>
                                        <td>343243242</td>
                                        <td>Ok</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Pengembalian</label>
                            <input type="date" name="tanggal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label >Keterangan</label>
                            <textarea name="ket" id="" class="form-control"></textarea>
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
    $('#myTable').DataTable();
    });
</script>
@endsection