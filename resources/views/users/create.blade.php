@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Management'), 'notification' => $notification])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('user.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Tambah User') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">{{ __('Kembali') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nama') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('nama_user') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('nama_user') ? ' is-invalid' : '' }}" name="nama_user" id="input-name" type="text" placeholder="{{ __('Name') }}" value="{{ old('nama_user') }}" required="true" aria-required="true"/>
                      @if ($errors->has('nama_user'))
                        <span id="namauser-error" class="error text-danger" for="input-name">{{ $errors->first('nama_user') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('NIP') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('nip') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('nip') ? ' is-invalid' : '' }}" name="nip" id="input-nip" type="text" placeholder="{{ __('NIP') }}" value="{{ old('nip') }}" required />
                      @if ($errors->has('nip'))
                        <span id="nip-error" class="error text-danger" for="input-nip">{{ $errors->first('nip') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password">{{ __(' Password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" input type="password" name="password" id="input-password" placeholder="{{ __('Password') }}" value="" required />
                      @if ($errors->has('password'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('password') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Konfirmasi Password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('Confirm Password') }}" value="" required />
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Simpan User') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection