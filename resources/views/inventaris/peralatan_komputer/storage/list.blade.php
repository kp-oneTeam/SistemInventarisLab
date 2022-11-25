<div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab3">
                                    <div class="table-responsive p-sm-1 mt-3">
                                        <table class="table table-striped" id="tableStorage">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" class="check-all-storage"></th>
                                                    <th>No</th>
                                                    <th>Kode Inventaris</th>
                                                    <th>Nama Storage</th>
                                                    <th>Jenis Storage</th>
                                                    <th>Kapasitas Storage</th>
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
                                                @foreach ($storage as $item)
                                                <tr>
                                                    <td width="1%"><input type="checkbox" class="checked-storage"> </td>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $item->kodeInventaris }}</td>
                                                    <td>{{ $item->namaStorage }}</td>
                                                    <td>{{ $item->jenisStorage }}</td>
                                                    <td>{{ $item->kapasitasStorage }} GB</td>
                                                    <td>{{ $item->kodeRuangan . " " . $item->namaRuangan }}</td>
                                                    <td>{{ $item->namaVendor }}</td>

                                                    <td>{{ date('d-m-Y', strtotime($item->tglPembelian)); }}</td>
                                                    <td>{{ $item->kondisi }}</td>
                                                    <td>{{ $item->keterangan }}</td>
                                                    <td>
                                                        <form method="POST"
                                                            action="{{ url('hapus/inventaris-peralatan-komputer/storage/'.$item->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="{{ url('detail/inventaris-peralatan-komputer/storage/'.$item->id) }}"
                                                                class="btn btn-sm btn-icon icon-left btn-info mb-2"><i
                                                                    class="far fa-eye"></i> Detail</a>
                                                            @role('laboran')
                                                            <a href="{{ url('edit/inventaris-peralatan-komputer/storage/'.$item->id) }}"
                                                                class="btn btn-sm btn-icon icon-left btn-primary mb-2"><i
                                                                    class="far fa-edit"></i> Edit</a>
                                                            <button type="submit"
                                                                class="btn btn-icon btn-sm icon-left btn-danger show_confirm mb-2"
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
