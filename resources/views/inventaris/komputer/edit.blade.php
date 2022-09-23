@extends('layouts.master')
@section('inventaris', 'active')
@section('content')
<section class="section">
    <div class="section-header">
        <a href="{{ url('inventaris/komputer') }}" class="btn btn-warning mr-4"><i class="fas fa-arrow-left"></i></a>
        <h1>Edit Data Inventaris</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('update/inventaris_komputer/'.$data->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Motherboard</label>
                            <select name="motherboard" class="form-control select2" required>
                                <option value="{{ $data->idInventarisMotherboard }}">{{
                                    $data->motherboard->kodeInventaris }} | {{ $data->motherboard->socketMotherboard }}
                                    | {{ $data->motherboard->namaMotherboard }} {{
                                    $data->motherboard->chipsetMotherboard }}</option>
                                @foreach ($motherboard as $item)
                                @if ($data->idInventarisMotherboard != $item->id && ($item->keterengan != "Sudah
                                dipasang dikomputer" || $item->keterangan != "Sedang dipinjam"))
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{
                                    $item->socketMotherboard }} | {{ $item->namaMotherboard }} {{
                                    $item->chipsetMotherboard }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Processor</label>
                            <select name="processor" class="form-control select2">
                                <option value="{{ $data->idInventarisProcessor }}">{{ $data->processor->kodeInventaris
                                    }} | {{ $data->processor->namaProcessor }} | {{ $data->processor->series ." - ".
                                    $data->processor->nomorProcessor }} | Gen {{ $data->processor->generasi }} | {{
                                    $data->processor->kecepatan . " GHz" }} | {{ $data->processor->jumlahCore. "C/" .
                                    $data->processor->jumlahThread ."T" }}</option>
                                @foreach ($processor as $item)
                                @if ($data->idInventarisProcessor != $item->id && ($item->keterengan != "Sudah dipasang
                                dikomputer" || $item->keterangan != "Sedang dipinjam"))
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{ $item->namaProcessor }}
                                    | {{ $item->series ." - ". $item->nomorProcessor }} | Gen {{ $item->generasi }} | {{
                                    $item->kecepatan . " GHz" }} | {{ $item->jumlahCore. "C/" . $item->jumlahThread ."T"
                                    }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ram </label>
                            <button class="btn btn-primary btn-sm float-right mb-2" type="button" data-toggle="modal"
                                data-target="#addRam"><i class="fas fa-plus-circle"></i></button>
                            <table class="table table-bordered">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Inventaris</th>
                                    <th>Nama Memori</th>
                                    <th>Jenis Memori</th>
                                    <th>Kapasitas Memori</th>
                                    <th>Tipe Memori</th>
                                    <th>Frekuensi Memori</th>
                                    <th>Aksi</th>
                                </tr>
                                @php
                                $no = 1;
                                @endphp
                                @foreach ($data->ram($data->id) as $item)
                                <tr>
                                    <input type="hidden" name="ram[]" value="{{ $item->idInventarisRam }}">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->rams->kodeInventaris }}</td>
                                    <td>{{ $item->rams->namaMemory }}</td>
                                    <td>{{ $item->rams->jenisMemory }}</td>
                                    <td>{{ $item->rams->kapasitasMemory }}GB</td>
                                    <td>PC{{ $item->rams->tipeMemory }}</td>
                                    <td>{{ $item->rams->frekuensiMemory }}Hz</td>
                                    <td>
                                        <button type="button" class="btn btn-icon btn-sm btn-danger" data-toggle="modal"
                                            data-target="#staticBackdrop{{ $item->rams->id }}"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                            {{-- <button class="btn btn-primary btn-sm float-right mb-2 sr-only" type="button"
                                id="addRam"><i class="fas fa-plus-circle"></i></button>
                            <select name="ram[]" class="form-control select2" id="selectRam">
                                <option value="">-- Pilih RAM --</option>
                                @foreach ($ram as $item)
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} {{ $item->namaRam }} | {{
                                    $item->jenisMemory }} | PC{{ $item->tipeMemory }} | {{ $item->frekuensiMemory }}Hz |
                                    {{ $item->kapasitasMemory }}GB</option>
                                @endforeach
                            </select> --}}
                        </div>
                        <div id="newRam"></div>
                        <div class="form-group">
                            <label>VGA</label>
                            <select name="vga" class="form-control select2">
                                <option value="{{ $data->idInventarisGpu }}">{{ $data->gpu->kodeInventaris }} | {{
                                    $data->gpu->namaGpu }} | {{ $data->gpu->tipeMemori }} | {{ $data->gpu->ukuranMemori
                                    }}GB</option>
                                @foreach ($vga as $item)
                                @if ($data->idInventarisGpu != $item->id && ($item->keterengan != "Sudah dipasang
                                dikomputer" || $item->keterangan != "Sedang dipinjam"))
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{ $item->namaGpu }} | {{
                                    $item->tipeMemori }} | {{ $item->ukuranMemori }}GB</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Storage</label>
                            <button class="btn btn-primary btn-sm float-right mb-2" type="button"
                                data-toggle="modal"
                                data-target="#addStorage"><i class="fas fa-plus-circle"></i></button>
                            <table class="table table-bordered">
                                <tr>
                                    <th>No</th>
                                    <th>Nama / Merk</th>
                                    <th>Jenis</th>
                                    <th>Kapasitas</th>
                                    <th>Aksi</th>
                                </tr>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($data->storage($data->id) as $item)
                                <tr>
                                    <input type="hidden" name="storage[]" value="{{ $item->idInventarisStorage }}">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->storage->namaStorage }}</td>
                                    <td>{{ $item->storage->jenisStorage }}</td>
                                    <td>{{ $item->storage->kapasitasStorage }}GB</td>
                                    <td>
                                        <button type="button" class="btn btn-icon btn-sm btn-danger" data-toggle="modal"
                                            data-target="#staticBackdropStorage{{ $item->storage->id }}"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div id="newStorage"></div>
                        <div class="form-group">
                            <label>PSU</label>
                            <select name="psu" class="form-control select2">
                                <option value="{{ $data->idInventarisPsu }}">{{ $data->psu->kodeInventaris }} | {{
                                    $data->psu->namaPsu }} {{ $data->psu->besarDaya }}W {{ $data->psu->sertifikasiPsu }}
                                    | {{ $data->psu->jenisKabel }} {{ $data->psu->formFactor }}</option>
                                @foreach ($psu as $item)
                                @if ($data->idInventarisPsu != $item->id && ($item->keterengan != "Sudah dipasang
                                dikomputer" || $item->keterangan != "Sedang dipinjam"))
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{ $item->namaPsu }} {{
                                    $item->besarDaya }}W {{ $item->sertifikasiPsu }} | {{ $item->jenisKabel }} {{
                                    $item->formFactor }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>CASING</label>
                            <select name="casing" class="form-control select2">
                                <option value="{{ $data->idInventarisCasing }}">{{ $data->casing->kodeInventaris }} | {{
                                    $data->casing->namaCasing }} {{ $data->casing->formFactor }}</option>
                                @foreach ($casing as $item)
                                @if ($data->idInventarisCasing != $item->id && ($item->keterengan != "Sudah dipasang
                                dikomputer" || $item->keterangan != "Sedang dipinjam"))
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{ $item->namaCasing }} {{
                                    $item->formFactor }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Lokasi</label>
                            <select name="lokasi" class="form-control select2" required>
                                <option value="{{ $data->idRuangan }}">{{ $data->ruangan->namaRuangan }}
                                </option>
                                @foreach ($lokasi as $item)
                                @if ($item->id != $data->idRuangan)
                                <option value="{{ $item->id }}">{{ $item->kodeRuangan." || ".$item->namaRuangan
                                    }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Perakitan</label>
                            <input value="{{ $data->tanggal_perakitan }}" type="date" name="tanggal"
                                class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kondisi</label>
                            <div class="selectgroup w-100">
                                @if ($data->kondisi == "Baik")
                                <label class="selectgroup-item">
                                    <input type="radio" name="kondisi" value="Baik" class="selectgroup-input" checked
                                        required>
                                    <span class="selectgroup-button">Baik</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="kondisi" value="Rusak" class="selectgroup-input" required>
                                    <span class="selectgroup-button">Rusak</span>
                                </label>
                                @else
                                <label class="selectgroup-item">
                                    <input type="radio" name="kondisi" value="Baik" class="selectgroup-input" required>
                                    <span class="selectgroup-button">Baik</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="kondisi" value="Rusak" class="selectgroup-input" checked
                                        required>
                                    <span class="selectgroup-button">Rusak</span>
                                </label>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit"
                                class="btn btn-warning btn-icon icon-left btn-warning float-right m-2"><i
                                    class="fas fa-save"></i>Simpan</button>
                            <a href="{{ url('inventaris') }}"
                                class="btn btn-secondary btn-icon icon-left btn-primary float-right m-2"><i
                                    class="fas fa-times"></i>Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- Add Ram --}}
<div class="modal fade" id="addRam" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah RAM</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('tambah/inventaris_komputer/ram/'.$data->id) }}" method="post">
                    @csrf
                    <label>Ram </label>
                    <button class="btn btn-primary btn-sm float-right mb-2 sr-only" type="button" id="addRam"><i
                            class="fas fa-plus-circle"></i></button>
                    <select name="ram" class="form-control select2" id="selectRam">
                        <option value="">-- Pilih RAM --</option>
                        @foreach ($ram as $item)
                        <option value="{{ $item->id }}">{{ $item->kodeInventaris }} {{ $item->namaRam }} | {{
                            $item->jenisMemory }} | PC{{ $item->tipeMemory }} | {{ $item->frekuensiMemory }}Hz | {{
                            $item->kapasitasMemory }}GB</option>
                        @endforeach
                    </select>
                    <div class="form-group">
                        <label class="sr-only">Lokasi</label>
                        <select name="lokasi" class="form-control sr-only">
                            <option value="{{ $data->idRuangan }}">{{ $data->ruangan->namaRuangan }}
                            </option>
                            @foreach ($lokasi as $item)
                            @if ($item->id != $data->idRuangan)
                            <option value="{{ $item->id }}">{{ $item->kodeRuangan." || ".$item->namaRuangan
                                }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-warning">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- modal hapus ram --}}
@foreach ($data->ram($data->id) as $item)
<div class="modal fade" id="staticBackdrop{{ $item->rams->id }}" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Hapus RAM</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('hapus/inventaris_komputer/ram/'.$data->id.'/'.$item->rams->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="" class="form-label">Pindahkan Keruangan</label>
                        <select name="lokasi_ram" class="form-control select2" required>
                            <option value="{{ $data->idRuangan }}">{{ $data->ruangan->namaRuangan }}
                            </option>
                            @foreach ($lokasi as $item)
                            @if ($item->id != $data->idRuangan)
                            <option value="{{ $item->id }}">{{ $item->kodeRuangan." || ".$item->namaRuangan
                                }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Kondisi</label>
                        <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                                <input type="radio" name="kondisi_ram" value="Baik"
                                    class="selectgroup-input kondisi_ram" required>
                                <span class="selectgroup-button">Baik</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="kondisi_ram" value="Rusak"
                                    class="selectgroup-input kondisi_ram" required>
                                <span class="selectgroup-button">Rusak</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group alasan_ram sr-only">
                        <label for="" class="form-label">Keterangan</label>
                        <input type="text" name="keterangan_ram" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-warning">Hapus</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach
{{-- Add storage --}}
<div class="modal fade" id="addStorage" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Storage</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('tambah/inventaris_komputer/storage/'.$data->id) }}" method="post">
                    @csrf
                    <label>Storage </label>
                                                <select name="storage" class="form-control select2" id="selectStorage">
                                <option value="">-- Pilih Storage --</option>
                                @foreach ($storage as $item)
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{ $item->jenisStorage }}
                                    | {{ $item->namaStorage }} {{ $item->kapasitasStorage }}GB</option>
                                @endforeach
                            </select>
                    <div class="form-group">
                        <label class="sr-only">Lokasi</label>
                        <select name="lokasi" class="form-control sr-only">
                            <option value="{{ $data->idRuangan }}">{{ $data->ruangan->namaRuangan }}
                            </option>
                            @foreach ($lokasi as $item)
                            @if ($item->id != $data->idRuangan)
                            <option value="{{ $item->id }}">{{ $item->kodeRuangan." || ".$item->namaRuangan
                                }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-warning">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- modal hapus storage --}}
@foreach ($data->storage($data->id) as $item)
<div class="modal fade" id="staticBackdropStorage{{ $item->storage->id }}" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Hapus Storage</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('hapus/inventaris_komputer/storage/'.$data->id.'/'.$item->storage->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="" class="form-label">Pindahkan Keruangan</label>
                        <select name="lokasi_storage" class="form-control select2" required>
                            <option value="{{ $data->idRuangan }}">{{ $data->ruangan->namaRuangan }}
                            </option>
                            @foreach ($lokasi as $item)
                            @if ($item->id != $data->idRuangan)
                            <option value="{{ $item->id }}">{{ $item->kodeRuangan." || ".$item->namaRuangan
                                }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Kondisi</label>
                        <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                                <input type="radio" name="kondisi_storage" value="Baik"
                                    class="selectgroup-input kondisi_storage" required>
                                <span class="selectgroup-button">Baik</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="kondisi_storage" value="Rusak"
                                    class="selectgroup-input kondisi_storage" required>
                                <span class="selectgroup-button">Rusak</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group alasan_storage sr-only">
                        <label for="" class="form-label">Keterangan</label>
                        <input type="text" name="keterangan_storage" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-warning">Hapus</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<script>
    $("input[name=kondisi_ram]:radio").click(function () {
        if ($('input[name=kondisi_ram]:checked').val() == "Baik") {
            $(".alasan_ram").addClass("sr-only");
        } else if ($('input[name=kondisi_ram]:checked').val() == "Rusak") {
            $(".alasan_ram").removeClass("sr-only");
        }
    });
    $("input[name=kondisi_storage]:radio").click(function () {
        if ($('input[name=kondisi_storage]:checked').val() == "Baik") {
            $(".alasan_storage").addClass("sr-only");
        } else if ($('input[name=kondisi_storage]:checked').val() == "Rusak") {
            $(".alasan_storage").removeClass("sr-only");
        }
    });
</script>
@endsection
