<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Laporan Presensi Guru</title>
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
    <h6 class="text-center">Laporan Presensi Guru</h6>

    <table border="1" class="table table-bordered table-condensed">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jam Masuk</th>
                <th>Jam Pulang</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensi as $sw)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $sw->tgl_absen }}</td>
                <td>{{ $sw->nip }}</td>
                <td>{{ $sw->nama }}</td>
                <td>{{ $sw->jam_masuk }}</td>
                <td>{{ $sw->jam_pulang }}</td>
                <td>{{ $sw->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
