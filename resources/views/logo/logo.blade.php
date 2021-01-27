@extends('layout')
@section('title', 'Data Sekolah')
@section('content')

<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Ganti Biodata</div>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                    <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel"
                        aria-labelledby="pills-home-tab-nobd">
                        <div class="col-md-12">
                            <form action="/logo/update" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div id="kelasModalMethod"></div>
                                <div class="form-group">
                                    <label for="namasekolah">Nama Sekolah</label>
                                    <input type="text" value="{{ $logo->namasekolah }}" class="form-control"
                                        name="namasekolah" id="namasekolah" required="">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" value="{{ $logo->alamat }}" class="form-control" name="alamat"
                                        id="alamat" required="">
                                </div>
                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <input type="file" class="form-control" name="logo" id="logo" >
                                </div>
                                <div class="form-group">
                                    <label for="biodata">Biodata</label>
                                    <textarea name="biodata" id="biodata" class="form-control editor" cols="30"
                                        rows="20" required="">{{ $logo->biodata }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-outline-primary">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
