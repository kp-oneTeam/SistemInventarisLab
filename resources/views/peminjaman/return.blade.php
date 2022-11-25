@extends('layouts.master')
@section('peminjaman', 'active')
@section('content')
<section class="section">
    <div class="section-header">
        <a href="{{ url('peminjaman') }}" class="btn btn-warning mr-4 btn-icon icon-left"><i class="fas fa-caret-left"></i></a>
        <h1>Pengembalian</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-warning">Rincian Pengembalian</h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('proses/pengembalian/'.$data->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Kode Peminjaman</label>
                                    <input type="text" name="kode_peminjamamn" readonly value="{{ $data->kodePeminjaman }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tanggal Piminjaman</label>
                                    <input type="date" name="tanggal_peminjaman" readonly value="{{ $data->tglPeminjaman }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>NIP/NID/NIM/NIK</label>
                                    <input type="text" name="no_identitas" readonly value="{{ $data->noIdentitas }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nama Peminjam</label>
                                    <input type="text" name="nama_peminjam" readonly value="{{ $data->namaPeminjam }}" disabled class="form-control">
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                        <label >Daftar Barang yang dipinjam:</label>
                       </div>
                       <table class="table table-bordered" id="myTable">
                           <thead class="text-center">
                               <tr class="text-center">
                                   <th>No</th>
                                   <th>Kode Inventaris</th>
                                   <th>Nama/Alat & Acc</th>
                                   <th>Kondisi</th>
                                   <th>Keterangan</th>
                               </tr>
                           </thead>
                           <tbody>
                               @php
                                   $no = 1;
                               @endphp
                               @foreach ($inventaris as $item)
                               <tr>
                                   <td>{{ $no++ }}</td>

                                   <td>{{ $item->inventaris($item->idInventaris)->kodeInventaris }}</td>
                                   <td>{{ $item->inventaris($item->idInventaris)->barang->namaBarang }} {{ $item->inventaris($item->idInventaris)->spesifikasi }}</td>
                                   <td>
                                        <div class="form-check form-check-inline">
                                            <input required class="form-check-input" type="radio" name="kondisi[{{ $no-2 }}]" id="inlineRadio{{ $no }}" value="Baik">
                                            <label class="form-check-label" for="inlineRadio1">Baik</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input required class="form-check-input" type="radio" name="kondisi[{{ $no-2 }}]" id="inlineRadio{{ $no }}" value="Rusak">
                                            <label class="form-check-label" for="inlineRadio2">Rusak</label>
                                        </div>
                                   </td>
                                   <td>
                                        <input type="hidden" class="form-control" name="idInventaris[]">
                                        <input type="text" class="form-control" name="keterangan_inv[]">
                                   </td>
                               </tr>
                               @endforeach
                           </tbody>
                       </table>
                        <br>
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
