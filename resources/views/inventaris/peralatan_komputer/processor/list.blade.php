<div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                                    <div class="table-responsive p-sm-1 mt-3">
                                        <table class="table table-striped" id="tableProcessor">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" class="check-all-cpu"></th>
                                                    <th>No</th>
                                                    <th>Kode Inventaris</th>
                                                    <th>Nama Processor</th>
                                                    <th>Series - Nomor</th>
                                                    <th>Generasi</th>
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
                                                @foreach ($processor as $item)
                                                <tr>
                                                    <td width="1%"><input type="checkbox" class="checked-cpu"> </td>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $item->kodeInventaris }}</td>
                                                    <td>{{ $item->namaProcessor }}</td>
                                                    <td>{{ $item->series }} - {{ $item->nomorProcessor }}</td>
                                                    <td>{{ $item->generasi }}</td>
                                                    <td>{{ $item->namaRuangan }}</td>
                                                    <td>{{ $item->namaVendor }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($item->tglPembelian)); }}</td>
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
