@extends('layout')
@section('title', 'Laporan Data Presensi Siswa')
@section('content')
<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Laporan Presensi Siswa</div>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                    <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel"
                        aria-labelledby="pills-home-tab-nobd">
                        <div class="col-md-12">
                            <form action="/cetaklaporanabsensiswa" id="pembayaranForm" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="nis">Kelas</label>
                                    <select class="form-control" name="kelas_id" id="kelas_id">
                                         <option value="">--------</option>
                                        @foreach($kelas as $k)
                                        <option value="{{ $k->id }}"
                                            {{ $req == null ? '' : $req->kelas_id == $k->id ? "selected" : "" }}>
                                            {{ $k->namaKelas }}</option>
                                        @endforeach
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
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="nis">Dari Tanggal</label>
                                        <input type="date" class="form-control" name="from" id="from"
                                            value="{{ $req == null ? '' : $req->from != '' ? $req->from : '' }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="nis">Sampai Tanggal</label>
                                        <input type="date" class="form-control" name="to" id="to"
                                            value="{{ $req == null ? '' : $req->to != '' ? $req->to : '' }}">
                                    </div>
                                </div>
                                <div class="modal-footer col-md-12">
                                    <button name="submit" type="submit" class="btn btn-success"
                                        value="read">Tampil</button>
                                    <button name="submit" type="submit" class="btn btn-info" value="csv">Download
                                        CSV</button>
                                    <!-- <button name="submit" type="submit" class="btn btn-primary" value="pdf">Download
                                        PDF</button> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(!empty($absensi))
        <div class="card mb-4 mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Table Presensi Siswa</h6>
            </div>
            <div class="card-body">
                <table border="1" class="table table-bordered table-condensed table basic-datatables table-responsive">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Materi</th>
                            <th>Kegiatan</th>
                            <th>Minggu</th>
                            <th>Bulan</th>
                            <th>Jam</th>
                            <th>Mata Pelajaran</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Keterangan</th>
                            <th>Kasus</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($absensi as $sw)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('d-m-Y',strtotime($sw->tgl_absen)) }}</td>
                            <td>{{ $sw->materi }}</td>
                            <td>{{ $sw->kegiatan }}</td>
                            <td>{{ $sw->minggu }}</td>
                            <td>{{ $sw->bulan }}</td>
                            <td>{{ $sw->jam }}</td>
                            <td>{{ $sw->namamapel }}</td>
                            <td>{{ $sw->nis }}</td>
                            <td>{{ $sw->nama }}</td>
                            <td>{{ $sw->namaKelas }}</td>
                            <td>{{ $sw->keterangan }}</td>
                            <td>{{ $sw->kasus }}</td>
                            <td>{{ $sw->tindakan }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
            </div>
        </div>
        @endif
        
    </div>
</div>
@stop
