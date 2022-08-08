<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cetak</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        /* Style the header */
        .header {
            /* background-color: #f1f1f1;
            padding: 30px;
            text-align: center;
            font-size: 35px; */
            border: 1px solid black;
        }

        /* Container for flexboxes */
        .row {
            display: -webkit-flex;
            display: flex;
        }

        /* Create three equal columns that sits next to each other */
        .column {
            -webkit-flex: 1;
            -ms-flex: 1;
            flex: 1;
            padding: 10px;
            /* height: 300px; */
            font-size: 12px;
            margin-top: 10px;
            margin-bottom: 10px;
            /* Should be removed. Only for demonstration */
        }

        /* Style the footer */
        .footer {
            background-color: #f1f1f1;
            padding: 10px;
            text-align: center;
        }

        /* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
        @media (max-width: 600px) {
            .row {
                -webkit-flex-direction: column;
                flex-direction: column;
            }
        }
        table {
            border-collapse:separate;
            border-spacing: 0 1em;
        }
    </style>
</head>

<body>
    <div style="display: grid;grid-template-columns: auto auto;">
        @foreach ($data as $item)
        <div style="width: 458px;margin: 5px;">
            <div class="header" style="padding: 5px;">
                <img src="{{ asset('admin/img/header.svg') }}" alt="">
            </div>

            <div class="row" style="border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;">
                <div class="column">
                    <table>
                        <tr>
                            <td width="10%">Nama Barang </td>
                            <td width="1%">:</td>
                            <td width="20%">{{ $item->namaBarang }}</td>
                        </tr>
                        <tr>
                            <td width="15%">Tgl Pembelian </td>
                            <td width="1%">:</td>
                            <td width="30%">{{ date('d - F - Y', strtotime($item->tgl_pembelian)) }}</td>
                        </tr>
                        <tr>
                            <td width="35%">Nomor Barang </td>
                            <td width="1%">:</td>
                            <td width="50%">{{ $item->kodeInventaris }}</td>
                        </tr>
                    </table>
                </div>
                <div class="column" style="text-align: right;">
                    {!! QrCode::size(100)->generate('https://28e8-180-244-139-129.ap.ngrok.io/detail/inventaris/'.$item->kodeInventaris); !!}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</body>

</html>
