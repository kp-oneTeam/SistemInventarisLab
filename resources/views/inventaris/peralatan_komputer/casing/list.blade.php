<div class="tab-pane fade" id="contact7" role="tabpanel" aria-labelledby="contact-tab3">
                                    <div class="table-responsive p-sm-1 mt-3">
                                        <table class="table table-striped" id="tableCasing">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" class="check-all-casing"></th>
                                                    <th>No</th>
                                                    <th>Kode Inventaris</th>
                                                    <th>Nama Casing</th>
                                                    <th>Form Faktor</th>
                                                    <th>Lokasi</th>
                                                    <th>Vendor</th>
                                                    <th>Tanggal Pembelian</th>
                                                    <th>Kondisi</th>
                                                    <th>Keterangan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $no = 1;
                                                @endphp
                                                @foreach ($casing as $item)
                                                <tr>
                                                    <td width="1%"><input type="checkbox" class="checked-casing"> </td>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $item->kodeInventaris }}</td>
                                                    <td>{{ $item->namaCasing }}</td>
                                                    <td>{{ $item->formFactor }}</td>
                                                    <td>{{ $item->kodeRuangan . " " . $item->namaRuangan }}</td>
                                                    <td>{{ $item->namaVendor }}</td>
                                                    <td>{{ date('Y', strtotime($item->tglPembelian)); }}</td>
                                                    <td>{{ $item->kondisi }}</td>
                                                    <td>{{ $item->keterangan }}</td>
                                                    <td>
                                                        <form method="POST"
                                                            action="{{ url('hapus/inventaris-peralatan-komputer/casing/'.$item->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="{{ url('detail/inventaris-peralatan-komputer/casing/'.$item->id) }}"
                                                                class="btn btn-sm btn-icon icon-left btn-info mb-2"><i
                                                                    class="far fa-eye"></i> Detail</a>
                                                            @role('laboran')
                                                            <a href="{{ url('edit/inventaris-peralatan-komputer/casing/'.$item->id) }}"
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
