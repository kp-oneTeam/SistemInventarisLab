@extends('layouts.master')
@section('laporan', 'active')
@section('content')
<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
        <div class="modal-header bg-warning text-white">
            <h5 class="modal-title" id="exampleModalLabel">Form Data Ruangan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-icon icon-left btn-primary" data-dismiss="modal"><i class="fas fa-times"></i>Batal</button>
            <button type="submit" class="btn btn-warning btn-icon icon-left btn-warning"><i class="far fa-save"></i>Simpan</button>
        </div>
        </form>
        </div>
    </div>
    </div>
        <section class="section">
            <div class="section-header">
                <h1>Laporan Inventaris</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body m-2">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <form action="{{ url('laporan/print') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Dari Tanggal</label>
                                            <input type="date"  required name="dari_tanggal"  placeholder="dd-mm-yyyy" value="" min="1997-01-01" max="2030-12-31" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Sampai Tanggal</label>
                                            <input type="date" required  name="sampai_tanggal" id="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jenis Laporan</label>
                                            <select required  name="jenis_laporan" id="" class="form-control">
                                                <option value="Sedang dipinjam">Laporan Peminjaman</option>
                                                <option value="Rusak">Inventaris Yang Rusak</option>
                                                <option value="Baik">Inventaris Yang Normal</option>
                                                <option value="all">Semua Inventaris</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-warning btn-icon icon-left btn-warning float-right m-2"><i class="fas fa-print"></i>Cetak</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@include('layouts.sweatalert')
@endsection
