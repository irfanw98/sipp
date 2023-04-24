<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Offset</title>
    <style>
        body {
            font-family: sans-serif;
        }

        h3 {
            text-align: center;
            font-size: 24px;
        }

        h4, .alamat {
            margin-top: -20px;
        }

        h4{
            text-align: center;
            font-size: 18px;
        }

        .alamat{
            text-align: center;
            font-size: 12px;
        }

        table {
            border-collapse: collapse;
        }

        thead{
            background-color: #C3CEF4;
        }
    </style>
</head>
<body>
    <h3>CV. TEGUH GEMILANG</h3>
    <h4>LAPORAN OFFSET</h4>
    <p class="alamat">Jl. Kanggraksan No.8, Harjamukti, Kec. Harjamukti, Kota Cirebon, Jawa Barat 45143</p>

    <hr>
    <table border="1" cellpadding="4" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Konsumen</th>
                <th>Nama File</th>
                <th>Jenis Bahan</th>
                <th>Jenis Mesin</th>
                <th>Qty</th>
                <th>Status</th>
            </tr>
        </thead>
        @foreach($offsets as $offset)
        <tbody>
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td>
                <td>{{ $offset['nama_konsumen'] }}</td>
                <td>{{ $offset['nama_file'] }}</td>
                <td>{{ $offset['jenis_bahan'] }}</td>
                <td>{{ $offset['jenis_mesin'] }}</td>
                <td style="text-align: center">{{ $offset['qty'] }}</td>
                <td style="text-align: center">{{ $offset['status_offset'] == '1' ? 'Selesai' : 'Proses'}}</td>
            </tr>
        </tbody>
        @endforeach
    </table>

    <table width="100%">
        <tr>
            <td></td>
            <td width="250px" style="padding-top: 20px;">
                <p>Cirebon, {{ $today }}<br>
                    Kepala Divisi Offset,</p>
                <br>
                <br>
                <br>
                <p>________________________</p>
            </td>
        </tr>
    </table>
</body>
</html>
