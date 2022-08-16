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
                        <h6>Kamis, 20 Agustus 2022</h6><br>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Kode Peminjaman</label>
                                    <input type="text" disabled class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tanggal Pinjam</label>
                                    <input type="date" disabled class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>NIP/NID/NIM/NIK</label>
                                    <input type="text" disabled class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nama Peminjam</label>
                                    <input type="text" disabled class="form-control">
                                </div>
                            </div>
                        </div>
                        
                       <div class="form-group">
                        <label >Daftar Barang yang dipinjam:</label>
                       </div>
                        <div class="table-responsive p-sm-1 text-center">
                            <table class="table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Kode Inventaris</th>
                                        <th class="text-center">Nama/Alata & Acc</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    <tr>
                                        <td>1</td>
                                        <td>321324343</td>
                                        <td>Camera</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>343243242</td>
                                        <td>RAM 8 GB</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
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
    $('#myTable').DataTable({
        paging:false,
        ordering:false,
        info:false,
        searching:false
    });
    });
</script>
@endsection