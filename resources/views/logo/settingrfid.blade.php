@extends('layout')
@section('title', 'Data Sekolah')
@section('content')

<div class="page-inner mt--5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Setting RFID</div>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                    <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel"
                        aria-labelledby="pills-home-tab-nobd">
                        <div class="col-md-12">
                            <form action="/settingrfid/update" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div id="kelasModalMethod"></div>

                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="presensi" id="inlineRadio1"
                                            value="0" {{ $logo->presensi == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineRadio1">sembunyikan</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="presensi" id="inlineRadio2"
                                            value="1" {{ $logo->presensi == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineRadio2">tampilkan</label>
                                    </div>
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
