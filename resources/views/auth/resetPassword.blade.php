@extends('layouts.app')

@section('content')

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Reset Password</h1>
                    
                  </div>
                  <form class="user" method="post" action="/store-reset">
                    @csrf
                    @if ($message = Session::get('failed'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('failed') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                   <div class="form-group">
                        <input type="hidden"
                            class="form-control form-control-user @error('username') is-invalid @enderror"
                            name="username" id="exampleInputusername " placeholder="username Baru" value="{{ $email }}">
                        <input type="password"
                            class="form-control form-control-user @error('password') is-invalid @enderror"
                            name="password" id="exampleInputPassword " placeholder="Password Baru">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                   <div class="form-group">
                        <input type="password"
                            class="form-control form-control-user @error('password1') is-invalid @enderror"
                            name="password1" id="exampleInputPassword " placeholder="Ulangi Password Baru">
                        @error('password1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Reset
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="/login">Kembali kehalaman login?</a>
                  </div>
                 
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  @endsection
