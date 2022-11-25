@php
function format_hari_tanggal($waktu)
{
    $hari_array = array(
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu'
    );
    $hr = date('w', strtotime($waktu));
    $hari = $hari_array[$hr];
    $tanggal = date('j', strtotime($waktu));
    $bulan_array = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    );
    $bl = date('n', strtotime($waktu));
    $bulan = $bulan_array[$bl];
    $tahun = date('Y', strtotime($waktu));
    $jam = date( 'H:i:s', strtotime($waktu));

    //untuk menampilkan hari, tanggal bulan tahun jam
    //return "$hari, $tanggal $bulan $tahun $jam";

    //untuk menampilkan hari, tanggal bulan tahun
    return "$hari, $tanggal $bulan $tahun";
}
@endphp
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
        body{
            font-family: 'Times New Roman'
        }
    </style>

</head>

<body>
    <table class="table">
        <tr>
            <td rowspan="5" class="text-center" width="10%"><img src="{{ asset('admin/img/logo-unjani.png') }}" alt=""
                    width="100px" height="100px"></td>
            <td colspan="3" class="text-center" style="font-size: 30px"><b>{{ strtoupper($title) }}</b></td>

            <td rowspan="5" class="text-center" width="10%"><img src="{{ asset('admin/img/logo_if.png   ') }}" alt=""
                    width="100px" height="100px"></td>
        </tr>
        <tr>
            <td colspan="3" class="text-center" style="border-top: 1px solid black;border-bottom: 0px;">JURUSAN TEKNIK INFORMATIKA</td>
        </tr>
        <tr>
            <td colspan="3" class="text-center" style="border: 0px">FAKULTAS SAINS DAN INFORMATIKA</td>
        </tr>
        <tr>
            <td colspan="3" class="text-center" style="border: 0px">UNIVERSITAS JENDERAL ACHMAD YANI (UNJANI)</td>
        </tr>
        <tr>
            @php
                $periode = ($dari_tanggal ?? "-");
            @endphp
            @php
            $today = \Carbon\Carbon::now('Asia/Jakarta')->isoFormat('dddd, D MMMM Y');
        @endphp

            @if ($periode == "-")
            <td class="text-center">PERIODE : -</td>
            @else
            <td class="text-center">PERIODE : {{format_hari_tanggal($dari_tanggal).' s/d '.format_hari_tanggal($sampai_tanggal) }}</td>
            @endif
            <td class="text-center">TANGGAL CETAK : {{ $today }}</td>
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
            @if ($title == ("Data Inventaris Non Komputer"))
                @forelse ($data as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->kodeInventaris }}</td>
                    <td>{{ $item->namaBarang }}</td>
                    <td>{{ $item->merk }}</td>
                    <td>{{ $item->spesifikasi }}</td>
                    <td>{{ $item->namaVendor }}</td>
                    <td>{{ $item->kodeRuangan." | ".$item->namaRuangan }}</td>
                    <td>{{ format_hari_tanggal($item->tgl_pembelian) }}</td>
                    <td>{{ $item->kondisi }}</td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" align="center">Data Kosong</td>
                </tr>
                @endforelse
            @elseif($title == "Data Inventaris Peralatan Komputer")
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
                    <td>{{ format_hari_tanggal($item->tglPembelian ) }}</td>
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
                    <td>{{ format_hari_tanggal($item->tglPembelian ) }}</td>
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
                    <td>{{ format_hari_tanggal($item->tglPembelian ) }}</td>
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
                    <td>{{ format_hari_tanggal($item->tglPembelian ) }}</td>
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
                    <td>{{ format_hari_tanggal($item->tglPembelian ) }}</td>
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
                    <td>{{ format_hari_tanggal($item->tglPembelian ) }}</td>
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
                    <td>{{ format_hari_tanggal($item->tglPembelian ) }}</td>
                    <td>{{ $item->kondisi }}</td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
                @endforeach
            @elseif($title == "Data Inventaris Komputer")
             @forelse ($komputer as $item)
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
                    <td>{{ format_hari_tanggal($item->tanggal_perakitan) }}</td>
                    <td>{{ $item->kondisi }}</td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" align="center">Data Kosong</td>
                </tr>
                @endforelse
            @else
                @foreach ($data as $item)
                <tr class="text-center">
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->kodeInventaris }}</td>
                    <td>{{ $item->namaBarang }}</td>
                    <td>{{ $item->merk }}</td>
                    <td>{{ $item->spesifikasi }}</td>
                    <td>{{ $item->namaVendor }}</td>
                    <td>{{ $item->kodeRuangan." | ".$item->namaRuangan }}</td>
                    <td>{{ format_hari_tanggal($item->tgl_pembelian) }}</td>
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
                    <td>{{ format_hari_tanggal($item->tglPembelian ) }}</td>
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
                    <td>{{ format_hari_tanggal($item->tglPembelian ) }}</td>
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
                    <td>{{ format_hari_tanggal($item->tglPembelian ) }}</td>
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
                    <td>{{ format_hari_tanggal($item->tglPembelian ) }}</td>
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
                    <td>{{ format_hari_tanggal($item->tglPembelian ) }}</td>
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
                    <td>{{ format_hari_tanggal($item->tglPembelian ) }}</td>
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
                    <td>{{ format_hari_tanggal($item->tglPembelian ) }}</td>
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
                    <td>{{ format_hari_tanggal($item->tanggal_perakitan) }}</td>
                    <td>{{ $item->kondisi }}</td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>

</html>
