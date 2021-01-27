@extends('layout')
@section('title', 'Laporan Data Pembayaran Persiswa')
@section('content')
<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Laporan Pembayaran Persiswa</div>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                    <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel"
                        aria-labelledby="pills-home-tab-nobd">
                        <div class="col-md-12">
                            <form action="/cetaklaporanpembayaranangkatan" class="form-row" id="pembayaranForm"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group col-md-6">
                                    <label for="nis">Bulan Dari</label>
                                    <select class="form-control" name="bulanFrom" id="bulanFrom">
                                        <option value="1"
                                            {{ $req == null ? "" : $req->bulanFrom == 1 ? "selected" : "" }}>
                                            Januari</option>
                                        <option value="2"
                                            {{ $req == null ? "" : $req->bulanFrom == 2 ? "selected" : "" }}>
                                            Februari</option>
                                        <option value="3"
                                            {{ $req == null ? "" : $req->bulanFrom == 3 ? "selected" : "" }}>
                                            Maret
                                        </option>
                                        <option value="4"
                                            {{ $req == null ? "" : $req->bulanFrom == 4 ? "selected" : "" }}>April
                                        </option>
                                        <option value="5"
                                            {{ $req == null ? "" : $req->bulanFrom == 5 ? "selected" : "" }}>Mei
                                        </option>
                                        <option value="6"
                                            {{ $req == null ? "" : $req->bulanFrom == 6 ? "selected" : "" }}>Juni
                                        </option>
                                        <option value="7"
                                            {{ $req == null ? "" : $req->bulanFrom == 7 ? "selected" : "" }}>Juli
                                        </option>
                                        <option value="8"
                                            {{ $req == null ? "" : $req->bulanFrom == 8 ? "selected" : "" }}>
                                            Agustus
                                        </option>
                                        <option value="9"
                                            {{ $req == null ? "" : $req->bulanFrom == 9 ? "selected" : "" }}>
                                            September</option>
                                        <option value="10"
                                            {{ $req == null ? "" : $req->bulanFrom == 10 ? "selected" : "" }}>
                                            Oktober
                                        </option>
                                        <option value="11"
                                            {{ $req == null ? "" : $req->bulanFrom == 11 ? "selected" : "" }}>
                                            November</option>
                                        <option value="12"
                                            {{ $req == null ? "" : $req->bulanFrom == 12 ? "selected" : "" }}>
                                            Desember
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tahun">Tahun Dari</label>
                                    <select class="form-control" name="tahunFrom" id="tahunFrom" required>
                                        @php
                                        $tahun = (int)date('Y');
                                        $akhir = $tahun + 20;
                                        @endphp
                                        @for($i=$tahun; $akhir >= $i;$i++)<option value="{{ $tahun }}"
                                            {{ $req == null ? "" : $req->tahunFrom == $tahun ? "selected" : "" }}>
                                            {{ $tahun }}
                                        </option>
                                        @php $tahun-- @endphp
                                        @endfor

                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nis">Bulan Dari</label>
                                    <select class="form-control" name="bulanTo" id="bulanTo">
                                        <option value="1"
                                            {{ $req == null ? "" : $req->bulanTo == 1 ? "selected" : "" }}>
                                            Januari</option>
                                        <option value="2"
                                            {{ $req == null ? "" : $req->bulanTo == 2 ? "selected" : "" }}>
                                            Februari</option>
                                        <option value="3"
                                            {{ $req == null ? "" : $req->bulanTo == 3 ? "selected" : "" }}>
                                            Maret
                                        </option>
                                        <option value="4"
                                            {{ $req == null ? "" : $req->bulanTo == 4 ? "selected" : "" }}>April
                                        </option>
                                        <option value="5"
                                            {{ $req == null ? "" : $req->bulanTo == 5 ? "selected" : "" }}>Mei
                                        </option>
                                        <option value="6"
                                            {{ $req == null ? "" : $req->bulanTo == 6 ? "selected" : "" }}>Juni
                                        </option>
                                        <option value="7"
                                            {{ $req == null ? "" : $req->bulanTo == 7 ? "selected" : "" }}>Juli
                                        </option>
                                        <option value="8"
                                            {{ $req == null ? "" : $req->bulanTo == 8 ? "selected" : "" }}>
                                            Agustus
                                        </option>
                                        <option value="9"
                                            {{ $req == null ? "" : $req->bulanTo == 9 ? "selected" : "" }}>
                                            September</option>
                                        <option value="10"
                                            {{ $req == null ? "" : $req->bulanTo == 10 ? "selected" : "" }}>
                                            Oktober
                                        </option>
                                        <option value="11"
                                            {{ $req == null ? "" : $req->bulanTo == 11 ? "selected" : "" }}>
                                            November</option>
                                        <option value="12"
                                            {{ $req == null ? "" : $req->bulanTo == 12 ? "selected" : "" }}>
                                            Desember
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tahun">Tahun Sampai</label>
                                    <select class="form-control" name="tahunTo" id="tahunTo" required>
                                        @php
                                        $tahun = (int)date('Y');
                                        $akhir = $tahun + 20;
                                        @endphp
                                        @for($i=$tahun; $akhir >= $i;$i++)<option value="{{ $tahun }}"
                                            {{ $req == null ? "" : $req->tahunTo == $tahun ? "selected" : "" }}>
                                            {{ $tahun }}
                                        </option>
                                        @php $tahun-- @endphp
                                        @endfor

                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="nis">Kelas</label>
                                    <select class="form-control" name="kelas" id="bulan">
                                        @foreach($kelas as $k)
                                        <option value="{{ $k->id }}"
                                            {{ $req == null ? "" : $req->kelas == $k->id ? "selected" : "" }}>
                                            {{ $k->namaKelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="siswa_id">Siswa</label>
                                    <select class="select2 form-control w-100" name="siswa_id" id="siswa_id" required>
                                        <option value="" disabled>Pilih Siswa</option>
                                        @foreach($siswa as $sw)
                                        <option value="{{ $sw->id }}">{{ $sw->nama }} ( {{ $sw->nis }} )</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="tipe_pembayaran_id">Tipe Pembayaran</label>
                                    <select class="form-control" name="tipe_pembayaran_id" id="tipe_pembayaran_id" required>
                                        @foreach($tipe as $sw)
                                        <option value="{{ $sw->id }}">{{ $sw->namatipe }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="modal-footer col-md-12">

                                    <button name="submit" type="submit" class="btn btn-success"
                                        value="read">Tampil</button>
                                    <button name="submit" type="submit" class="btn btn-info" value="csv">Download
                                        CSV</button>
                                    <button name="submit" type="submit" class="btn btn-primary" value="pdf">Download
                                        PDF</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(!empty($pembayaran))
        <div class="card mb-4 mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Table Pembayaran Angkatan</h6>
            </div>
            <div class="card-body">
                <table border="1" class="table table-bordered table-condensed table basic-datatables">
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
                <hr>
            </div>
        </div>
        @endif
        <!-- Bar Chart -->
        <div class="card mb-4 mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Diagram Pembayaran Angkatan</h6>
            </div>
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="myBarChart" data-x="{{ json_encode($x) }}" data-y="{{ json_encode($y) }}"></canvas>
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>
@stop
