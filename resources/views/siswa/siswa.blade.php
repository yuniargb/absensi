@extends('layout')
@section('title', 'Data Siswa')
@section('content')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Daftar Siswa</div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-outline-primary btn-round btn-sm btnSiswaModal"
                            data-action="add">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Tambah Siswa
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
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($siswa as $sw)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sw->nis }}</td>
                                            <td>{{ $sw->nama }}</td>

                                            <td>{{ $sw->namaKelas }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <a href="/siswa/{{ Crypt::encrypt($sw->id) }}/pass"
                                                            class="w-100 btn btn-warning btn-passs"
                                                            data-toggle="tooltip"
                                                            data-original-title="Atur Ulang Kata Sandi"><i
                                                                class="fa fa-key"></i></a>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <button type="button" data-toggle="modal"
                                                            data-target="#logoutModal"
                                                            class="w-100 btn btn-primary btnSiswaModal"
                                                            data-url="/siswa/{{ Crypt::encrypt($sw->id) }}/edit"
                                                            data-id="{{ Crypt::encrypt($sw->id) }}"
                                                            data-toggle="tooltip" data-original-title="Ubah"
                                                            data-action="ubah" data-method='@method("put")'><i
                                                                class="fa fa-edit"></i>
                                                        </button>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <form action="/api/siswa/{{ Crypt::encrypt($sw->id) }}"
                                                            method="post" class="d-inline btn-del">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="w-100 btn btn-danger "
                                                                data-toggle="tooltip" data-original-title="Hapus"><i
                                                                    class="fa fa-times"></i></button>
                                                        </form>
                                                    </div>
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
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="siswaModalTitle">Tambah Siswa Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/siswa" id="siswaForm" class="siswa-form" method="post">
                    @csrf
                    <div id="siswaModalMethod"></div>
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input required type="text" class="form-control" name="nis" id="nis">
                        <small class="text-danger">{{ $errors->first('nis') }}</small>
                    </div>
                    <div class="form-group">
                            <label for="nama">Nama</label>
                            <input required type="text" class="form-control" name="nama" id="nama">
                        </div>
                        
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <select required name="kelas" id="kelas" class="form-control">
                                <optgroup label="Pilih Kelas">
                                    <option value=""></option>
                                    @foreach($kelas as $kls)
                                    <option value="{{ $kls->id }}">{{ $kls->namaKelas }}</option>
                                    @endforeach
                                </optgroup>
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
<!-- Modal Edit -->
<div class="modal fade" id="DetailModal" tabindex="-1" role="dialog" aria-labelledby="DetailModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jadwalModalTitle">Detail Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="detailSiswa">
                    <tr>
                        <th>NIS</th>
                        <th>:</th>
                        <td>:</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Bayar -->
<div class="modal fade" id="BayarModal" tabindex="-1" role="dialog" aria-labelledby="DetailModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jadwalModalTitle">Detail Pembayaran Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container">
                <h5>NIS : <span id="nisBayar"></span></h5>
                <h5>Nama : <span id="namaBayar"></span></h5>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <!-- <th>No</th> -->
                            <th>Keterangan</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Biaya</th>
                            <th>Bayar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="bayarSiswa">

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
