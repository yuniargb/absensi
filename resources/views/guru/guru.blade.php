@extends('layout')
@section('title', 'Data Guru')
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
                    <div class="card-title">Daftar Guru</div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-outline-primary btn-round btn-sm btnGuruModal"
                            data-action="add">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Tambah Guru
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
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($guru as $gr)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $gr->nip }}</td>
                                            <td>{{ $gr->nama }}</td>
                                            <td>
                                                <div class="row">

                                                    <a href="/guru/{{ Crypt::encrypt($gr->id) }}/pass"
                                                        class="btn btn-warning btn-passs" data-toggle="tooltip"
                                                        data-original-title="Atur Ulang Kata Sandi"><i
                                                            class="fa fa-key"></i></a>

                                                    <button type="button" data-toggle="modal" data-target="#logoutModal"
                                                        class="btn btn-primary btnGuruModal"
                                                        data-url="/guru/{{ Crypt::encrypt($gr->id) }}/edit"
                                                        data-id="{{ Crypt::encrypt($gr->id) }}" data-toggle="tooltip"
                                                        data-original-title="Ubah" data-action="ubah"
                                                        data-method='@method("put")'><i class="fa fa-edit"></i>
                                                    </button>
                                                    <form action="/api/guru/{{ Crypt::encrypt($gr->id) }}" method="post"
                                                        class="d-inline btn-del">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger "
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
                <h5 class="modal-title" id="guruModalTitle">Tambah Guru Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/guru" id="guruForm" class="guru-form" method="post">
                    @csrf
                    <div id="guruModalMethod"></div>
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input required type="text" class="form-control" name="nip" id="nip">
                        <small class="text-danger">{{ $errors->first('nip') }}</small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input required type="text" class="form-control" name="nama" id="nama">
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
