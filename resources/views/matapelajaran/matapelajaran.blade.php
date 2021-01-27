@extends('layout')
@section('title', 'Data Mata Pelajaran')
@section('content')

<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Daftar Mata Pelajaran</div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-outline-primary btn-round btn-sm btnMapelModal"
                            data-action="add">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Tambah Mata Pelajaran
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
                                            <th>Jumlah Jam</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($mapel as $sw)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sw->namamapel }}</td>
                                            <td>{{ $sw->jumlahjam }}</td>
                                            <td>
                                                <div class="row">
                                                    <button type="button" class="btn btn-primary btnMapelModal"
                                                        data-url="/matapelajaran/{{ Crypt::encrypt($sw->id) }}/edit"
                                                        data-id="{{ Crypt::encrypt($sw->id) }}" data-toggle="tooltip"
                                                        data-original-title="Ubah" data-action="Ubah"
                                                        data-method='@method("put")'><i class="fa fa-edit"></i>
                                                    </button>
                                                    <form action="/api/matapelajaran/{{ Crypt::encrypt($sw->id) }}"
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
                <h5 class="modal-title" id="mapelModalTitle">Tambah Mata Pelajaran Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/matapelajaran" id="mapelForm" method="post">
                    @csrf
                    <div id="mapelModalMethod"></div>
                    <div class="form-group">
                        <label for="namamapel">Mata Pelajaran</label>
                        <input required type="text" class="form-control" name="namamapel" id="namamapel">
                    </div>
                    <div class="form-group">
                        <label for="jumlahjam">Jumlah Jam</label>
                        <input required type="text" class="form-control" name="jumlahjam" id="jumlahjam">
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
