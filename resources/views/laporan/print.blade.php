<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        h1 {
            font-weight: bold;
            font-size: 20pt;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th {
            padding: 8px 8px;
            border: 1px solid #000000;
            text-align: center;
        }

        .table td {
            padding: 3px 3px;
            border: 1px solid #000000;
        }

        .text-center {
            text-align: center;
        }
    </style>

</head>

<body>
    <table class="table">
        <tr>
            <td rowspan="3" class="text-center" width="10%"><img src="{{ asset('admin/img/logo-unjani.png') }}" alt=""
                    width="100px" height="100px"></td>
            <td colspan="2" class="text-center">UNIVERSITAS JENDERAL ACHMAD YANI (UNJANI)</td>
            <td rowspan="3" class="text-center" width="10%"><img src="{{ asset('admin/img/logo_if.png   ') }}" alt=""
                    width="100px" height="100px"></td>
        </tr>
        <tr>
            <td colspan="2" class="text-center">{{ strtoupper($title) }}</td>
        </tr>
        <tr>
            <td class="text-center">PERIODE</td>
            <td class="text-center" width="30%">{{ $dari_tanggal }} - {{ $sampai_tanggal }}</td>
        </tr>
    </table>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Inventaris</th>
                <th>Jenis</th>
                <th>Nama/Merk</th>
                <th>Spesifikasi</th>
                <th>Vendor</th>
                <th>Lokasi</th>
                <th>Tanggal</th>
                <th>Kondisi</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach ($data as $item)
            <tr class="text-center">
                <td>{{ $no++ }}</td>
                <td>{{ $item->kodeInventaris }}</td>
                <td>{{ $item->namaBarang }}</td>
                <td>{{ $item->merk }}</td>
                <td>{{ $item->spesifikasi }}</td>
                <td>{{ $item->namaVendor }}</td>
                <td>{{ $item->kodeRuangan." | ".$item->namaRuangan }}</td>
                <td>{{ $item->tgl_pembelian }}</td>
                <td>{{ $item->kondisi }}</td>
                <td>{{ $item->keterangan }}</td>
            </tr>
            @endforeach
            @foreach ($motherboard as $item)
            <tr class="text-center">
                <td>{{ $no++ }}</td>
                <td>{{ $item->kodeInventaris }}</td>
                <td>Motherboard</td>
                <td>{{ $item->namaMotherboard }}</td>
                <td>{{ $item->chipsetMotherboard }} - {{ $item->socketMotherboard }} - {{ $item->formFactor }} - {{
                    $item->memoriSlot }} Slot Memory - {{ $item->memoriSupport }}</td>
                <td>{{ $item->namaVendor }}</td>
                <td>{{ $item->kodeRuangan." | ".$item->namaRuangan }}</td>
                <td>{{ $item->tglPembelian }}</td>
                <td>{{ $item->kondisi }}</td>
                <td>{{ $item->keterangan }}</td>
            </tr>
            @endforeach
            @foreach ($processor as $item)
            <tr class="text-center">
                <td>{{ $no++ }}</td>
                <td>{{ $item->kodeInventaris }}</td>
                <td>Processor</td>
                <td>{{ $item->namaProcessor }}</td>
                <td>{{ $item->series }} - {{ $item->nomorProcessor }} - Gen {{ $item->generasi }} - {{ $item->kecepatan
                    }} Ghz - {{ $item->jumlahCore }}C/{{ $item->jumlahCore }}T</td>
                <td>{{ $item->namaVendor }}</td>
                <td>{{ $item->kodeRuangan." | ".$item->namaRuangan }}</td>
                <td>{{ $item->tglPembelian }}</td>
                <td>{{ $item->kondisi }}</td>
                <td>{{ $item->keterangan }}</td>
            </tr>
            @endforeach
            @foreach ($ram as $item)
            <tr class="text-center">
                <td>{{ $no++ }}</td>
                <td>{{ $item->kodeInventaris }}</td>
                <td>RAM</td>
                <td>{{ $item->namaMemory }}</td>
                <td>{{ $item->jenisMemory }} - PC{{ $item->tipeMemory }} - {{ $item->kapasitasMemory }}GB - {{
                    $item->frekuensiMemory }}Mhz</td>
                <td>{{ $item->namaVendor }}</td>
                <td>{{ $item->kodeRuangan." | ".$item->namaRuangan }}</td>
                <td>{{ $item->tglPembelian }}</td>
                <td>{{ $item->kondisi }}</td>
                <td>{{ $item->keterangan }}</td>
            </tr>
            @endforeach
            @foreach ($storage as $item)
            <tr class="text-center">
                <td>{{ $no++ }}</td>
                <td>{{ $item->kodeInventaris }}</td>
                <td>Storage</td>
                <td>{{ $item->namaStorage }}</td>
                <td>{{ $item->jenisStorage }} - {{ $item->kapasitasStorage }}{{ $item->jenisKapasitasStorage }}</td>
                <td>{{ $item->namaVendor }}</td>
                <td>{{ $item->kodeRuangan." | ".$item->namaRuangan }}</td>
                <td>{{ $item->tglPembelian }}</td>
                <td>{{ $item->kondisi }}</td>
                <td>{{ $item->keterangan }}</td>
            </tr>
            @endforeach
            @foreach ($gpu as $item)
            <tr class="text-center">
                <td>{{ $no++ }}</td>
                <td>{{ $item->kodeInventaris }}</td>
                <td>GPU</td>
                <td>{{ $item->namaGpu }}</td>
                <td>{{ $item->ukuranMemori }}GB - {{ $item->tipeMemori }}</td>
                <td>{{ $item->namaVendor }}</td>
                <td>{{ $item->kodeRuangan." | ".$item->namaRuangan }}</td>
                <td>{{ $item->tglPembelian }}</td>
                <td>{{ $item->kondisi }}</td>
                <td>{{ $item->keterangan }}</td>
            </tr>
            @endforeach
            @foreach ($psu as $item)
            <tr class="text-center">
                <td>{{ $no++ }}</td>
                <td>{{ $item->kodeInventaris }}</td>
                <td>PSU</td>
                <td>{{ $item->namaPsu }}</td>
                <td>{{ $item->formFactor }} - {{ $item->jenisKabel }} - {{ $item->besarDaya }}WATT - {{
                    $item->sertifikasiPsu }}</td>
                <td>{{ $item->namaVendor }}</td>
                <td>{{ $item->kodeRuangan." | ".$item->namaRuangan }}</td>
                <td>{{ $item->tglPembelian }}</td>
                <td>{{ $item->kondisi }}</td>
                <td>{{ $item->keterangan }}</td>
            </tr>
            @endforeach
            @foreach ($casing as $item)
            <tr class="text-center">
                <td>{{ $no++ }}</td>
                <td>{{ $item->kodeInventaris }}</td>
                <td>Casing</td>
                <td>{{ $item->namaCasing }}</td>
                <td>{{ $item->formFactor }}</td>
                <td>{{ $item->namaVendor }}</td>
                <td>{{ $item->kodeRuangan." | ".$item->namaRuangan }}</td>
                <td>{{ $item->tglPembelian }}</td>
                <td>{{ $item->kondisi }}</td>
                <td>{{ $item->keterangan }}</td>
            </tr>
            @endforeach
            @foreach ($komputer as $item)
            <tr class="text-center">
                <td>{{ $no++ }}</td>
                <td>{{ $item->kodeInventarisKomputer }}</td>
                <td>Komputer</td>
                <td>-</td>
                <td>{{ $item->motherboard->namaMotherboard }} {{ $item->motherboard->chipsetMotherboard }} -
                    {{ $item->processor->namaProcessor }} {{ $item->processor->series }} {{
                    $item->processor->nomorProcessor }} -
                    @foreach ($item->ram($item->id) as $value)
                    ({{ $value->rams->namaMemory }} {{ $value->rams->jenisMemory }} {{ $value->rams->kapasitasMemory
                    }}GB {{ $value->rams->frekuensiMemory }}Hz)
                    @endforeach
                    -
                    @foreach ($item->storage($item->id) as $value)
                    ({{ $value->storage->namaStorage }} {{ $value->storage->jenisStorage }} {{
                    $value->storage->kapasitasStorage }}{{ $value->jenisKapasitasStorage }})
                    @endforeach
                    -
                    {{ $item->gpu->namaGpu }} {{ $item->gpu->tipeMemori }} {{ $item->gpu->ukuranMemori }}GB
                    -
                    {{ $item->psu->namaPsu }} {{ $item->psu->jenisKabel }} {{ $item->psu->besarDaya }}W {{
                    $item->psu->sertifikasiPsu }}
                    -
                    {{ $item->casing->namaCasing }}</td>

                <td>{{ $item->namaVendor }}</td>
                <td>{{ $item->ruangan->kodeRuangan." | ".$item->ruangan->namaRuangan }}</td>
                <td>{{ $item->tanggal_perakitan }}</td>
                <td>{{ $item->kondisi }}</td>
                <td>{{ $item->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
