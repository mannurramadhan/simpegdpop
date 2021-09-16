@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'register', 'titlePage' => __('SIMPEG DPOP BALIKPAPAN')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row align-items-center">
    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
      <form class="form" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="card card-login card-hidden mb-3">
          <div class="card-header card-header-primary text-center">
            <a href="{{ route('login') }}" class="btn btn-just-icon btn-link btn-white">
              <i class="fa fa-user"></i>
            </a>
            <h6 class="card-title">{{ __('DAFTAR AKUN') }}</h6>
          </div>
          <div class="card-body ">
            <p class="card-description text-center">{{ __('Silahkan isi data Anda dengan benar!') }}</p>
            <div class="bmd-form-group{{ $errors->has('nama_user') ? ' has-danger' : '' }}">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">face</i>
                  </span>
                </div>
                <input type="text" name="nama_user" class="form-control" placeholder="{{ __('Nama Lengkap') }}" required>
              </div>
              @if ($errors->has('nama_user'))
                <div id="namauser-error" class="error text-danger pl-3" for="nama_user" style="display: block;">
                  <strong>{{ $errors->first('nama_user') }}</strong>
                </div>
              @endif
            </div>
            <div class="bmd-form-group{{ $errors->has('nip') ? ' has-danger' : '' }} mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">credit_card</i>
                  </span>
                </div>
                <input type="text" name="nip" class="form-control" placeholder="{{ __('NIP') }}" value="{{ old('nip') }}" required>
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
                <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password') }}" required>
              </div>
              @if ($errors->has('password'))
                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                  <strong>{{ $errors->first('password') }}</strong>
                </div>
              @endif
            </div>
            <div class="bmd-form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }} mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                  </span>
                </div>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('Konfirmasi Password') }}" required>
              </div>
              @if ($errors->has('password_confirmation'))
                <div id="password_confirmation-error" class="error text-danger pl-3" for="password_confirmation" style="display: block;">
                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                </div>
              @endif
            </div>
            <!--<div class="form-check mr-auto ml-3 mt-3">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" id="policy" name="policy" {{ old('policy', 1) ? 'checked' : '' }} >
                <span class="form-check-sign">
                  <span class="check"></span>
                </span>
                {{ __('I agree with the ') }} <a href="#">{{ __('Privacy Policy') }}</a>
              </label>
            </div>-->
          </div>
          <div class="card-footer justify-content-center">
            <button type="submit" class="btn btn-primary btn-link btn-lg">{{ __('Daftar Akun') }}</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
