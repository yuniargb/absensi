@extends('layout')
@section('title', 'Data Tagihan Biaya Sekolah')
@section('content')
<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Data Tagihan Biaya Sekolah</div>
                    <button type="button" class="btn btn-outline-primary btn-round btn-sm btnTagihanModal"
                        data-action="add">
                        <span class="btn-label">
                            <i class="fa fa-plus"></i>
                        </span>
                        Tambah Tagihan
                    </button>
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
                                            <th>Bulan</th>
                                            <th>Tahun</th>
                                            <th>Kelas </th>
                                            <th>Tagihan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tagihan as $sw)
                                        <tr>
                                            <td>{{ $sw->bulan }}</td>
                                            <td>{{ $sw->tahun }}</td>
                                            <td>{{ $sw->namaKelas }}</td>
                                            <td>{{ $sw->namatipe }}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning ml-3 btnAbsenDetailModal"
                                                    data-url="/detail_tagihan/{{ Crypt::encrypt($sw->kelas_id) }}/{{ Crypt::encrypt($sw->id) }}"
                                                    data-kelas="{{ $sw->namaKelas }}"><i class="far fa-eye"></i>
                                                </button>
                                                <a class="btn btn-primary ml-3 text-light"
                                                    href="/tagihanemail/{{ Crypt::encrypt($sw->kelas_id) }}/{{ Crypt::encrypt($sw->id) }}"><i
                                                        class="fas fa-paper-plane"></i></i>
                                                </a>
                                                <form action="/api/tagihan/{{ Crypt::encrypt($sw->id) }}"
                                                        method="post" class="d-inline btn-del">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger"
                                                        data-toggle="tooltip" data-original-title="Hapus"><i class="fas fa-trash"></i></button>
                                                </form>
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
                <h5 class="modal-title" id="tagihanModalTitle">Tambah Tagihan Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/daftartagihan" id="tagihanForm" method="post">
                    @csrf
                    <div id="tagihanModalMethod"></div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nis">Bulan</label>
                            <select class="form-control" name="bulan" id="bulan" required>
                                <option value="Januari">Januari</option>
                                <option value="Februari">Februari</option>
                                <option value="Maret">Maret</option>
                                <option value="April">April</option>
                                <option value="Mei">Mei</option>
                                <option value="Juni">Juni</option>
                                <option value="Juli">Juli</option>
                                <option value="Agustus">Agustus</option>
                                <option value="September">September</option>
                                <option value="Oktober">Oktober</option>
                                <option value="November">November</option>
                                <option value="Desmber">Desember</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tahun">Tahun</label>
                            <select class="form-control" name="tahun" id="tahun" required>
                                @php
                                $tahun = (int)date('Y');
                                $akhir = $tahun + 20;
                                @endphp
                                @for($i=$tahun; $akhir >= $i;$i++)<option value="{{ $tahun }}">{{ $tahun }}</option>
                                @php $tahun-- @endphp
                                @endfor

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kelas_id">Kelas</label>
                        <select class="form-control" name="kelas_id" id="kelas_id" required>
                            @foreach($kelas as $sw)
                            <option value="{{ $sw->id }}">{{ $sw->namaKelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tipe_pembayaran_id">Tipe Pembayaran</label>
                        <select class="form-control" name="tipe_pembayaran_id" id="tipe_pembayaran_id" required>
                            @foreach($tipe as $sw)
                            <option value="{{ $sw->id }}">{{ $sw->namatipe }}</option>
                            @endforeach
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

<!-- Modal Detail -->
<div class="modal fade" id="DetailModal" tabindex="-1" role="dialog" aria-labelledby="DetailModal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jadwalModalTitle">Detail Tagihan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body overflow-auto">
                <h5>KELAS : <span id="kelasName"></span></h5>
                <table class="table basic-datatables">
                    <thead>
                        <tr>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="detailBodys">
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
