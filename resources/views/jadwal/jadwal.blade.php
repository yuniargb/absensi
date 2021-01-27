@extends('layout')
@section('title', 'Data Jadwal')
@section('content')

<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Daftar Jadwal</div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-outline-primary btn-round btn-sm btnJadwalModal"
                            data-action="add">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Tambah Jadwal
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
                                            <th>Guru</th>
                                            <th>Hari</th>
                                            <th>Semester</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Jam</th>
                                            <th>Jumlah Jam</th>
                                            <th>Kelas</th>
                                            <th>Angkatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jadwal as $sw)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sw->nama }}</td>
                                            <td>{{ $sw->hari }}</td>
                                            <td>{{ $sw->semester }}</td>
                                            <td>{{ $sw->namamapel }}</td>
                                            <td>{{ $sw->jam }}</td>
                                            <td>{{ $sw->jumlahjam }}</td>
                                            <td>{{ $sw->namaKelas }}</td>
                                            <td>{{ $sw->tahun_ajaran }}</td>
                                            <td>
                                                <div class="row">
                                                    <button type="button" class="btn btn-primary btnJadwalModal"
                                                        data-url="/jadwal/{{ Crypt::encrypt($sw->id) }}/edit"
                                                        data-id="{{ Crypt::encrypt($sw->id) }}" data-toggle="tooltip"
                                                        data-original-title="Ubah" data-action="Ubah"
                                                        data-method='@method("put")'><i class="fa fa-edit"></i>
                                                    </button>
                                                    <form action="/api/jadwal/{{ Crypt::encrypt($sw->id) }}"
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
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jadwalModalTitle">Tambah Mata Pelajaran Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/jadwal" id="jadwalForm" method="post">
                    @csrf
                    <div id="jadwalModalMethod"></div>
                    <div class="form-group">
                        <label for="guru_id">Guru</label>
                        <select class="select2 form-control w-100" name="guru_id" id="guru_id" required>
                            <option value="" disabled>Pilih Guru</option>
                            @foreach($guru as $sw)
                            <option value="{{ $sw->id }}">{{ $sw->nama }} ( {{ $sw->nip }} )</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hari">Hari</label>
                        <select class="form-control" name="hari" id="hari" required>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jam">Jam</label>
                        <input required type="text" class="form-control" name="jam" id="jam">
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="form-control" name="semester" id="semester" required>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kelas_id">Kelas</label>
                        <select class="form-control" name="kelas_id" id="kelas_id" required>
                            @foreach($kelas as $sw)
                            <option value="{{ $sw->id }}">{{ $sw->namaKelas }}</option>
                            @endforeach
                        </select>
                    </div>
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
