@extends('layouts.master')
@section('barang','active')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Barang</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Table Barang</h4>
                    <div class="card-header-form">
                        <form>
                            <div class="input-group">
                                <a href="{{ url('tambah/barang') }}" class="btn btn-primary mr-2">Tambah Data</a>
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
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.sweatalert')
@endsection
