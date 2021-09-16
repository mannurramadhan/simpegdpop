@extends('layouts.app', ['activePage' => 'notif-pensiun', 'titlePage' => __('Pemberitahuan Pensiun Pegawai'), 'notification' => $notification])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Pemberitahuan Pensiun Pegawai') }}</h4>
                <p class="card-category"> {{ __('Berikut adalah data pemberitahuan pensiun pegawai Dinas Pemuda, Olahraga dan Pariwisata Kota Balikpapan') }}</p>
              </div>
              <div class="card-body">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th class="text-center">
                        {{ __('NIP/NIK') }}
                      </th>
                      <th>
                        {{ __('Nama Pegawai') }}
                      </th>
                      <th class="text-center">
                        {{ __('Tahun Awal Kerja') }}
                      </th>
                      <th class="text-center">
                        {{ __('Tahun Pensiun') }}
                      </th>
                      <th class="text-center">
                        {{ __('Waktu Pensiun') }}
                      </th>
                      <th class="text-right">
                        {{ __('Verifikasi') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($notif as $pensiun)
                        <tr>
                          <td class="text-center">
                            {{ $pensiun->nip }}
                          </td>
                          <td>
                            {{ $pensiun->nama }}
                          </td>
                          <td class="text-center">
                            {{ $pensiun->tahun_masuk_kerja }}
                          </td>
                          <td class="text-center">
                            {{ $pensiun->tahun_pensiun }}
                          </td>
                          <td class="text-center">
                            {{ $pensiun->update_pensiun }}
                          </td>
                          <td class="td-actions text-right">
                          @if($pensiun->durasi_pensiun < 0)
                            <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('arsipp.edit', ['nip'=> $pensiun->nip]) }}">
                              <p><font color="red">Belum Diverifikasi!</font></p>
                              <div class="ripple-container"></div>
                            </a>
                          @elseif($pensiun->durasi_pensiun >=0 && $pensiun->durasi_pensiun < 7)
                            <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('arsipp.edit', ['nip'=> $pensiun->nip]) }}">
                              <p><font color="red">Verifikasi!</font></p>
                              <div class="ripple-container"></div>
                            </a>
                          @elseif($pensiun->durasi_pensiun >=7 && $pensiun->durasi_pensiun <= 180)
                            <a rel="tooltip" class="btn btn-success btn-link">
                              <p><font color="red">Segera Ajukan!</font></p>
                              <div class="ripple-container"></div>
                            </a>
                          @else
                            <a rel="tooltip" class="btn btn-success btn-link">
                              <p><font color="red">Masih Lama</font></p>
                              <div class="ripple-container"></div>
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