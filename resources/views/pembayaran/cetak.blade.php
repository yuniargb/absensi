<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Cetak Pembayaran</title>

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
    <div>
        <table>
            <tbody>
                <tr>
                    <td colspan="3">

                    </td>
                    <td height="60" style="border:none !important; text-align:center;" align="center">
                        <!-- <img src="{{ url('images/logo.jpg') }}" width="80" height="60" alt="" style="text-align: center;"> -->
                    </td>
                    <td colspan="4">
                        <h1 class="text-center">Data Pembayaran</h1>

                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Siswa</th>
                    <th>Tanggal Transfer</th>
                    <th>Pembayaran Bulan</th>
                    <th>No Rek</th>
                    <!-- <th>Bukti</th> -->
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
                    <td>{{ $sw->tgl_transfer }}</td>
                    <td>{{ $sw->bulan }}</td>
                    <td>{{ $sw->no_rek }}</td>
                    <!-- <td>{{ $sw->bukti }}</td> -->
                    <td>{{ $sw->jumlah }}</td>
                    <td>{{ $sw->atm }}</td>
                    @php
                    if($sw->status == 0 )
                    $pesan = 'Menunggu Konfirmasi';

                    elseif($sw->status == 3)

                    $pesan = 'Pembayaran Di Tolak';

                    else

                    $pesan = 'Sudah Di Konfirmasi';
                    @endphp
                    <td>{{ $pesan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
