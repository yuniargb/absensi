<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Laporan RPP & Silabus</title>
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
    <table border="0">
        <tr>
            <th>Sekolah</th>
            <td>:</td>
            <td>{{ $logo->namasekolah }}</td>
        </tr>
        <tr>
            <th>Mata Pelajaran</th>
            <td>:</td>
            <td>{{ $rds->namamapel }}</td>
        </tr>
        <tr>
            <th>Kelas/Semester</th>
            <td>:</td>
            <td>{{ $rds->kelas }}/{{ $rds->semester }}</td>
        </tr>
        <tr>
            <th>Alokasi Waktu</th>
            <td>:</td>
            <td>{{ $rds->alokasi_waktu }}</td>
        </tr>
    </table>
    <div class="mt-3">
        <ol type="A" class="li-cus">
            <li>
                <b>Kompetensi Inti</b>
                <div>
                    <p>KI.1. Menghargai dan menghayati ajaran agama yang dianutnya</p>
                    <p>KI.2. Menghargai dan menghayati perilaku jujur, disiplin,tanggungjawab, peduli (toleransi, gotong
                        royong), santun, percaya diri, dalam berinteraksi secara efektif dengan lingkungan sosial dan
                        alam
                        dalam
                        jangkauan pergaulan dan keberadaannya</p>
                    <p>KI.3. Memahami pengetahuan (faktual, konseptual, dan prosedural) berdasarkan rasa ingin tahunya
                        tentang
                        ilmu pengetahuan, teknologi, seni, budaya terkait fenomena dan kejadian tampak mata </p>
                    <p>KI.4. Mencoba, mengolah, dan menyaji dalam ranah konkret (menggunakan, mengurai, merangkai,
                        memodifikasi,
                        dan membuat) dan ranah abstrak (menulis, membaca, menghitung, menggambar, dan mengarang) sesuai
                        dengan
                        yang dipelajari di sekolah dan sumber lain yang sama dalam sudut pandang/teori </p>
                </div>
            </li>
            <li>
                <b>Kompetensi Dasar</b>
                <div>
                    {!! $rds->kompetensi_dasar !!}
                </div>
            </li>
            <li>
                <b>Indikator Pencapaian Kompetensi</b>
                <div>
                    {!! $rds->indikator_pencapaian_kompetensi !!}
                </div>
            </li>
            <li>
                <b>Materi Pembelajaran</b>
                <div>
                    {!! $rds->materi_pembelajaran !!}
                </div>
            </li>
            <li>
                <b>Kegiatan Pembelajaran</b>
                <div>
                    {!! $rds->kegiatan_pembelajaran !!}
                </div>
            </li>
            <li>
                <b>Penilaian, Pembelajaran dan Remedial</b>
                <div>
                    {!! $rds->ppr !!}
                </div>
            </li>
            <li>
                <b>Media</b>
                <div>
                    {!! $rds->media !!}
                </div>
            </li>
        </ol>
    </div>
</body>

</html>
