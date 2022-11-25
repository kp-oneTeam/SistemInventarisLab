<div class="tab-pane fade show {{ request()->is('inventaris/komputer') ? 'active' : null }}" id="{{ url('inventaris/komputer') }}" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-warning">Data Inventaris Komputer</h4>
                            <div class="card-header-form">
                                @role('laboran')
                                <form>
                                    <div class="input-group">
                                        <a href="{{ url('tambah/inventaris_komputer') }}" class="btn btn-warning mr-2"
                                            class="btn btn-primary">Tambah Data</a>
                                    </div>
                                </form>
                                @endrole
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="float-right mb-2">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <form target="_blank" id="formCetak3" action="{{ url('checked/inventaris/peralatan-komputer/') }}" method="post">
                                        @csrf

                                        <button name="button" value="cetak" type="submit"
                                            class="btn btn-primary icon-left text-white"><i class="fas fa-print"></i>
                                            &nbsp; Cetak QR</button>
                                        @role('laboran')
                                        <button name="button" value="hapus" type="submit"
                                            class="btn btn-danger icon-left text-white"><i class="fas fa-trash"></i>
                                            &nbsp; Hapus</button>
                                        @endrole
                                    </form>
                                </div>
                            </div>
                            <form action="{{ url('laporan/print') }}" method="post">
                                @csrf
                                <div class="input-group">
                                    <div class="form-group">
                                        <input type="hidden" name="jenis_laporan" value="inventaris komputer">
                                        <button type="submit" class="btn btn-danger btn-icon icon-left float-right m-2"><i class="fas fa-print"></i>Cetak Data</button>
                                    </div>
                                </div>
                            </form>
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
                                            <th>Kondisi</th>
                                            <th>Keterangan</th>
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
                                            <td>{{ $item->keterangan }}</td>
                                            <td>
                                                <form method="POST" action="{{ url('hapus/inventaris_komputer/'.$item->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ url('detail/inventaris_komputer/'.$item->id) }}"
                                                        class="btn btn-sm btn-icon icon-left btn-info mb-2"><i
                                                            class="far fa-eye"></i> Detail</a>
                                                    @role('laboran')
                                                    <a href="{{ url('edit/inventaris_komputer/'.$item->id) }}"
                                                        class="btn btn-sm btn-icon icon-left btn-primary mb-2"><i
                                                            class="far fa-edit"></i> Edit</a>
                                                    <button type="submit"
                                                        class="btn btn-icon btn-sm icon-left btn-danger show_confirm"
                                                        data-toggle="tooltip" title='Hapus'><i
                                                            class="fas fa-trash"></i>Hapus</button>
                                                    @endrole
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
        </div>
