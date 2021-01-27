@extends('layout')
@section('title', 'Data Tagihan')
@section('content')
<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Daftar Tagihan</div>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                    <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel"
                        aria-labelledby="pills-home-tab-nobd">
                        <div class="col-md-12">
                            <div class="">
                                <table class="table basic-datatables">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Bulan</th>
                                            <th>Tahun</th>
                                            <th>Tagihan</th>
                                            <th>Nominal</th>
                                            <th class="text-center">Bayar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tagihan as $sw)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sw->bulan }}</td>
                                            <td>{{ $sw->tahun }}</td>
                                            <td>{{ $sw->namatipe }}</td>
                                            <td>{{ $sw->tipe == 1 ? $siswa->tarif : $sw->biaya }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-success btnPembayaranModal"
                                                    data-action="add" data-id="{{ $sw->id }}"
                                                    data-tipe="{{ $sw->namatipe }}"
                                                    data-jumlah="{{ $sw->tipe == 1 ? $siswa->tarif : $sw->biaya }}">
                                                    <i class="fa fa-plus"></i>
                                                </button>
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
                <h5 class="modal-title" id="pembayaranModalTitle">Tambah Pembayaran Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/pembayaran" id="pembayaranForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div id="PembayaranModalMethod"></div>
                    <div class="form-group">
                        <label for="idsiswa">Nis</label>
                        <input type="text" class="form-control" name="idsiswa" id="idsiswa" value="{{ $siswa->nis }}"
                            readonly required>
                        <input type="hidden" class="form-control" name="nis" id="nis" value="{{ $siswa->ids }}"
                            readonly>
                        <input type="hidden" class="form-control" name="tagihan_id" id="tagihan_id" readonly>
                    </div>
                    <div class="form-group">
                        <label for="atm">ATM</label>
                        <select class="form-control" name="atm" id="atm" required>

                            <option value="Mandiri">Mandiri (008)</option>
                            <option value="BCA">BCA (014)</option>
                            <option value="BRI">BRI (002)</option>
                            <option value="BNI">BNI (009)</option>
                            <option value="BTN">BTN (200)</option>
                            <option value="CIMB NIAGA">CIMB NIAGA (022)</option>
                            <option value="PANIN">PANIN (019)</option>
                            <option value="OCBC NISP">OCBC NISP (028)</option>
                            <option value="MAYBANK INDONESIA">MAYBANK INDONESIA (016)</option>
                            <option value="DANAMON">DANAMON (011)</option>
                            <option value="Bank BJB">Bank BJB (1234345333)</option>
                            <option value="Bank lainnya">Bank lainnya </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="no_rek">Nomor Rekening</label>
                        <input type="text" required class="form-control" name="no_rek" id="no_rek">
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah Transfer</label>
                        <input type="text" required class="form-control" name="jumlah" id="jumlahd">
                    </div>
                    <div class="form-group">
                        <label for="nis">Tanggal Transfer</label>
                        <input type="date" class="form-control" name="tgl" id="tgl" required>
                    </div>

                    <div class="form-group">
                        <label for="nis">Bukti Transfer</label>
                        <input type="file" class="form-control" name="bukti" id="bukti" required>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Gambar</h5>
                <button type="button" class="Tutup" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" alt="" id="datagambar" class="img-fluid">
            </div>
            <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
        </div>
    </div>
    @stop
