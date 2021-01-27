@extends('layout')
@section('title', 'Data RPP & Silabus')
@section('content')
<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Daftar RPP & Silabus</div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-outline-primary btn-round btn-sm btnRppDanSilabusModal"
                            data-action="add">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Tambah RPP & Silabus
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                    <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel"
                        aria-labelledby="pills-home-tab-nobd">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table basic-datatables">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Kelas</th>
                                            <th>Semester</th>
                                            <th>Alokasi Waktu</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sdp as $sw)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sw->namamapel }}</td>
                                            <td>{{ $sw->tahun_ajaran }}</td>
                                            <td>{{ $sw->kelas }}</td>
                                            <td>{{ $sw->semester }}</td>
                                            <td>{{ $sw->alokasi_waktu }}</td>
                                            <td>
                                                <div class="row">
                                                    <button type="button" class="btn btn-primary btnRppDanSilabusModal"
                                                        data-url="/rppdansilabus/{{ Crypt::encrypt($sw->id) }}/edit"
                                                        data-id="{{ Crypt::encrypt($sw->id) }}" data-toggle="tooltip"
                                                        data-original-title="Ubah" data-action="Ubah"
                                                        data-method='@method("put")'><i class="fa fa-edit"></i>
                                                    </button>
                                                    <form action="/api/rppdansilabus/{{ Crypt::encrypt($sw->id) }}"
                                                        method="post" class="d-inline btn-del">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger"
                                                            data-toggle="tooltip" data-original-title="Hapus"><i
                                                                class="fa fa-times"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rppdansilabusModalTitle">Tambah Pembayaran Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/rppdansilabus" id="rppdansilabusForm" method="post">
                    @csrf
                    <div id="rppdansilabusModalMethod"></div>
                    <div class="form-group">
                        <label for="mata_pelajaran_id">Mata Pelajaran</label>
                        <select class="form-control" name="mata_pelajaran_id" id="mata_pelajaran_id" required>
                            @foreach($mapel as $sw)
                            <option value="{{ $sw->id }}">{{ $sw->namamapel }}</option>
                            @endforeach
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
                        <label for="kelas">Kelas</label>
                        <select class="form-control" name="kelas" id="kelas" required>
                            <option value="VII">VII</option>
                            <option value="VIII">VIII</option>
                            <option value="IX">IX</option>
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
                        <label for="alokasi_waktu">Alokasi Waktu</label>
                        <input type="text" class="form-control" name="alokasi_waktu" id="alokasi_waktu" required>
                    </div>

                    <div class="form-group">
                        <label for="kompetensi_dasar">Komptensi Dasar</label>
                        <textarea name="kompetensi_dasar" id="kompetensi_dasar" class="form-control editor" cols="30"
                            rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="indikator_pencapaian_kompetensi">Indikator Pencapaian Komptensi</label>
                        <textarea name="indikator_pencapaian_kompetensi" id="indikator_pencapaian_kompetensi"
                            class="form-control editor" cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="materi_pembelajaran">Materi Pembelajaran</label>
                        <textarea name="materi_pembelajaran" id="materi_pembelajaran" class="form-control editor"
                            cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="kegiatan_pembelajaran">Kegiatan Pembelajaran</label>
                        <textarea name="kegiatan_pembelajaran" id="kegiatan_pembelajaran" class="form-control editor"
                            cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="ppr">Penilaian, Pembelajaran, dan Remidial.</label>
                        <textarea name="ppr" id="ppr" class="form-control editor" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="media">Media</label>
                        <textarea name="media" id="media" class="form-control editor" cols="30" rows="10"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
