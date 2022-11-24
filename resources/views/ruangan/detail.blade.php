@extends('layouts.master')
@section('ruangan','active')
@section('content')
<section class="section">
    <div class="section-header">
        <a href="{{ url('ruangan') }}" class="btn btn-warning mr-4 btn-icon icon-left"><i class="fas fa-caret-left"></i></a>
        <h1>Detail Ruangan</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p>
                    <div class="row">
                        <div class="col-2">Kode Ruangan</div>
                        <div class="col-1">:</div>
                        <div class="col-6">{{ $data->kodeRuangan }}</div>
                    </div>
                    </p>
                    <p>
                    <div class="row">
                        <div class="col-2">Nama Ruangan</div>
                        <div class="col-1">:</div>
                        <div class="col-6">{{ $data->namaRuangan }}</div>
                    </div>
                    </p>
                    <p>
                    <div class="row">
                        <div class="col-2">Gedung</div>
                        <div class="col-1">:</div>
                        <div class="col-6">{{ $data->gedung->namaGedung }}</div>
                    </div>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-warning">Data Inventaris</h4>
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
                                @foreach ($inventaris as $item)
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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-warning">Data Inventaris Peralatan Komputer</h4>
                </div>
            <div class="card-body">
                <br><br>
                {{-- tab --}}
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab"
                            aria-controls="home" aria-selected="true">Motherboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab"
                            aria-controls="profile" aria-selected="false">Processor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab"
                            aria-controls="contact" aria-selected="false">Ram</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab"
                            aria-controls="contact" aria-selected="false">Storage</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab5" data-toggle="tab" href="#contact5" role="tab"
                            aria-controls="contact" aria-selected="false">Graphics Processor Unit (GPU)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab6" data-toggle="tab" href="#contact6" role="tab"
                            aria-controls="contact" aria-selected="false">Power Supply(PSU)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab7" data-toggle="tab" href="#contact7" role="tab"
                            aria-controls="contact" aria-selected="false">Casing</a>
                    </li>
                </ul>
                <div class="tab-content m-2" id="myTabContent2">
                    {{-- motherboard --}}
                    @include('inventaris.peralatan_komputer.motherboard.list')
                    {{-- processor --}}
                    @include('inventaris.peralatan_komputer.processor.list')
                    {{-- Memory --}}
                    @include('inventaris.peralatan_komputer.ram.list')
                    {{-- storage --}}
                    @include('inventaris.peralatan_komputer.storage.list')
                    {{-- GPU --}}
                    @include('inventaris.peralatan_komputer.gpu.list')
                    {{-- PSU --}}
                    @include('inventaris.peralatan_komputer.psu.list')
                    {{-- Casing --}}
                    @include('inventaris.peralatan_komputer.casing.list')
                </div>
            </div>
            </div>
        </div>
        <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-warning">Data Inventaris Komputer</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive p-sm-1">
                                <table class="table table-striped" id="tableKomputer">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" class="check-all-komputer"></th>
                                            <th>No</th>
                                            <th>Kode Inventaris</th>
                                            <th>Spesifikasi Komputer</th>
                                            <th>Lokasi</th>
                                            <th>Tanggal Perakitan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no = 1;
                                        @endphp
                                        @foreach ($komputer as $item)
                                        <tr>
                                            <td width="1%"><input type="checkbox" class="checked-komputer"> </td>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->kodeInventarisKomputer }}</td>
                                            <td>
                                                {{ $item->motherboard->namaMotherboard }} {{ $item->motherboard->chipsetMotherboard }} -
                                                {{ $item->processor->namaProcessor }} {{ $item->processor->series }} {{ $item->processor->nomorProcessor }} {{ $item->processor->kecepatan }}Ghz -
                                                @foreach ($item->ram($item->id) as $value)
                                                ({{ $value->rams->namaMemory }} {{ $value->rams->jenisMemory }} {{ $value->rams->kapasitasMemory }}GB {{ $value->rams->frekuensiMemory }}Hz)
                                                @endforeach
                                                -
                                                @foreach ($item->storage($item->id) as $value)
                                                ({{ $value->storage->namaStorage }} {{ $value->storage->jenisStorage }} {{ $value->storage->kapasitasStorage }}GB)
                                                @endforeach
                                                -
                                                {{ $item->gpu->namaGpu }} {{ $item->gpu->tipeMemori }} {{ $item->gpu->ukuranMemori }}GB
                                                -
                                                {{ $item->psu->namaPsu }} {{ $item->psu->jenisKabel }} {{ $item->psu->besarDaya }}W {{ $item->psu->sertifikasiPsu }}
                                                -
                                                {{ $item->casing->namaCasing }}
                                            </td>
                                            <td>{{ $item->ruangan->namaRuangan }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item->tanggal_perakitan)); }}</td>
                                            <td>{{ $item->kondisi }}</td>
                                            <td>
                                                <form method="POST" action="{{ url('hapus/inventaris_komputer/'.$item->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ url('detail/inventaris_komputer/'.$item->id) }}"
                                                        class="btn btn-sm btn-icon icon-left btn-info mb-2"><i
                                                            class="far fa-eye"></i> Detail</a>
                                                    <a href="{{ url('edit/inventaris_komputer/'.$item->id) }}"
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
        $('#myTable').DataTable({
            "autoWidth":false,
            "columnDefs": [
                { "width": "5%", "targets": 0 }
            ],
            language: {
                "url": "{{ url('admin/js/datatable-id.json') }}",
            }
        });
        $('#TableMotherboard').DataTable({
            "autoWidth":false,
            "columnDefs": [
                { "width": "5%", "targets": 0 }
            ],
            language: {
                "url": "{{ url('admin/js/datatable-id.json') }}",
            }
        });
        $('#tableProcessor').DataTable({
            "autoWidth":false,
            "columnDefs": [
                { "width": "5%", "targets": 0 }
            ],
            language: {
                "url": "{{ url('admin/js/datatable-id.json') }}",
            }
        });
        $('#tableRam').DataTable({
            "autoWidth":false,
            "columnDefs": [
                { "width": "5%", "targets": 0 }
            ],
            language: {
                "url": "{{ url('admin/js/datatable-id.json') }}",
            }
        });
        $('#tableStorage').DataTable({
            "autoWidth":false,
            "columnDefs": [
                { "width": "5%", "targets": 0 }
            ],
            language: {
                "url": "{{ url('admin/js/datatable-id.json') }}",
            }
        });
        $('#tableGpu').DataTable({
            "autoWidth":false,
            "columnDefs": [
                { "width": "5%", "targets": 0 }
            ],
            language: {
                "url": "{{ url('admin/js/datatable-id.json') }}",
            }
        });
        $('#tablePsu').DataTable({
            "autoWidth":false,
            "columnDefs": [
                { "width": "5%", "targets": 0 }
            ],
            language: {
                "url": "{{ url('admin/js/datatable-id.json') }}",
            }
        });
        $('#tableCasing').DataTable({
            "autoWidth":false,
            "columnDefs": [
                { "width": "5%", "targets": 0 }
            ],
            language: {
                "url": "{{ url('admin/js/datatable-id.json') }}",
            }
        });
        $('#tableKomputer').DataTable({
            "autoWidth":false,
            "columnDefs": [
                { "width": "5%", "targets": 0 }
            ],
            language: {
                "url": "{{ url('admin/js/datatable-id.json') }}",
            }
        });
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
