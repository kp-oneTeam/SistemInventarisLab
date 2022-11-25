@extends('layouts.master')
@section('dashboard','active')
@section('content')
    @php
        $inv_baik = 0;
        $inv_rusak = 0;
        $inv_pinjam = 0;
    @endphp
    @foreach ($data as $item)
        @if ($item->kondisi == "Baik")
            @php
                $inv_baik = $inv_baik + 1
            @endphp
        @else
            @php
                $inv_rusak = $inv_rusak + 1
            @endphp
        @endif
        @if ($item->keterangan == "Sedang dipinjam")
            @php
                $inv_pinjam = $inv_pinjam + 1
            @endphp
        @endif
    @endforeach
    @foreach ($motherboard as $item)
        @if ($item->kondisi == "Baik")
            @php
                $inv_baik = $inv_baik + 1
            @endphp
        @else
            @php
                $inv_rusak = $inv_rusak + 1
            @endphp
        @endif
        @if ($item->keterangan == "Sedang dipinjam")
            @php
                $inv_pinjam = $inv_pinjam + 1
            @endphp
        @endif
    @endforeach
    @foreach ($processor as $item)
        @if ($item->kondisi == "Baik")
            @php
                $inv_baik = $inv_baik + 1
            @endphp
        @else
            @php
                $inv_rusak = $inv_rusak + 1
            @endphp
        @endif
        @if ($item->keterangan == "Sedang dipinjam")
            @php
                $inv_pinjam = $inv_pinjam + 1
            @endphp
        @endif
    @endforeach
    @foreach ($ram as $item)
        @if ($item->kondisi == "Baik")
            @php
                $inv_baik = $inv_baik + 1
            @endphp
        @else
            @php
                $inv_rusak = $inv_rusak + 1
            @endphp
        @endif
        @if ($item->keterangan == "Sedang dipinjam")
            @php
                $inv_pinjam = $inv_pinjam + 1
            @endphp
        @endif
    @endforeach
    @foreach ($gpu as $item)
        @if ($item->kondisi == "Baik")
            @php
                $inv_baik = $inv_baik + 1
            @endphp
        @else
            @php
                $inv_rusak = $inv_rusak + 1
            @endphp
        @endif
        @if ($item->keterangan == "Sedang dipinjam")
            @php
                $inv_pinjam = $inv_pinjam + 1
            @endphp
        @endif
    @endforeach
    @foreach ($psu as $item)
        @if ($item->kondisi == "Baik")
            @php
                $inv_baik = $inv_baik + 1
            @endphp
        @else
            @php
                $inv_rusak = $inv_rusak + 1
            @endphp
        @endif
        @if ($item->keterangan == "Sedang dipinjam")
            @php
                $inv_pinjam = $inv_pinjam + 1
            @endphp
        @endif
    @endforeach
    @foreach ($casing as $item)
        @if ($item->kondisi == "Baik")
            @php
                $inv_baik = $inv_baik + 1
            @endphp
        @else
            @php
                $inv_rusak = $inv_rusak + 1
            @endphp
        @endif
        @if ($item->keterangan == "Sedang dipinjam")
            @php
                $inv_pinjam = $inv_pinjam + 1
            @endphp
        @endif
    @endforeach
    @foreach ($storage as $item)
        @if ($item->kondisi == "Baik")
            @php
                $inv_baik = $inv_baik + 1
            @endphp
        @else
            @php
                $inv_rusak = $inv_rusak + 1
            @endphp
        @endif
        @if ($item->keterangan == "Sedang dipinjam")
            @php
                $inv_pinjam = $inv_pinjam + 1
            @endphp
        @endif
    @endforeach
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary text-white">
                        <i class="fas fa-box" style="font-size: 35px"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Jumlah Inventaris Non Komputer</h4>
                        </div>
                        <div class="card-body">
                            {{ $data->count() ?? "0" }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info text-white">
                        <i class="fas fa-hdd" style="font-size: 35px"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Inventaris Peralatan Komputer</h4>
                        </div>
                        <div class="card-body">
                            @php
                                $count_mth = ($motherboard->count() ?? 0);
                                $count_cpu = ($processor->count() ?? 0);
                                $count_ram = ($processor->count() ?? 0 );
                                $count_storage = ($storage->count() ?? 0);
                                $count_gpu = ($gpu->count() ?? 0);
                                $count_psu = ($psu->count() ?? 0);
                                $count_casing = ($casing->count() ?? 0);
                                $total_peralatan = $count_mth + $count_cpu + $count_ram + $count_storage + $count_gpu + $count_psu + $count_casing;
                            @endphp
                            {{ $total_peralatan }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success text-white">
                        <i class="fas fa-desktop" style="font-size: 35px"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Inventaris Komputer</h4>
                        </div>
                        <div class="card-body">
                            {{ $komputer->count() ?? "0" }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success text-white">
                        <i class="fas fa-check-square" style="font-size: 35px"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Inventaris Yang Normal</h4>
                        </div>
                        <div class="card-body">
                            {{ $inv_baik ?? "0" }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger text-white">
                        <i class="fas fa-times-circle" style="font-size: 35px"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Inventaris Yang Rusak</h4>
                        </div>
                        <div class="card-body">
                            {{ $inv_rusak ?? "0" }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning text-white">
                        <i class="fas fa-people-carry" style="font-size: 35px"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Inventaris Sedang Dipinjam</h4>
                        </div>
                        <div class="card-body">
                           {{ $inv_pinjam ?? "0" }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 section-header">
                <h1>Ruangan</h1>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-warning">Inventaris Non-Komputer</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Ruangan</th>
                                    <th>Ruangan</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($inv_non_komputer as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                 <td>{{ $item['kodeRuangan'] }}</td>
                                <td>{{ $item['namaRuangan'] }}</td>
                                <td>{{ $item['jumlah'] }}</td>
                                <td>
                                    <a href="{{ url('detail/ruangan/'.$item['idRuangan']) }}"
                                                class="btn btn-sm btn-icon icon-left btn-info">
                                                <i class="far fa-eye"></i> Lihat
                                            </a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-warning">Inventaris Peralatan Komputer</h4>
                    </div>
                    <div class="card-body">
                            <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Ruangan</th>
                                    <th>Ruangan</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($inv_peralatan_komputer as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item['kodeRuangan'] }}</td>
                                <td>{{ $item['namaRuangan'] }}</td>
                                <td>{{ $item['jumlah'] }}</td>
                                <td>
                                    <a href="{{ url('detail/ruangan/'.$item['idRuangan']) }}"
                                                class="btn btn-sm btn-icon icon-left btn-info">
                                                <i class="far fa-eye"></i> Lihat
                                            </a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-warning">Inventaris Komputer</h4>
                    </div>
                    <div class="card-body">
                            <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Ruangan</th>
                                    <th>Ruangan</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($inv_komputer as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item['kodeRuangan'] }}</td>
                                <td>{{ $item['namaRuangan'] }}</td>
                                <td>{{ $item['jumlah'] }}</td>
                                <td>
                                    <a href="{{ url('detail/ruangan/'.$item['idRuangan']) }}"
                                                class="btn btn-sm btn-icon icon-left btn-info">
                                                <i class="far fa-eye"></i> Lihat
                                            </a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-8 section-header">
                <h1>Barang</h1>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Inventaris</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                @foreach ($barang as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->namaBarang }}</td>
                                    <td>{{ $item->inventaris($item->id) }}</td>
                                    <td>
                                        <form method="POST" action="{{ url('hapus/barang/'.$item->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ url('detail/barang/'.$item->id) }}" class="btn btn-sm btn-icon icon-left btn-info"><i
                                                    class="far fa-eye"></i> Detail</a>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-md-8 section-header">
                <h1>Vendor</h1>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Inventaris</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                @foreach ($vendor as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->namaVendor }}</td>
                                    <td>{{ $item->inventaris($item->id) }}</td>
                                    <td>
                                        <form method="POST" action="{{ url('hapus/barang/'.$item->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ url('detail/vendor/'.$item->id) }}" class="btn btn-sm btn-icon icon-left btn-info"><i
                                                    class="far fa-eye"></i> Detail</a>
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
        {{-- <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Statistik Pendapatan Tahun {{ date("Y") }}</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart" style="height: 190px;margin: 35px auto;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Statistik Penyewaan Kost Tahun {{ date("Y") }}</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart2" style="height: 190px;margin: 35px auto;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
               <div class="card">
                <div class="card-header">
                    Review
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($review as $rev)
                        <div class="col-md-6">
                             <div class="card author-box card-primary">
                                <div class="card-body">
                                    <div class="author-box-left">
                                    <img alt="image" src="{{ asset($rev->foto) }}" class="rounded-circle img-thumbnail" width="100px" height="100px">
                                    <div class="clearfix"></div>
                                    </div>
                                    <div class="author-box-details">
                                    <div class="author-box-name">
                                        <a href="#">{{ $rev->penyewa }}</a>
                                    </div>
                                    <div class="author-box-job">{{ $rev->kostan }} Tipe {{ $rev->tipe }}</div>
                                    <div class="author-box-job">Rating :
                                        <span>
                                            @for ($i = 1; $i <= $rev->rating; $i++)
                                            <i class="bi bi-star-fill"></i>
                                            @endfor
                                        </span>
                                    </div>
                                    <div class="author-box-description">
                                        <p>
                                            {{ $rev->review }}
                                        </p>
                                    </div>
                                    </div>
                                </div>
                                </div>
                        </div>
                        @endforeach
                    </div>
                </div>
               </div>
            </div>
        </div> --}}
    </section>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>

</script>
@endsection
