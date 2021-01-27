@extends('layout')
@section('title', 'Presensi RFID')
@section('sidebar', 'hide')
@section('content')

<div class="page-inner mt-5" id="rfid-page">
    <div class="">

        <div class="card w-50 mx-auto bg-light shadow-lg">

            <div class="card-body mt-2">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if ($message = Session::get('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('failed') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="tab-content mt-2 mb-0" id="pills-without-border-tabContent">
                    <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel"
                        aria-labelledby="pills-home-tab-nobd">
                        <div class="col-md-12">
                            <form action="/tambahabsenrfid" id="absenForm" method="post">
                                @csrf
                                @method('post')
                                <input type="number" name="no_kartu" id="no_kartu_auto" value="no_kartu" tabindex="-1"
                                    autofocus class="form-control col-md-6">
                            </form>
                            <h5 class="font-weight-bold text-center ">
                                Silahkan tempelkan kartu anda di alat
                                RFID
                            </h5>
                            <p class="font-weight-bold text-center text-light"></p>
                            <div class="">
                                <div id="circle">
                                    <div class="circle one">
                                        <div class="circle two">
                                            <div class="circle three">
                                                <div class="circle four">
                                                    <div class="circle five">
                                                        <div class="circle six">
                                                            <div class="circle seven">
                                                                <div class="circle eight">
                                                                    <div class="circle nine">
                                                                        <div class="circle ten">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <a href="/login" class="btn btn-info btn-user btn-block">
                    Login
                </a>
            </div>
        </div>

    </div>

</div>

<script>
    var alwaysFocusedInput = document.getElementById("no_kartu_auto");

    alwaysFocusedInput.addEventListener("blur", function () {
        setTimeout(() => {
            alwaysFocusedInput.focus();
        }, 0);
    });

</script>
@stop
