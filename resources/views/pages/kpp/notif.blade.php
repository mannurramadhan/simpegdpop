@extends('layouts.app', ['activePage' => 'notif-kpp', 'titlePage' => __('Pemberitahuan Kenaikan Pangkat'), 'notification' => $notification])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Pemberitahuan Kenaikan Pangkat') }}</h4>
                <p class="card-category"> {{ __('Berikut adalah data pemberitahuan kenaikan pangkat pegawai Dinas Pemuda, Olahraga dan Pariwisata Kota Balikpapan') }}</p>
              </div>
              <div class="card-body">
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
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th class="text-center">
                        {{ __('NIP') }}
                      </th>
                      <th>
                        {{ __('Nama Pegawai') }}
                      </th>
                      <th class="text-center">
                        {{ __('Golongan Saat Ini') }}
                      </th>
                      <th class="text-center">
                        {{ __('Kenaikan Golongan') }}
                      </th>
                      <th class="text-center">
                        {{ __('Waktu Kenaikan Golongan') }}
                      </th>
                      <th class="text-center">
                        {{ __('Waktu Mengurus Berkas') }}
                      </th>
                      <th class="text-center">
                        {{ __('Verifikasi Berkas') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($notif as $kpp)
                        <tr>
                          <td class="text-center">
                            {{ $kpp->nip }}
                          </td>
                          <td>
                            {{ $kpp->nama }}
                          </td>
                          <td class="text-center">
                            {{ $kpp->golongan }}
                          </td>
                          <td class="text-center">
                            {{ $kpp->kenaikan_golongan }}
                          </td>
                          <td class="text-center">
                            {{ $kpp->update_pangkat }}
                          </td>
                          <td class="text-center">
                            {{ $kpp->update_pangkat }}
                          </td>
                          <td class="td-actions text-center">
                          @if(($kpp->durasi_kpp >=0 && $kpp->durasi_kpp <= 120) && ($kpp->status == "Verifikasi!"))
                            <a rel="tooltip" class="btn btn-danger btn-link" href="{{ route('kpp.verify', ['nip'=> $kpp->nip]) }}">
                              {{ $kpp->status }}
                            </a>
                          @elseif(($kpp->durasi_kpp >=7 && $kpp->durasi_kpp <= 120) && ($kpp->status == "Segera Ajukan!"))
                            <a rel="tooltip" class="btn btn-danger btn-link" href="{{ route('kpp.ajuan', ['nip'=> $kpp->nip]) }}">
                              {{ $kpp->status }}
                            </a> 
                          @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{ $notif->links() }}
                </div>
              </div>
            </div>
            <script>
              function myFunction() {
                var x = document.getElementById("button");
                x.disabled = true;
              }
            </script>
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