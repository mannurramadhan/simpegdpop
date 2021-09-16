@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'titlePage' => __('SIMPEG DPOP KOTA BALIKPAPAN')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row justify-content-center">
      <div class="col-lg-7 col-md-8">
          <h2 class="text-white text-center">
            {{ __('SIMPEG DPOP KOTA BALIKPAPAN') }}
          </h2>
          <marquee direction="left">
            <h3 class="text-white text-center">
              {{ __('Selamat Datang di Sistem Informasi Manajemen Kepegawaian Dinas Pemuda, Olahraga dan Pariwisata Kota Balikpapan') }}
            </h3>
          </marquee>
      </div>
  </div>
</div>
@endsection
