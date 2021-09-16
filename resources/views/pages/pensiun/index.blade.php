@extends('layouts.app', ['activePage' => 'info-pensiun', 'titlePage' => __('Informasi Waktu Pensiun'), 'notification' => $notification])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Informasi Waktu Pensiun') }}</h4>
                <p class="card-category"> {{ __('Berikut adalah data waktu pensiun pegawai negeri sipil (PNS) Dinas Pemuda, Olahraga dan Pariwisata Kota Balikpapan') }}</p>
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
                    </thead>
                    <tbody>
                      @foreach($index as $pensiun)
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
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{ $index->links() }}
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