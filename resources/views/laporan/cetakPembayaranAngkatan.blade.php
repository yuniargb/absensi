<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Laporan Pembayaran</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="/assets/img/icon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        /* @page {
            @bottom-right {
                content: counter(page) " of "counter(pages);
            }
        } */

        table.table {
            font-size: 12 px;
        }

    </style>
</head>

<body>
    <h6 class="text-center">{{ $logo->namasekolah }}</h6>
    <h6 class="text-center">{{ $logo->alamat }}</h6>
    <h6 class="text-center">Laporan Pembayaran</h6>
    <h6 class="text-center">{{ $bulan.' - '.$angkatan->angkatan }} </h6>

    <table border="1" class="table table-bordered table-condensed">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Siswa</th>
                <th>Kelas</th>
                <th>Tanggal Transfer</th>
                <th>Pembayaran Bulan</th>
                <th>Tipe</th>
                <th>Jumlah Transfer</th>
                <th>Bank Transfer</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembayaran as $sw)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $sw->nis }}</td>
                <td>{{ $sw->nama }}</td>
                <td>{{ $sw->namaKelas }}</td>
                <td>{{ $sw->tgl_transfer }}</td>
                <td>{{ $sw->bulan }}</td>
                <td>{{ $sw->namatipe }}</td>
                <td>{{ $sw->jumlah }}</td>
                <td>{{ $sw->atm }}</td>
                @php
                if($sw->status == 0 )
                $pesan = '<span class="badge badge-danger">Menunggu Konfirmasi</span>';

                elseif($sw->status == 3)

                $pesan = '<span class="badge badge-danger">Pembayaran Di Tolak</span>';

                else

                $pesan = '<span class="badge badge-success">Sudah Di Konfirmasi</span>';
                @endphp
                <td>{!! $pesan !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
