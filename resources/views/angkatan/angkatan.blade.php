@extends('layout')
@section('title', 'Data Angkatan Siswa')
@section('content')
<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Daftar Angkatan Siswa</div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-outline-primary btn-round btn-sm btnSppModal"
                            data-action="add">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Tambah Angkatan
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
                                            <th>Tahun Masuk</th>
                                            <th>Tarif</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($angkatan as $ang)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $ang->angkatan }}</td>
                                            <td>{{ $ang->tarifspp }}</td>
                                            <td>
                                                <div class="row">
                                                    <button type="button" class="btn btn-primary btnSppModal"
                                                        data-url="/spp/{{ Crypt::encrypt($ang->id) }}/edit"
                                                        data-id="{{ Crypt::encrypt($ang->id) }}" data-toggle="tooltip"
                                                        data-original-title="Ubah" data-action="ubah"
                                                        data-method='@method("put")'><i class="fa fa-edit"></i>
                                                    </button>
                                                    <form action="/api/spp/{{ Crypt::encrypt($ang->id) }}" method="post"
                                                        class="d-inline btn-del">
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
                <h5 class="modal-title" id="sppModalTitle">Tambah Pembayaran Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/spp" id="sppForm" method="post">
                    @csrf
                    <div id="sppModalMethod"></div>
                    <div class="form-group">
                        <label for="tahunMasuk">Tahun Masuk</label>
                        <input type="text" class="form-control" name="tahunMasuk" id="tahunMasuk" required>
                    </div>
                    <div class="form-group">
                        <label for="tarif">Tarif</label>
                        <input type="text" class="form-control" name="tarif" id="tarif" required>
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
