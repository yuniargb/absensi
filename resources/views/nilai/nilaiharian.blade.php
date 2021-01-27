@extends('layout')
@section('title', 'Data Nilai Harian')
@section('content')

<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Daftar Nilai Harian</div>
                    @if(auth()->user()->role != 2)
                    <div class="card-tools">
                        <button type="button" class="btn btn-outline-primary btn-round btn-sm btnNilaiModal"
                            data-action="add" data-type="harian">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Tambah Nilai Harian
                        </button>
                    </div>
                    @endif
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
                                            <th>Siswa</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Semester</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Nilai</th>
                                            @if(auth()->user()->role != 2)
                                            <th>Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($nilai as $sw)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sw->nama }}</td>
                                            <td>{{ $sw->namamapel }}</td>
                                            <td>{{ $sw->semester }}</td>
                                            <td>{{ $sw->tahun_ajaran }}</td>
                                            <td>{{ $sw->nilai }}</td>
                                            @if(auth()->user()->role != 2)
                                            <td>
                                                <div class="row">
                                                    <button type="button" class="btn btn-primary btnNilaiModal"
                                                        data-url="/nilai/{{ Crypt::encrypt($sw->id) }}/edit"
                                                        data-id="{{ Crypt::encrypt($sw->id) }}" data-toggle="tooltip"
                                                        data-original-title="Ubah" data-action="Ubah"
                                                        data-method='@method("put")' data-type="harian"><i
                                                            class="fa fa-edit"></i>
                                                    </button>
                                                    <form action="/api/nilai/{{ Crypt::encrypt($sw->id) }}"
                                                        method="post" class="d-inline btn-del">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger"
                                                            data-toggle="tooltip" data-original-title="Hapus"><i
                                                                class="fa fa-times"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                            @endif
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
                <h5 class="modal-title" id="nilaiModalTitle">Tambah Nilai harian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/nilaiharian" id="nilaiForm" method="post">
                    @csrf
                    <div id="nilaiModalMethod"></div>
                    <div class="form-group">
                        <label for="mata_pelajaran_id">Mata Pelajaran</label>
                        <select class="select2 form-control w-100" name="mata_pelajaran_id" id="mata_pelajaran_id"
                            required>
                            @foreach($mapel as $sw)
                            <option value="{{ $sw->id }}">{{ $sw->namamapel }} [ {{ $sw->nama }} ][ {{$sw->namaKelas}} ]
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="siswa_id">Siswa</label>
                        <select class="select2 form-control w-100" name="siswa_id" id="siswa_id" required>
                            <option value="" disabled>Pilih Siswa</option>
                            @foreach($siswa as $sw)
                            <option value="{{ $sw->id }}">{{ $sw->nama }} ( {{ $sw->nis }} )</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nilai">Nilai</label>
                        <input required type="text" class="form-control" name="nilai" id="nilai">
                        <input required type="hidden" class="form-control" name="type" id="type">
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
