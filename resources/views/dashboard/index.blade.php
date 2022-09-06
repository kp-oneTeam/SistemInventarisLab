@extends('layouts.master')
@section('dashboard','active')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary text-white" style="font-size: 40px">
                        <i class="bi bi-journal-check"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Inventaris Yang Normal</h4>
                        </div>
                        <div class="card-body">
                            20
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info text-white" style="font-size: 40px">
                        <i class="bi bi-check"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Inventaris Yang Rusak</h4>
                        </div>
                        <div class="card-body">
                            20
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success text-white" style="font-size: 40px">
                        <i class="bi bi-cash"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Inventaris Sedang Dipinjam</h4>
                        </div>
                        <div class="card-body">
                           20
                        </div>
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
