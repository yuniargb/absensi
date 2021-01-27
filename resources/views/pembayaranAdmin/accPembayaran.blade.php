@extends('layout')
@section('title', 'Data Biaya Wajib')
@section('content')
<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Data Administrasi Biaya Wajib</div>
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
                                            <!-- <th>No</th> -->
                                            <th>NIS</th>
                                            <th>Siswa</th>
                                            <th>Tanggal </th>
                                            <th>Bulan</th>
                                            <th>No Rek</th>
                                            <th>Bukti</th>
                                            <th>Jumlah</th>
                                            <th>Bank</th>
                                            <th>Tipe</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pembayaran as $sw)
                                        <tr>
                                            <!-- <td>{{ $loop->iteration }}</td> -->
                                            <td>{{ $sw->nis }}</td>
                                            <td>{{ $sw->nama }}</td>
                                            <td>{{ $sw->tgl_transfer }}</td>
                                            <td>{{ $sw->bulan }}</td>
                                            <td>{{ $sw->no_rek }}</td>
                                            <td><button class="btn btn-primary detail-bukti"
                                                    data-image="/images/paket/{{ $sw->bukti }}" data-toggle="modal"
                                                    data-target="#exampleModal">Tampil</button></td>
                                            <td>@currency($sw->jumlah)</td>
                                            <td>{{ $sw->atm }}</td>
                                            <td>{{ $sw->namatipe }}</td>
                                            @php
                                            if($sw->status == 0 )
                                            $pesan = '<span class="badge badge-danger">Tunggu</span>';

                                            elseif($sw->status == 3)

                                            $pesan = '<span class="badge badge-danger">Di Tolak</span>';

                                            else

                                            $pesan = '<span class="badge badge-success">Konfirmasi</span>';
                                            @endphp
                                            <td>{!! $pesan !!}</td>
                                            <!-- <td> -->

                                            <!-- </td> -->
                                            <td>
                                                <div class="row">
                                                    <a class="btn btn-success" target="_blank"
                                                        href="/cetakpembayaran/{{ Crypt::encrypt($sw->id_p) }}"
                                                        data-toggle="tooltip" data-original-title="Cetak"><i
                                                            class="fa fa-print"></i></a>

                                                    @if($sw->status == 0 )
                                                    <form action="/accpembayaran/{{ Crypt::encrypt($sw->id_p) }}/3/1"
                                                        method="post" class="d-inline kon" data-toggle="tooltip" data-jenis="tolak"
                                                        data-original-title="Tolak">
                                                        @csrf
                                                        @method('put')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                    <form action="/accpembayaran/{{ Crypt::encrypt($sw->id_p) }}/1/1"
                                                        method="post" class="d-inline kon" data-toggle="tooltip" data-jenis="konfirmasi"
                                                        data-original-title="Konfirmasi">
                                                        @csrf
                                                        @method('put')
                                                        
                                                        <button type="submit" class="btn btn-primary">
                                                            <i
                                                            class="fa fa-check"></i>
                                                        </button>
                                                    </form>
                                                    @elseif($sw->status == 3)
                                                    <form action="/accpembayaran/{{ Crypt::encrypt($sw->id_p) }}/1/1"
                                                        method="post" class="d-inline kon" data-toggle="tooltip" data-jenis="konfirmasi"
                                                        data-original-title="Konfirmasi">
                                                        @csrf
                                                        @method('put')
                                                        <button type="submit" class="btn btn-primary">
                                                            <i
                                                            class="fa fa-check"></i>
                                                        </button>
                                                    </form>

                                                    @else
                                                    <form action="/accpembayaran/{{ Crypt::encrypt($sw->id_p) }}/3/1"
                                                        method="post" class="d-inline kon" data-toggle="tooltip" data-jenis="tolak"
                                                        data-original-title="Tolak">
                                                        @csrf
                                                        @method('put')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                    @endif

                                                   
                                                    <form action="/api/accpembayaran/{{ Crypt::encrypt($sw->id_p) }}"
                                                        method="post" class="d-inline btn-del">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger"
                                                            data-toggle="tooltip" data-original-title="Hapus"><i class="fas fa-trash"></i></button>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
