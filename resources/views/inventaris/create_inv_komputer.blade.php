@extends('layouts.master')
@section('inventaris', 'active')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Data Inventaris</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('tambah/inventaris_komputer') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Lokasi</label>
                            <select name="lokasi" class="form-control select2">
                                <option value="">-- Pilih Ruang --</option>
                                @foreach ($lokasi as $item)
                                <option value="{{ $item->id }}">{{ $item->namaRuangan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Motherboard</label>
                            <select name="spek[]" class="form-control select2" required>
                                <option value="">-- Pilih Motherboard --</option>
                                @foreach ($motherboard as $item)
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{ $item->spesifikasi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Processor</label>
                            <select name="spek[]" class="form-control select2">
                                <option value="">-- Pilih Processor --</option>
                                @foreach ($processor as $item)
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{ $item->spesifikasi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ram </label>
                            <select name="spek[]" class="form-control select2">
                                <option value="">-- Pilih RAM --</option>
                                @foreach ($ram as $item)
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{ $item->spesifikasi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ram 2</label>
                            <select name="spek[]" class="form-control select2">
                                <option value="">-- Pilih RAM 2 --</option>
                                @foreach ($ram as $item)
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{ $item->spesifikasi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>VGA</label>
                            <select name="spek[]" class="form-control select2">
                                <option value="">-- Pilih VGA --</option>
                                @foreach ($vga as $item)
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{ $item->spesifikasi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Storage</label>
                            <select name="spek[]" class="form-control select2">
                                <option value="">-- Pilih Storage --</option>
                                @foreach ($storage as $item)
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{ $item->spesifikasi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Storage 2</label>
                            <select name="spek[]" class="form-control select2">
                                <option value="">-- Pilih Storage 2 --</option>
                                @foreach ($storage as $item)
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{ $item->spesifikasi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>PSU</label>
                            <select name="spek[]" class="form-control select2">
                                <option value="">-- Pilih PSU --</option>
                                @foreach ($psu as $item)
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{ $item->spesifikasi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>CASING</label>
                            <select name="spek[]" class="form-control select2">
                                <option value="">-- Pilih Casing --</option>
                                @foreach ($casing as $item)
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{ $item->spesifikasi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Perakitan</label>
                            <input type="date" name="tanggal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kondisi</label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="kondisi" value="Baik" class="selectgroup-input">
                                    <span class="selectgroup-button">Baik</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="kondisi" value="Rusak" class="selectgroup-input">
                                    <span class="selectgroup-button">Rusak</span>
                                </label>
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
@endsection
