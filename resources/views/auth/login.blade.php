@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'login', 'titlePage' => __('SIMPEG DPOP BALIKPAPAN')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row align-items-center">
    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
      <form class="form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="card card-login card-hidden mb-3">
          <div class="card-header card-header-primary text-center">
            <a href="{{ route('login') }}" class="btn btn-just-icon btn-link btn-white">
              <i class="fa fa-user"></i>
            </a>
            <h6 class="card-title">{{ __('Masuk Akun') }}</h6>
          </div>
          <div class="card-body">
            <p class="card-description text-center">{{ __('Silahkan masukkan NIP dan Password akun Anda dengan benar di bawah ini! ') }}</p>
            <div class="bmd-form-group{{ $errors->has('nip') ? ' has-danger' : '' }}">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">account_box</i>
                  </span>
                </div>
                <input type="text" name="nip" class="form-control" placeholder="{{ __('NIP...') }}" value="{{ __('198207102010022008') }}" required>
              </div>
              @if ($errors->has('nip'))
                <div id="nip-error" class="error text-danger pl-3" for="nip" style="display: block;">
                  <strong>{{ $errors->first('nip') }}</strong>
                </div>
              @endif
            </div>
            <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                  </span>
                </div>
                <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password...') }}" value="{{ __('') ? "secret" : "" }}" required>
              </div>
              @if ($errors->has('password'))
                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                  <strong>{{ $errors->first('password') }}</strong>
                </div>
              @endif
            </div>
            <!--<div class="form-check mr-auto ml-3 mt-3">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="remember" {{ old('rememberToken') ? 'checked' : '' }}> {{ __('Ingat akun') }}
                <span class="form-check-sign">
                  <span class="check"></span>
                </span>
              </label>
            </div>-->
          </div>
          <div class="card-footer justify-content-center">
            <button type="submit" class="btn btn-primary btn-link btn-lg">{{ __('Masuk') }}</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
