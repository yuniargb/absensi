@extends('layout')
@section('title', 'Data Presensi Siswa')
@section('content')

<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Daftar Presensi Siswa</div>
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
                                            <th>Kelas</th>
                                            <th>Wali Kelas</th>
                                            <th>Hadir</th>
                                            <th>Sakit</th>
                                            <th>Izin</th>
                                            <th>Alfa</th>
                                            <th>Terlambat</th>
                                            <th>Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($absensi as $sw)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sw->nama }}</td>
                                            <td>{{ $sw->namaKelas }}</td>
                                            <td>{{ $sw->walikelas }}</td>
                                            <td>{{ $sw->hadir }}</td>
                                            <td>{{ $sw->sakit }}</td>
                                            <td>{{ $sw->izin }}</td>
                                            <td>{{ $sw->alfa }}</td>
                                            <td>{{ $sw->terlambat }}</td>

                                            <td>
                                                <div class="row">
                                                    <button type="button" class="btn btn-primary btnAbsenEditModal"
                                                        data-url="/absendetail/{{ Crypt::encrypt($sw->id) }}/siswa"
                                                        data-id="{{ $sw->nis }}" data-nama="{{ $sw->nama }}"><i
                                                            class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-warning ml-3 btnAbsenDetailModal"
                                                        data-url="/absendetail/{{ Crypt::encrypt($sw->id) }}/siswa"
                                                        data-id="{{ $sw->nis }}" data-nama="{{ $sw->nama }}"><i
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
                <h5 class="modal-title" id="jadwalModalTitle">Tambah Presensi Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/tambahabsenm" id="absenForm" method="post">
                    @csrf
                    @method('post')
                    <div id="jadwalModalMethod"></div>
                    <input type="hidden" name="tipe" value="siswa">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nip">Guru (NIP)</label>
                            <input type="text" class="form-control" name="nip" id="nip" {{ auth()->user()->role != 4 ? 'value='. auth()->user()->username .' readonly' : '' }}  required >
                        </div>

                        <div class="form-group col-md-6">
                            <label for="tanggal">Tanggal</label>
                            <input required type="date" class="form-control" name="tgl_absen" id="tgl_absen" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="kelas">Kelas</label>
                            <select required name="kelas" id="kelas" class="form-control" required>
                                <optgroup label="Pilih Kelas">
                                    <option value="" selected></option>
                                    @foreach($kelas as $kls)
                                    <option value="{{ $kls->id }}">{{ $kls->namaKelas }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mapel">Mata Pelajaran</label>
                            <select required name="mapel" id="mapel" class="form-control" required>
                                <optgroup label="Pilih Mata Pelajaran">
                                    <option value="" selected></option>
                                    @foreach($mapel as $kls)
                                    <option value="{{ $kls->id }}">{{ $kls->namamapel }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="tanggal">Minggu Ke</label>
                            <select required name="minggu" id="minggu" class="form-control" required>
                                <optgroup label="Pilih Minggu">
                                    <option value="" selected></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tanggal">Bulan</label>
                            <select required name="bulan" id="bulan" class="form-control" required>
                                <optgroup label="Pilih Bulan">
                                    <option value="" selected></option>
                                    <option>Januari</option>
                                    <option>Februari</option>
                                    <option>Maret</option>
                                    <option>April</option>
                                    <option>Mei</option>
                                    <option>Juni</option>
                                    <option>Juli</option>
                                    <option>Agustus</option>
                                    <option>September</option>
                                    <option>Oktober</option>
                                    <option>November</option>
                                    <option>Desember</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tanggal">Jam</label>
                            <select required name="jam" id="jam" class="form-control" required>
                                <optgroup label="Pilih Jam">
                                    <option value="" selected></option>
                                    <option value="1">1 (07.00-08.15)</option>
                                    <option value="2">2 (08.30-09.45)</option>
                                    <option value="3">3 (10.00-11.15)</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="materi">Materi Pembahasan</label>
                        <textarea class="form-control" name="materi" id="kegiatan" required> </textarea>
                    </div>
                    <div class="form-group">
                        <label for="kegiatan">Kegiatan Pembelajaran</label>
                        <textarea class="form-control" name="kegiatan" id="kegiatan" required> </textarea>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Keterangan</th>
                                <th>Kasus</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody id="tambahBody">
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
                <h5 class="modal-title" id="jadwalModalTitle">Edit Presensi Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>NIS : <span id="editID"></span></h5>
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
                                <th>Kasus</th>
                                <th>Tindakan</th>
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

<!-- Modal Edit -->
<div class="modal fade" id="DetailModal" tabindex="-1" role="dialog" aria-labelledby="DetailModal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jadwalModalTitle">Detail Presensi Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>NIS : <span id="detailID"></span></h5>
                <h5>NAMA : <span id="detailNama"></span></h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Kasus</th>
                            <th>Tindakan</th>
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
