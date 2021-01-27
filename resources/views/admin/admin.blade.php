@extends('layout')
@section('title', 'Data User')
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
                    <div class="card-title">Daftar User</div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-outline-primary btn-round btn-sm btnAdminModal"
                            data-action="add">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Tambah User
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
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>No Kartu</th>
                                            <th>Jabatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($admin as $adm)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $adm->name }}</td>
                                            <td class="text-primary">{{ $adm->username }}</td>
                                            <td>{{ $adm->no_kartu }}</td>
                                            @php
                                            if($adm->role == 1){
                                            $role = 'Staf Pembayaran';
                                            }elseif($adm->role == 3){
                                            $role = 'Kepala Sekolah';
                                            }elseif($adm->role == 5){
                                            $role = 'Staf Pembelajaran';
                                            }elseif($adm->role == 6){
                                            $role = 'Staf Absensi';
                                            }else{
                                            $role = 'Administrator';
                                            }
                                            @endphp
                                            <td>{{ $role }}</td>
                                            <td>
                                                <div class="row">
                                                    <button type="button" class="btn  btn-primary btnAdminModal"
                                                        data-url="/admin/{{ Crypt::encrypt($adm->id) }}/edit"
                                                        data-id="{{ Crypt::encrypt($adm->id) }}" data-toggle="tooltip"
                                                        data-original-title="Edit" data-action="edit"
                                                        data-method='@method("put")'><i class="fa fa-edit"></i>
                                                    </button>
                                                    <form action="/api/admin/{{ Crypt::encrypt($adm->id) }}"
                                                        method="post" class="d-inline btn-del">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn  btn-danger"
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
                <h5 class="modal-title" id="adminModalTitle">Tambah User Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin" id="adminForm" method="post">
                    @csrf
                    <div id="adminModalMethod"></div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" required name="nama" id="nama">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" required id="username">
                    </div>
                    <div class="form-group">
                        <label for="no_kartu">Nomor Kartu</label>
                        <input type="number" name="no_kartu" class="form-control" required id="no_kartu">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" required name="email" id="email">
                    </div>
                    <div class="form-group password-hide">
                        <label for="username">Kata Sandi</label>
                        <input type="password" name="password" class="form-control" required id="password">
                        <small id="showpassedit" class="form-text text-danger hide">Kosongkan jika tidak ingin
                            merubah</small>
                    </div>
                    <div class="form-group" id="pass-toggle">
                        <label for="username">Ulang Kata Sandi</label>
                        <input type="password" name="password1" class="form-control" required id="password1">
                        <small id="showpass" class="form-text text-danger hide">Kata sandi tidak sesuai</small>
                    </div>
                    <div class="form-group">
                        <label for="role">Level</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="">--PILIH Level--</option>
                            <option value="4">Administrator</option>
                            <option value="3">Kepala Sekolah</option>
                            <option value="1">Staf Pembayaran</option>
                            <option value="5">Staf Pembelajaran</option>
                            <option value="6">Staf Absensi</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="save">Simpan</button>
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
