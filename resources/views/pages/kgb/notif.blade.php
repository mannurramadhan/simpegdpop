@extends('layouts.app', ['activePage' => 'notif-kgb', 'titlePage' => __('Pemberitahuan Kenaikan Gaji Berkala'), 'notification' => $notification])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Pemberitahuan Kenaikan Gaji Berkala') }}</h4>
                <p class="card-category"> {{ __('Berikut adalah data pemberitahuan kenaikan gaji berkala pegawai Dinas Pemuda, Olahraga dan Pariwisata Kota Balikpapan') }}</p>
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
                        {{ __('MKG') }}
                      </th>
                      <th class="text-center">
                        {{ __('Golongan') }}
                      </th>
                      <th class="text-center">
                        {{ __('Gaji Saat Ini') }}
                      </th>
                      <th class="text-center">
                        {{ __('Kenaikan Gaji') }}
                      </th>
                      <th class="text-center">
                        {{ __('Waktu Kenaikan Gaji') }}
                      </th>
                      <th class="text-center">
                        {{ __('Verifikasi Gaji') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($notif as $kgb)
                        <tr>
                          <td class="text-center">
                            {{ $kgb->nip }}
                          </td>
                          <td>
                            {{ $kgb->nama }}
                          </td>
                          <td class="text-center">
                            {{ $kgb->mkg }}
                          </td>
                          <td class="text-center">
                            {{ $kgb->golongan }}
                          </td>
                          <td class="text-center">
                            {{ $kgb->gaji_pegawai }}
                          </td>
                          <td class="text-center">
                            {{ $kgb->kenaikan_gaji }}
                          </td>
                          <td class="text-center">
                            {{ $kgb->update_kgb }}
                          </td>
                          <td class="td-actions text-center">
                          @if(($kgb->durasi_kgb >=0 && $kgb->durasi_kgb <= 120) && ($kgb->status == "Verifikasi!"))
                            <a rel="tooltip" class="btn btn-danger btn-link" href="{{ route('kgb.verify', ['nip'=> $kgb->nip]) }}">
                              {{ $kgb->status }}
                            </a>
                          @elseif(($kgb->durasi_kgb >=7 && $kgb->durasi_kgb <= 120) && ($kgb->status == "Segera Ajukan!"))
                            <a rel="tooltip" class="btn btn-danger btn-link" href="{{ route('kgb.ajuan', ['nip'=> $kgb->nip]) }}">
                              {{ $kgb->status }}
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