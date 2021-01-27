@extends('layout')
@section('title', 'Laporan Data RPP & Silabus')
@section('content')
<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Laporan RPP & Silabus</div>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                    <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel"
                        aria-labelledby="pills-home-tab-nobd">
                        <div class="col-md-12">
                            <form action="/cetaklaporanrds" id="pembayaranForm" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <select class="form-control" name="kelas" id="kelas" required>
                                        <option value="VII">VII</option>
                                        <option value="VIII">VIII</option>
                                        <option value="IX">IX</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tahun_ajaran">Tahun Ajaran</label>
                                    <select class="form-control" name="tahun_ajaran" id="tahun_ajaran" required>
                                        @php
                                        $tahun = (int)date('Y');
                                        $akhir = $tahun + 20;
                                        @endphp
                                        @for($i=$tahun; $akhir >= $i;$i++) @php $next=$tahun + 1 @endphp <option
                                            value="{{ $tahun .'/'. $next }}">{{ $tahun .'/'. $next }}</option>
                                        @php $tahun-- @endphp
                                        @endfor

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="semester">Semester</label>
                                    <select class="form-control" name="semester" id="semester" required>
                                        <option value="Ganjil">Ganjil</option>
                                        <option value="Genap">Genap</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="mata_pelajaran_id">Mata Pelajaran</label>
                                    <select class="form-control" name="mata_pelajaran_id" id="mata_pelajaran_id"
                                        required>
                                        @foreach($mapel as $sw)
                                        <option value="{{ $sw->id }}">{{ $sw->namamapel }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer col-md-12">
                                    <!-- <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button> -->
                                    <button type="submit" class="btn btn-primary">Download</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
