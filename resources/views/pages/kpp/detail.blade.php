@extends('layouts.app', ['activePage' => 'info-kpp', 'titlePage' => __('Riwayat Kenaikan Pangkat Pegawai'), 'notification' => $notification])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Riwayat Kenaikan Pangkat Pegawai') }}</h4>
                <p class="card-category"> {{ __('Berikut adalah data riwayat kenaikan pangkat pegawai Dinas Pemuda, Olahraga dan Pariwisata Kota Balikpapan') }}</p>
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
                        {{ __('Golongan Baru') }}
                      </th>
                      <th class="text-center">
                        {{ __('TMT') }}
                      </th>
                      <th class="text-center">
                        {{ __('Gaji Pokok') }}
                      </th>
                      <th class="text-center">
                        {{ __('Pejabat') }}
                      </th>
                      <th class="text-center">
                        {{ __('Nomor SK') }}
                      </th>
                      <th class="text-center">
                        {{ __('Tanggal SK') }}
                      </th>
                      <th class="text-center">
                        {{ __('MKG') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($detail as $kgb)
                        <tr>
                          <td class="text-center">
                            {{ $kgb->nip }}
                          </td>
                          <td>
                            {{ $kgb->nama }}
                          </td>
                          <td class="text-center">
                            {{ $kgb->golongan_baru }}
                          </td>
                          <td class="text-center">
                            {{ $kgb->tmt }}
                          </td>
                          <td class="text-center">
                            {{ $kgb->gaji_pokok_baru }}
                          </td>
                          <td class="text-center">
                            {{ $kgb->pejabat }}
                          </td>
                          <td class="text-center">
                            {{ $kgb->no_sk }}
                          </td>
                          <td class="text-center">
                            {{ $kgb->tanggal_sk }}
                          </td>
                          <td class="text-center">
                            {{ $kgb->mkg_baru }}
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                  <a class="btn btn-primary" href="{{ route('kpp.index') }}">{{ __('Kembali') }}</a>
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