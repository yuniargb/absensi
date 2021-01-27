@extends('layout')
@section('title', 'Laporan Data Penilaian')
@section('content')
<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Laporan Penilaian</div>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                    <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel"
                        aria-labelledby="pills-home-tab-nobd">
                        <div class="col-md-12">
                            <form action="/cetaklaporanpenilaian" id="pembayaranForm" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="tahun_ajaran">Tahun Ajaran</label>
                                    <select class="form-control" name="tahun_ajaran" id="tahun_ajaran" required>
                                        @php
                                        $tahun = (int)date('Y');
                                        $akhir = $tahun + 20;
                                        @endphp
                                        @for($i=$tahun; $akhir >= $i;$i++) @php $next=$tahun + 1 @endphp <option
                                            value="{{ $tahun .'/'. $next }}"
                                            {{ $req == null ? '' : $req->tahun_ajaran == $tahun .'/'. $next ? "selected" : "" }}>
                                            {{ $tahun .'/'. $next }}
                                        </option>
                                        @php $tahun-- @endphp
                                        @endfor

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="semester">Semester</label>
                                    <select class="form-control" name="semester" id="semester" required>
                                        <option value="Ganjil"
                                            {{ $req == null ? '' : $req->semester == "Ganjil" ? "selected" : "" }}>
                                            Ganjil</option>
                                        <option value="Genap"
                                            {{ $req == null ? '' : $req->semester == "Genap" ? "selected" : "" }}>Genap
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tipe">Tipe</label>
                                    <select class="form-control" name="tipe" id="tipe" required>
                                        <option value="harian"
                                            {{ $req == null ? '' : $req->tipe == "harian" ? "selected" : "" }}>Harian
                                        </option>
                                        <option value="uts"
                                            {{ $req == null ? '' : $req->tipe == "uts" ? "selected" : "" }}>UTS
                                        </option>
                                        <option value="uas"
                                            {{ $req == null ? '' : $req->tipe == "uas" ? "selected" : "" }}>UAS
                                        </option>
                                        <option value="raport"
                                            {{ $req == null ? '' : $req->tipe == "raport" ? "selected" : "" }}>Raport
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="siswa_id">Siswa</label>
                                    <select class="select2 form-control" name="siswa_id" id="siswa_id" >
                                        <option value="">Pilih Siswa</option>
                                        @foreach($siswa as $sw)
                                        <option value="{{ $sw->id }}" {{ $req == null ? '' : ($sw->id == $req->siswa_id ? "selected" : "") }}>{{ $sw->nama }} ( {{ $sw->nis }} )</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer col-md-12">
                                    <!-- <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button> -->
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


        @if(!empty($penilaian))
        <div class="card mb-4 mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Table Penilaian</h6>
            </div>
            <div class="card-body">
                <table border="1" class="table table-bordered table-condensed table basic-datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Siswa</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penilaian as $sw)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sw->nama }}</td>
                            <td>{{ $sw->namaKelas }}</td>
                            <td>{{ $sw->namamapel }}</td>
                            <td>{{ $sw->nilai }}</td>
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
                <h6 class="m-0 font-weight-bold text-primary">Diagram Jumlah Penilaian Masuk</h6>
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
