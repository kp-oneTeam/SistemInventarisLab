<div class="tab-pane fade" id="contact6" role="tabpanel" aria-labelledby="contact-tab3">
                                    <div class="table-responsive p-sm-1 mt-3">
                                        <table class="table table-striped" id="tablePsu">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" class="check-all-psu"></th>
                                                    <th>No</th>
                                                    <th>Kode Inventaris</th>
                                                    <th>Nama Psu</th>
                                                    <th>Form Factor</th>
                                                    <th>Jenis Kabel</th>
                                                    <th>Besar Daya</th>
                                                    <th>Sertifikasi Psu</th>
                                                    <th>Lokasi</th>
                                                    <th>Vendor</th>

                                                    <th>Tanggal Pembelian</th>
                                                    <th>Kondisi</th>

                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $no = 1;
                                                @endphp
                                                @foreach ($psu as $item)
                                                <tr>
                                                    <td width="1%"><input type="checkbox" class="checked-psu"> </td>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $item->kodeInventaris }}</td>
                                                    <td>{{ $item->namaPsu }}</td>
                                                    <td>{{ $item->formFactor }}</td>
                                                    <td>{{ $item->jenisKabel }}</td>
                                                    <td>{{ $item->besarDaya }}</td>
                                                    <td>{{ $item->sertifikasiPsu }}</td>
                                                    <td>{{ $item->kodeRuangan . " " . $item->namaRuangan }}</td>
                                                    <td>{{ $item->namaVendor }}</td>

                                                    <td>{{ date('Y', strtotime($item->tglPembelian)); }}</td>
                                                    <td>{{ $item->kondisi }}</td>

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
