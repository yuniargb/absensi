@extends('layout')
@section('title', 'Data Presensi Staf')
@section('content')

<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Daftar Presensi Staf</div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-outline-primary btn-round btn-sm" data-toggle="modal"
                            data-target="#btnAbsenTambahModal">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Tambah Presensi Staf
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
                                            <th>Staf</th>
                                            <th>Hadir</th>
                                            <th>Sakit</th>
                                            <th>Izin</th>
                                            <th>Alfa</th>
                                            <th>Dispensasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($absensi as $sw)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sw->name }}</td>
                                            <td>{{ $sw->hadir }}</td>
                                            <td>{{ $sw->sakit }}</td>
                                            <td>{{ $sw->izin }}</td>
                                            <td>{{ $sw->alfa }}</td>
                                            <td>{{ $sw->dispensasi }}</td>
                                            <td>
                                                <div class="row">
                                                    <button type="button" class="btn btn-primary btnAbsenEditModal"
                                                        data-url="/absendetail/{{ Crypt::encrypt($sw->id) }}/staf"
                                                        data-id="{{ $sw->email }}" data-nama="{{ $sw->name }}"><i
                                                            class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-warning ml-3 btnAbsenDetailModal"
                                                        data-url="/absendetail/{{ Crypt::encrypt($sw->id) }}/staf"
                                                        data-id="{{ $sw->email }}" data-nama="{{ $sw->name }}"><i
                                                            class="far fa-eye"></i>
                                                    </button>
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

<!-- Modal Tambah -->
<div class="modal fade" id="btnAbsenTambahModal" tabindex="-1" role="dialog" aria-labelledby="btnAbsenTambahModal"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jadwalModalTitle">Tambah Presensi staf</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/tambahabsenm" id="absenForm" method="post">
                    @csrf
                    @method('post')
                    <div id="jadwalModalMethod"></div>
                    <input type="hidden" name="tipe" value="staf">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input required type="date" class="form-control" name="tgl_absen" id="tgl_absen">
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Email</th>
                                <th>Nama</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($staf as $sw)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><input type="hidden" name="id[]" value="{{ $sw->id }}">{{ $sw->email }}</td>
                                <td>{{ $sw->name }}</td>
                                <td>
                                    <select class="form-control" name="keterangan[]" id="keterangan[]" required>
                                        <option value="Hadir" selected>Hadir</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Izin">Izin</option>
                                        <option value="Alfa">Alfa</option>
                                        <option value="Dispensasi">Dispensasi</option>
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jadwalModalTitle">Edit Presensi Staf</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Email : <span id="editID"></span></h5>
                <h5>NAMA : <span id="editNama"></span></h5>
                <form action="/absensi/update" id="absenForm" method="post">
                    @csrf
                    @method('put')
                    <div id="jadwalModalMethod"></div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody id="dataBody">
                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="DetailModal" tabindex="-1" role="dialog" aria-labelledby="DetailModal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jadwalModalTitle">Detail Presensi Staf</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>NIP : <span id="detailID"></span></h5>
                <h5>NAMA : <span id="detailNama"></span></h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody id="detailBody">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@stop
