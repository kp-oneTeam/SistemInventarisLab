<div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                                    <div class="table-responsive p-sm-1 mt-3">
                                        <table class="table table-striped" id="tableRam">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" class="check-all-ram"></th>
                                                    <th>No</th>
                                                    <th>Kode Inventaris</th>
                                                    <th>Nama Memori</th>
                                                    <th>Jenis Memori</th>
                                                    <th>Kapasitas Memori</th>
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
                                                @foreach ($ram as $item)
                                                <tr>
                                                    <td width="1%"><input type="checkbox" class="checked-ram"> </td>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $item->kodeInventaris }}</td>
                                                    <td>{{ $item->namaMemory }}</td>
                                                    <td>{{ $item->jenisMemory }}</td>
                                                    <td>{{ $item->kapasitasMemory }} GB</td>
                                                    <td>{{ $item->kodeRuangan . " " . $item->namaRuangan }}</td>
                                                    <td>{{ $item->namaVendor }}</td>

                                                    <td>{{ date('d-m-Y', strtotime($item->tglPembelian)); }}</td>
                                                    <td>{{ $item->kondisi }}</td>

                                                    <td>
                                                        <form method="POST"
                                                            action="{{ url('hapus/inventaris-peralatan-komputer/ram/'.$item->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="{{ url('detail/inventaris-peralatan-komputer/ram/'.$item->id) }}"
                                                                class="btn btn-sm btn-icon icon-left btn-info mb-2"><i
                                                                    class="far fa-eye"></i> Detail</a>
                                                            <a href="{{ url('edit/inventaris-peralatan-komputer/ram/'.$item->id) }}"
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
