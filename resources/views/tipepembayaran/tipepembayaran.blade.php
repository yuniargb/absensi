@extends('layout')
@section('title', 'Data Tipe Pembayaran Siswa')
@section('content')
<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Daftar Tipe Pembayaran Siswa</div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-outline-primary btn-round btn-sm btnTipePembayaranModal"
                            data-action="add">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Tambah Tipe Pembayaran
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
                                            <th>Nama Tipe</th>
                                            <th>Biaya</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tipepembayaran as $ang)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $ang->namatipe }}</td>
                                            <td>@currency($ang->biaya)</td>
                                            <td>
                                                <div class="row">
                                                    <button type="button" class="btn btn-primary btnTipePembayaranModal"
                                                        data-url="/tipepembayaran/{{ Crypt::encrypt($ang->id) }}/edit"
                                                        data-id="{{ Crypt::encrypt($ang->id) }}" data-toggle="tooltip"
                                                        data-original-title="Ubah" data-action="ubah"
                                                        data-method='@method("put")'><i class="fa fa-edit"></i>
                                                    </button>
                                                    @if( $ang->id != 1)
                                                    <form action="/api/tipepembayaran/{{ Crypt::encrypt($ang->id) }}"
                                                        method="post" class="d-inline btn-del">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger"
                                                            data-toggle="tooltip" data-original-title="Hapus"><i
                                                                class="fa fa-times"></i></button>
                                                    </form>
                                                    @endif
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
                <h5 class="modal-title" id="tipepembayaranModalTitle">Tambah Pembayaran Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/tipepembayaran" id="tipepembayaranForm" method="post">
                    @csrf
                    <div id="tipepembayaranModalMethod"></div>
                    <div class="form-group">
                        <label for="namatipe">Nama Tipe</label>
                        <input type="text" class="form-control" name="namatipe" id="namatipe" required>
                    </div>
                    <div class="form-group">
                        <label for="biaya">Biaya</label>
                        <input type="number" class="form-control" name="biaya" id="biaya" required>
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
