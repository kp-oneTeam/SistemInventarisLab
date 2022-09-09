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
                            <label>Motherboard</label>
                            <select name="motherboard" class="form-control select2" required>
                                <option value="">-- Pilih Motherboard --</option>
                                @foreach ($motherboard as $item)
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{ $item->socketMotherboard  }} | {{ $item->namaMotherboard }} {{ $item->chipsetMotherboard }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Processor</label>
                            <select name="processor" class="form-control select2">
                                <option value="">-- Pilih Processor --</option>
                                @foreach ($processor as $item)
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{ $item->namaProcessor }} | {{ $item->series ." - ". $item->nomorProcessor }} | Gen {{ $item->generasi }} | {{ $item->kecepatan . " GHz" }} | {{ $item->jumlahCore. "C/" . $item->jumlahThread ."T" }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ram </label>
                            <button class="btn btn-primary btn-sm float-right mb-2 sr-only" type="button" id="addRam"><i class="fas fa-plus-circle"></i></button>
                            <select name="ram[]" class="form-control select2" id="selectRam">
                                <option value="">-- Pilih RAM --</option>
                                @foreach ($ram as $item)
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }}  {{ $item->namaRam }} | {{ $item->jenisMemory }} | PC{{ $item->tipeMemory }} | {{ $item->frekuensiMemory }}Hz | {{ $item->kapasitasMemory }}GB</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="newRam"></div>
                        {{-- <div class="form-group">
                            <label>Ram 2</label>
                            <select name="spek[]" class="form-control select2">
                                <option value="">-- Pilih RAM 2 --</option>
                                @foreach ($ram as $item)
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{ $item->spesifikasi }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="form-group">
                            <label>VGA</label>
                            <select name="vga" class="form-control select2">
                                <option value="">-- Pilih VGA --</option>
                                @foreach ($vga as $item)
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{ $item->namaGpu }} | {{ $item->tipeMemori }} | {{ $item->ukuranMemori }}GB</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Storage</label>
                            <button class="btn btn-primary btn-sm float-right mb-2 sr-only" type="button" id="addStorage"><i class="fas fa-plus-circle"></i></button>
                            <select name="storage[]" class="form-control select2" id="selectStorage">
                                <option value="">-- Pilih Storage --</option>
                                @foreach ($storage as $item)
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{ $item->jenisStorage }} | {{ $item->namaStorage }} {{ $item->kapasitasStorage }}GB</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="newStorage"></div>
                        {{-- <div class="form-group">
                            <label>Storage 2</label>
                            <select name="spek[]" class="form-control select2">
                                <option value="">-- Pilih Storage 2 --</option>
                                @foreach ($storage as $item)
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{ $item->spesifikasi }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="form-group">
                            <label>PSU</label>
                            <select name="psu" class="form-control select2">
                                <option value="">-- Pilih PSU --</option>
                                @foreach ($psu as $item)
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{ $item->namaPsu }} {{ $item->besarDaya }}W {{ $item->sertifikasiPsu }} | {{ $item->jenisKabel }} {{ $item->formFactor }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>CASING</label>
                            <select name="casing" class="form-control select2">
                                <option value="">-- Pilih Casing --</option>
                                @foreach ($casing as $item)
                                <option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{ $item->namaCasing }} {{ $item->formFactor }}</option>
                                @endforeach
                            </select>
                        </div>
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
<script>
    $(document).ready(function(){
        var countRowRam = 1;
        var countRowStorage = 1;
        $("#addRam").hide();
        $("#selectRam").on('change',function(){
            var value = this.value;
            if(value != ""){
                $("#addRam").show();
                $("#addRam").removeClass('sr-only');
            }else{
                $("#addRam").hide();
                $("#addRam").addClass('sr-only');
            }
        });


        $("#addRam").click(function () {
            countRowRam = countRowRam + 1;
            var idram = $("#selectRam").val();
            var html = '';
            html += '<div id="inputFormRaw">';
            html += '<div class="form-group mb-3">';
            html += '<div class="row">'
                html += '<div class="col-md-11">'
                    html += '<select name="ram[]" class="form-control select2">';
                    html += '<option>-- Pilih Ram --</option>'
                    html += '@foreach($ram as $item)'
                    html += '<option value="{{ $item->id }}">{{ $item->kodeInventaris }}  {{ $item->namaRam }} | {{ $item->jenisMemory }} | PC{{ $item->tipeMemory }} | {{ $item->frekuensiMemory }}Hz | {{ $item->kapasitasMemory }}GB</option>';
                    html += '@endforeach'
                    html += '</select>'
                html += '</div>'
                html += '<div class="col-md-1">'
                html += '<button id="removeRam" type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>'
                html += '</div>'
            html += '</div>'
            html += '</div>';

            $("#newRam").append(html);
            if (countRowRam == 4) {
                $("#addRam").hide();
            }else{
                $("#addRam").show();
            }
            $('.select2').select2();
        });

        // remove row
        $(document).on('click', '#removeRam', function () {
            countRowRam = countRowRam - 1;
            if (countRowRam == 4) {
                $("#addRam").hide();
            }else{
                $("#addRam").show();
            }
            $(this).closest('#inputFormRaw').remove();
        });
        $("#selectStorage").on('change',function(){
            var value = this.value;
            if(value != ""){
                $("#addStorage").show();
                $("#addStorage").removeClass('sr-only');
            }else{
                $("#addStorage").hide();
                $("#addStorage").addClass('sr-only');
            }
        });


        $("#addStorage").click(function () {
            countRowStorage = countRowStorage + 1;
            var idram = $("#selectStorage").val();
            var html = '';
            html += '<div id="inputFormStorage">';
            html += '<div class="form-group mb-3">';
            html += '<div class="row">'
                html += '<div class="col-md-11">'
                    html += '<select name="storage[]" class="form-control select2">';
                    html += '<option>-- Pilih Storage --</option>'
                    html += '@foreach($storage as $item)'
                    html += '<option value="{{ $item->id }}">{{ $item->kodeInventaris }} | {{ $item->jenisStorage }} | {{ $item->namaStorage }} {{ $item->kapasitasStorage }}GB</option>';
                    html += '@endforeach'
                    html += '</select>'
                html += '</div>'
                html += '<div class="col-md-1">'
                html += '<button id="removeRam" type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>'
                html += '</div>'
            html += '</div>'
            html += '</div>';

            $("#newStorage").append(html);
            if (countRowStorage == 2) {
                $("#addStorage").hide();
            }else{
                $("#addStorage").show();
            }
            $('.select2').select2();
        });

        // remove row
        $(document).on('click', '#removeStorage', function () {
            countRowStorage = countRowStorage - 1;
            if (countRowStorage == 4) {
                $("#addStorage").hide();
            }else{
                $("#addStorage").show();
            }
            $(this).closest('#inputFormStorage').remove();
        });
    });

</script>
@endsection
