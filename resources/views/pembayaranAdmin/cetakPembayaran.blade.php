<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Cetak Pembayaran</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="card">
        <div class="card-header">
            Bukti Pembayaran {{ $pembayaran->namatipe }}
        </div>
        <div class="card-body pt-5">
            <table>
                <tr>
                    <td>
                        NIS
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        {{ $pembayaran->nis }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Nama
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        {{ $pembayaran->nama }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Tanggal Transfer
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        {{ $pembayaran->tgl_transfer }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Bulan
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        {{ $pembayaran->bulan }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Nomor Rekening
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        {{ $pembayaran->no_rek }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Jumlah
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        {{ $pembayaran->jumlah }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Atm
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        {{ $pembayaran->atm }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Status
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        @php
                        if($pembayaran->status == 0 )
                        $pesan = '<span class="badge badge-danger">Menunggu Konfirmasi</span>';

                        elseif($pembayaran->status == 3)

                        $pesan = '<span class="badge badge-danger">Pembayaran Di Tolak</span>';

                        else

                        $pesan = '<span class="badge badge-success">Sudah Di Konfirmasi</span>';
                        @endphp
                        {!! $pesan !!}
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="float-right">Tangerang, {{ date('d-m-Y') }}</div>
    <div class="clearfix"></div>

</body>

</html>
