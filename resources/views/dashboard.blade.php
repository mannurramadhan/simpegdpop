@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Beranda'), 'notification' => $notification])

@section('content')
  <div class="content">
    <div class="container-fluid" style="height: auto;">
      @if (session('success'))
        <div class="row">
          <div class="col-sm-12">
            <div class="alert alert-success">
              <span>{{ session('success') }}</span>
            </div>
          </div>
        </div>
      @elseif (session('failed'))
        <div class="row">
          <div class="col-sm-12">
            <div class="alert alert-danger">
              <span>{{ session('failed') }}</span>
            </div>
          </div>
        </div>
      @endif
      <div class="row justify-content-center">
        <div class="col-lg-7 col-md-8">
          <img style="display: block; width:200px; margin: auto" src="{{ asset('material') }}/img/logo-pemkot.png">
          <h1 class="text-black text-center">
            {{ __('SELAMAT DATANG') }}
          </h1>
          <h3 class="text-black text-center">
            Anda masuk sebagai "<b>{{ Auth::user()->nama_user }}</b>"<br>
            NIP : {{ Auth::user()->nip }}
          </h3>
          <?php 
            $tahun = date('Y');
            $sekarang = date('d-m-Y');
            $awal_tahun = '01-01-'.$tahun.'';
          ?>
          @if($sekarang == $awal_tahun)
          <a rel="tooltip" class="btn btn-primary btn-link" href="{{ route('home.update') }}">
            {{ __('Update Tahun Baru') }}
          </a>
          @endif
        </div>
      </div>
    </div>
  </div>
  <script>
    window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
      });
    }, 5000);
  </script>
@endsection