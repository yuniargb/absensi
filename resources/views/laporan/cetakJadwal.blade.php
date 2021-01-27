<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Laporan Jadwal</title>
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
    <h3 class="text-center">{{ $logo->namasekolah }}</h3>
    <h4 class="text-center text-uppercase">Laporan Jadwal</h4>
    <h6 class="text-center text-uppercase">Kelas : {{ $kelas->namaKelas }} - Angkatan : {{ $tahun_ajaran }}</h6>
    <p class="text-center">{{ $logo->alamat }}</p>

    <table border="1" class="table table-bordered table-condensed">
        <thead>
            <tr>
                <th>No</th>
                <th>Guru</th>
                <th>Mata Pelajaran</th>
                <th>Kelas</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>SKS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwal as $sw)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $sw->nama }}</td>
                <td>{{ $sw->namamapel }}</td>
                <td>{{ $sw->namaKelas }}</td>
                <td>{{ $sw->hari }}</td>
                <td>{{ $sw->jam }}</td>
                <td>{{ $sw->jumlahjam }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
