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

        body {
            font-family: 'Times New Roman'
        }
    </style>

</head>

<body>
    <table class="table">
        <tr>
            <td rowspan="5" class="text-center" width="10%"><img src="{{ asset('admin/img/logo-unjani.png') }}" alt=""
                    width="100px" height="100px"></td>
            <td colspan="3" class="text-center" style="font-size: 30px"><b>{{ strtoupper("Laporan Peminjaman Inventaris") }}</b></td>

            <td rowspan="5" class="text-center" width="10%"><img src="{{ asset('admin/img/logo_if.png   ') }}" alt=""
                    width="100px" height="100px"></td>
        </tr>
        <tr>
            <td colspan="3" class="text-center" style="border-top: 1px solid black;border-bottom: 0px;">JURUSAN TEKNIK
                INFORMATIKA</td>
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
            <td class="text-center">PERIODE : {{format_hari_tanggal($dari_tanggal).' s/d
                '.format_hari_tanggal($sampai_tanggal) }}</td>
            @endif
            <td class="text-center">TANGGAL CETAK : {{ $today }}</td>
        </tr>
    </table>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>No Identitas Peminjam(NIM/NID/NIP)</th>
                <th>Nama Peminjam</th>
                <th>Barang Yang Dipinjam</th>
                <th>Tujuan Peminjaman</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach($data as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->noIdentitas }}</td>
                <td>{{ $item->namaPeminjam }}</td>
                <td>
                    {{-- <ul> --}}
                        @foreach ($item->detail_peminjaman($item->id) as $pinjaman)
                        <li>
                            @if ($pinjaman->inventaris($pinjaman->idInventaris) == "0")
                            Inventaris Dihapus
                            @else
                            {{ $pinjaman->inventaris($pinjaman->idInventaris)->kodeInventaris }} -
                            {{ $pinjaman->inventaris($pinjaman->idInventaris)->barang->namaBarang }} -
                            {{ $pinjaman->inventaris($pinjaman->idInventaris)->spesifikasi }}
                            @endif
                        </li>
                        @endforeach
                        {{--
                    </ul> --}}
                </td>
                <td>{{ $item->tujuanPeminjaman }}</td>
                <td>{{ date('d-m-Y', strtotime($item->tglPeminjaman)); }}</td>
                @if ($item->tglKembali == null)
                <td>-</td>
                @else
                <td>{{ date('d-m-Y', strtotime($item->tglKembali)); }}</td>
                @endif
                <td>{{ $item->status }}</td>
                @role('laboran')
                <td>
                    <form method="POST" action="{{ url('hapus/peminjaman/'.$item->id) }}">
                        @csrf
                        @method('DELETE')
                        @if ($item->status != "Sudah dikembalikan")
                        <a href="{{ url('pengembalian/'.$item->id) }}"
                            class="btn btn-sm btn-icon icon-left btn-primary mb-2" data-toggle="tooltip"
                            title="Pengembalian Barang">
                            <i class="fas fa-undo"></i>Pengembalian
                        </a>
                        @endif
                        @if ($item->status == "Sudah dikembalikan")
                        <button type="submit" class="btn btn-icon btn-sm icon-left btn-danger show_confirm  mb-2"
                            data-toggle="tooltip" title='Hapus Data'><i class="fas fa-trash"></i>Hapus</button>
                        @endif
                    </form>
                </td>
                @endrole
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="display: flex;justify-content: end;margin-top: 50px;font-size: 25px">
        Cimahi,{{ $today }}
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        {{ Auth::user()->nama }}
    </div>
</body>

</html>
