@extends('layout')
@section('title', 'Data Pembayaran')
@section('content')
<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Daftar Pembayaran</div>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                    <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel"
                        aria-labelledby="pills-home-tab-nobd">
                        <div class="col-md-12">
                            <div class="container mb-3">
                                <ul class="list-group">
                                    <li class="list-group-item">NIS : {{ $siswa->nis }}</li>
                                    <li class="list-group-item">Nama : {{ $siswa->nama }}</li>
                                    <li class="list-group-item">Kelas : {{ $siswa->namaKelas }}</li>
                                    <li class="list-group-item">
                                        <a class="btn  bg-primary text-light" href="/cetakpembayaran"
                                            data-toggle="tooltip" data-original-title="Download Excel"><i
                                                class="fa fa-download"></i> Download</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="">
                                <table class="table basic-datatables">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Siswa</th>
                                            <th>Tanggal</th>
                                            <th>Bulan</th>
                                            <th>No Rek</th>
                                            <th>Tipe</th>
                                            <th>Bukti</th>
                                            <th>Jumlah </th>
                                            <th>Bank</th>
                                            <th>Status</th>
                                            <th>Pesan</th>
                                            <th>Cetak</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pembayaran as $sw)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sw->nama }}</td>
                                            <td>{{ $sw->tgl_transfer }}</td>
                                            <td>{{ $sw->bulan }}</td>
                                            <td>{{ $sw->no_rek }}</td>
                                            <td>{{ $sw->namatipe }}</td>

                                            <td><button class="btn btn-primary detail-bukti"
                                                    data-image="/images/paket/{{ $sw->bukti }}" data-toggle="modal"
                                                    data-target="#exampleModal">Tampil</button></td>
                                            <td>@currency( $sw->jumlah )</td>
                                            <td>{{ $sw->atm }}</td>
                                            @php
                                            if($sw->status == 0 )
                                            $pesan = '<span class="badge badge-danger">Menunggu</span>';

                                            elseif($sw->status == 3)

                                            $pesan = '<span class="badge badge-danger">Di Tolak</span>';

                                            else

                                            $pesan = '<span class="badge badge-success">Konfirmasi</span>';
                                            @endphp
                                            <td>{!! $pesan !!}</td>
                                            <td>{{ $sw->pesan }}</td>
                                            <td>
                                                <a class="btn  btn-success" target="_blank"
                                                    href="/cetakpembayaran/{{ Crypt::encrypt($sw->id_p) }}"
                                                    data-toggle="tooltip" data-original-title="Cetak"><i
                                                        class="fa fa-print"></i></a>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <button type="button" class="btn btn-primary btnPembayaranModal"
                                                    data-action="update" data-id="{{ Crypt::encrypt($sw->id) }}"
                                                    data-url="pembayaran/{{  Crypt::encrypt($sw->id) }}/edit"
                                                    data-tipe="{{ $sw->namatipe }}"
                                                    data-jumlah="{{ $sw->biaya }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <form action="/api/pembayaran/{{ Crypt::encrypt($sw->id_p) }}"
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
                            <option value="Mandiri">Mandiri (954129210)</option>
                            <option value="BCA">BCA (6565189160)</option>
                            <option value="BRI">BRI (9090189120)</option>
                            <option value="BNI">BNI (1234345123)</option>
                            <option value="BTN">BTN (1122312345)</option>
                            <option value="CIMB NIAGA">CIMB NIAGA (6565189160)</option>
                            <option value="PANIN">PANIN (1234345123)</option>
                            <option value="OCBC NISP">OCBC NISP (1234345124)</option>
                            <option value="MAYBANK INDONESIA">MAYBANK INDONESIA (1244235123)</option>
                            <option value="DANAMON">DANAMON (1234345223)</option>
                            <option value="Bank BJB">Bank BJB (1234345333)</option>
                            <option value="Bank lainnya">Bank lainnya (888888123)</option>
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
                        <input type="file" class="form-control" name="bukti" id="bukti" >
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
