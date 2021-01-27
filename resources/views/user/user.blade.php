@extends('layout')
@section('title', 'Profile')
@section('content')
<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                    <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel"
                        aria-labelledby="pills-home-tab-nobd">
                        <div class="row">
                            <div class="col-md-6">
                                @if(auth()->user()->role == 2)
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Nama</td>
                                        <td>{{ $user->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kelas</td>
                                        <td>{{ $user->namaKelas }}</td>
                                    </tr>
                                    <tr>
                                        <td>Angkatan</td>
                                        <td>{{ $user->angkatan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tarif SPP</td>
                                        <td>Rp {{ number_format($user->tarifspp,0,',','.') }}</td>
                                    </tr>
                                </table>
                                <button type="button" class="btn btn-primary btn-block btnEditUser"
                                    data-url="/user/siswa/{{ Crypt::encrypt($user->nis) }}/edit">Ubah Biodata <i
                                        class="fa fa-pencil-alt"></i></button>
                                @else
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Nama</td>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Pengguna</td>
                                        <td>{{ $user->username }}</td>
                                    </tr>
                                </table>
                                <button type="button" class="btn btn-primary btn-block btnEditUser"
                                    data-url="/user/{{ Crypt::encrypt($user->id) }}/edit">Ubah Biodata <i
                                        class="fa fa-pencil-alt"></i></button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="editModalUser" tabindex="-1" role="dialog" aria-labelledby="editModalUserTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adminModalTitle">Ubah Biodata</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/user/{{ Crypt::encrypt($user->id) }}/update" id="adminForm" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" required name="nama" id="nama"
                            {{ (auth()->user()->role == 2) ? 'readonly' : '' }}>
                    </div>
                    <div class="form-group">
                        <label for="username">Nama Pengguna</label>
                        <input type="text" name="username" class="form-control" required id="username"
                            {{ (auth()->user()->role == 2) ? 'readonly' : '' }}>
                    </div>
                    <div class="form-group">
                        <label for="password">kata Sandi Baru</label>
                        <input type="password" name="password" class="form-control" id="password">
                        <i class="text-danger">*Kosongkan bila tidak ingin mengubah kata sandi</i>
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
